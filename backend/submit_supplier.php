<?php
// Include database connection
require_once '../db_conn.php';

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data and trim any unnecessary spaces
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contact = trim($_POST['contact']);
    $date = trim($_POST['date']);
    $status = trim($_POST['status']);
    $address = trim($_POST['address']);

    // Check for empty fields
    if (empty($name) || empty($email) || empty($contact) || empty($date) || empty($status) || empty($address)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../suppliers");
        exit(); // Stop further execution
    }

    // Check if the email or contact already exists in the supplier table
    $checkUniqueSql = "SELECT * FROM supplier WHERE email = :email OR contact = :contact";
    $stmt = $conn->prepare($checkUniqueSql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contact', $contact);
    $stmt->execute();
    $existingSupplier = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingSupplier) {
        $_SESSION['error'] = "Email or contact already exists. Please use different values.";
        header("Location: ../suppliers");
        exit(); // Stop further execution
    }

    // Generate a random six-digit supplier ID in the format SUP_number
    $random_number = mt_rand(100000, 999999);
    $suplier_id = 'SUP_' . $random_number;

    // Insert query with suplier_id
    $sql = "INSERT INTO supplier (suplier_id, name, email, contact, date, status, address) 
            VALUES (:suplier_id, :name, :email, :contact, :date, :status, :address)";

    try {
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':suplier_id', $suplier_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':address', $address);

        // Execute the query
        if ($stmt->execute()) {
            $_SESSION['success'] = "Supplier created successfully with ID: $suplier_id";
            header("Location: ../suppliers");
            exit(); // Stop further execution
        } else {
            $_SESSION['error'] = "Error occurred while creating the supplier.";
            header("Location: ../suppliers");
            exit(); // Stop further execution
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header("Location: ../suppliers");
        exit(); // Stop further execution
    }
}
?>
