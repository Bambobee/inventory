<?php
// Include database connection
require_once '../db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $acc_name = $_POST['acc_name'];
    $acc_number = $_POST['acc_number'];
    $balance = $_POST['balance'];
    $created_at = $_POST['created_at'];

    // Update query
    $sql = "UPDATE accounts 
            SET acc_name = :acc_name, acc_number = :acc_number, balance = :balance, created_at = :created_at 
            WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':acc_name', $acc_name);
        $stmt->bindParam(':acc_number', $acc_number);
        $stmt->bindParam(':balance', $balance);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Account updated successfully!";
            header("Location: ../account");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while updating the account.";
            header("Location: ../account");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
