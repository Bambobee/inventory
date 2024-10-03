<?php
include __DIR__ . '/../db_conn.php';

if (isset($_GET['id'])) {
    $deposit_id = $_GET['id'];

    try {
        // Start a transaction
        $conn->beginTransaction();

        // Step 1: Fetch the deposit details including account_id and amount
        $stmt = $conn->prepare("SELECT acc_id, amount FROM deposit WHERE id = :id");
        $stmt->bindParam(':id', $deposit_id, PDO::PARAM_INT);
        $stmt->execute();
        $deposit = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($deposit) {
            $acc_id = $deposit['acc_id'];
            $amount = $deposit['amount'];

            // Step 2: Deduct the deposit amount from the account balance
            $update_stmt = $conn->prepare("UPDATE accounts SET balance = balance - :amount WHERE id = :acc_id");
            $update_stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $update_stmt->bindParam(':acc_id', $acc_id, PDO::PARAM_INT);
            $update_stmt->execute();

            // Step 3: Delete the deposit record
            $delete_stmt = $conn->prepare("DELETE FROM deposit WHERE id = :id");
            $delete_stmt->bindParam(':id', $deposit_id, PDO::PARAM_INT);
            $delete_stmt->execute();

            // Commit the transaction
            $conn->commit();

            // Redirect back with success message
            session_start();
            $_SESSION['success'] = "Deposit deleted and account balance updated successfully.";
            header("Location: ../deposit");
            exit();
        } else {
            // Deposit not found
            session_start();
            $_SESSION['error'] = "Deposit not found.";
            header("Location: ../deposit");
            exit();
        }

    } catch (PDOException $e) {
        // Rollback transaction on failure
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
} else {
    // If id is not set, redirect back
    session_start();
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../deposit");
    exit();
}
