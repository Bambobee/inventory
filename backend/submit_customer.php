<?php
// Include database connection
require_once '../db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $added_date = $_POST['added_date'];
    $status = $_POST['status'];

    // Generate a random six-digit customer ID in the format CUST_number
    $random_number = mt_rand(100000, 999999);
    $cust_id = 'CUST_' . $random_number;

    // Insert query with cust_id
    $sql = "INSERT INTO customer (cust_id, name, email, contact, added_date, status, total_sale_due, total_sales_due_returned) 
            VALUES (:cust_id, :name, :email, :contact, :added_date, :status, 0, 0)";

    try {
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':cust_id', $cust_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':added_date', $added_date);
        $stmt->bindParam(':status', $status);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Customer created successfully with ID: $cust_id";
            header("Location: ../customers");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while creating the customer.";
            header("Location: ../customers");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
