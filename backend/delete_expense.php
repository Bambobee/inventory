<?php
include __DIR__ . '/../db_conn.php';

if (isset($_GET['id'])) {
    $expense_id = $_GET['id'];

    try {
        // Start a transaction
        $conn->beginTransaction();

        // Step 1: Fetch the expense details including account_id and amount
        $stmt = $conn->prepare("SELECT acc_id, amount FROM expenses WHERE id = :id");
        $stmt->bindParam(':id', $expense_id, PDO::PARAM_INT);
        $stmt->execute();
        $expense = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($expense) {
            $acc_id = $expense['acc_id'];
            $amount = $expense['amount'];

            // Step 2: Deduct the expense amount from the account balance
            $update_stmt = $conn->prepare("UPDATE accounts SET balance = balance + :amount WHERE id = :acc_id");
            $update_stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
            $update_stmt->bindParam(':acc_id', $acc_id, PDO::PARAM_INT);
            $update_stmt->execute();

            // Step 3: Delete the expense record
            $delete_stmt = $conn->prepare("DELETE FROM expenses WHERE id = :id");
            $delete_stmt->bindParam(':id', $expense_id, PDO::PARAM_INT);
            $delete_stmt->execute();

            // Commit the transaction
            $conn->commit();

            // Redirect back with success message
            session_start();
            $_SESSION['success'] = "expense deleted and account balance updated successfully.";
            header("Location: ../expenses");
            exit();
        } else {
            // expense not found
            session_start();
            $_SESSION['error'] = "expense not found.";
            header("Location: ../expenses");
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
    header("Location: ../expenses");
    exit();
}
