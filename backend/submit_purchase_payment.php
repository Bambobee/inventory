<?php
session_start(); // Start the session
include __DIR__ . '/../db_conn.php';  // Include the database connection

// Retrieve form data
$payment_date = $_POST['payment_date'];
$paid_amount = $_POST['paid_amount'];
$payment_method = $_POST['payment_method'];
$acc_id = $_POST['acc_id'];
$pur_id = $_POST['pur_id'];

try {
    // Start a transaction
    $conn->beginTransaction();

    // Fetch the current purchase details
    $stmt = $conn->prepare("SELECT grand_total, paid_amount, due, payment_status FROM purchase WHERE id = :pur_id");
    $stmt->bindParam(':pur_id', $pur_id, PDO::PARAM_INT);
    $stmt->execute();
    $purchase = $stmt->fetch();

    // Check if the purchase exists
    if (!$purchase) {
        $_SESSION['error'] = "Purchase not found.";
        header("Location: ../purchases");
        exit();
    }

    $current_paid_amount = $purchase['paid_amount'];
    $current_due = $purchase['due'];
    $grand_total = $purchase['grand_total'];

    // Fetch the account balance
    $stmt = $conn->prepare("SELECT balance FROM accounts WHERE id = :acc_id");
    $stmt->bindParam(':acc_id', $acc_id, PDO::PARAM_INT);
    $stmt->execute();
    $account = $stmt->fetch();

    if (!$account) {
        $_SESSION['error'] = "Account not found.";
        header("Location: ../purchases");
        exit();
    }

    $account_balance = $account['balance'];

    // Check if the account balance is sufficient
    if ($account_balance < $paid_amount) {
        $_SESSION['error'] = "Insufficient balance in the account.";
        header("Location: ../purchases");
        exit();
    }

    // Update the paid_amount and due
    $new_paid_amount = $current_paid_amount + $paid_amount;
    $new_due = $grand_total - $new_paid_amount;

    // Determine the new payment status
    $new_payment_status = ($new_due == 0) ? 'Paid' : 'Partial';

    // Update the purchase record including acc_id and payment_method
    $stmt = $conn->prepare("UPDATE purchase 
                            SET paid_amount = :new_paid_amount, due = :new_due, 
                                payment_status = :new_payment_status, acc_id = :acc_id, 
                                payment_method = :payment_method,
                                payment_date= :payment_date 
                            WHERE id = :pur_id");
    $stmt->bindParam(':new_paid_amount', $new_paid_amount, PDO::PARAM_STR);
    $stmt->bindParam(':new_due', $new_due, PDO::PARAM_STR);
    $stmt->bindParam(':new_payment_status', $new_payment_status, PDO::PARAM_STR);
    $stmt->bindParam(':acc_id', $acc_id, PDO::PARAM_INT);
    $stmt->bindParam(':payment_method', $payment_method, PDO::PARAM_STR);
    $stmt->bindParam(':payment_date', $payment_date, PDO::PARAM_STR);
    $stmt->bindParam(':pur_id', $pur_id, PDO::PARAM_INT);
    $stmt->execute();

    // Update the account balance
    $new_account_balance = $account_balance - $paid_amount;
    $stmt = $conn->prepare("UPDATE accounts SET balance = :new_balance WHERE id = :acc_id");
    $stmt->bindParam(':new_balance', $new_account_balance, PDO::PARAM_STR);
    $stmt->bindParam(':acc_id', $acc_id, PDO::PARAM_INT);
    $stmt->execute();

    // Commit the transaction
    $conn->commit();

    // Success message
    $_SESSION['success'] = "Payment of UGX $paid_amount has been successfully applied.";
    header("Location: ../purchases");
    exit();

} catch (PDOException $e) {
    // Rollback in case of an error
    $conn->rollBack();
    $_SESSION['error'] = "Error processing payment: " . $e->getMessage();
    header("Location: ../purchases");
    exit();
}
?>
