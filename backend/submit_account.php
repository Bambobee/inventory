<?php
// Include database connection
require_once '../db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $acc_name = $_POST['acc_name'];
    $acc_number = $_POST['acc_number'];
    $balance = $_POST['balance'];
    $created_at = $_POST['created_at'];

    // Insert query
    $sql = "INSERT INTO accounts (acc_name, acc_number, balance, created_at) 
            VALUES (:acc_name, :acc_number, :balance, :created_at)";

    try {
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':acc_name', $acc_name);
        $stmt->bindParam(':acc_number', $acc_number);
        $stmt->bindParam(':balance', $balance);
        $stmt->bindParam(':created_at', $created_at);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Account created successfully!";
            header("Location: ../account");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while creating the account.";
            header("Location: ../account");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
