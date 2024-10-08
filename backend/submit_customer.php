<?php
// Include database connection
require_once '../db_conn.php';

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $added_date = trim($_POST['added_date']);
    $status = trim($_POST['status']);

    // Check for empty fields
    if (empty($name) || empty($email) || empty($contact) || empty($added_date) || empty($status)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../customers");
        exit();
    }

    // Check if the email is unique
    $checkEmailSql = "SELECT * FROM customer WHERE email = :email";
    $stmt = $conn->prepare($checkEmailSql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $existingEmail = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingEmail) {
        $_SESSION['error'] = "Email already exists. Please use a different email.";
        header("Location: ../customers");
        exit();
    }

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
            $_SESSION['success'] = "Customer created successfully with ID: $cust_id";
            header("Location: ../customers");
        } else {
            $_SESSION['error'] = "Error occurred while creating the customer.";
            header("Location: ../customers");
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header("Location: ../customers");
    }
}
?>
