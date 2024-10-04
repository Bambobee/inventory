<?php
// Include database connection
require_once '../db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];
    $status = $_POST['status'];
    $address = $_POST['address'];

    // Generate a random six-digit supplier ID in the format SUP_number
    $random_number = mt_rand(100000, 999999);
    $suplier_id = 'SUP_' . $random_number;

    // Insert query with suplier_id
    $sql = "INSERT INTO supplier (suplier_id, name, email, contact, date, status, total_purchased_due, total_purchased_due_returned, address) 
            VALUES (:suplier_id, :name, :email, :contact, :date, :status, 0, 0, :address)";

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
            session_start();
            $_SESSION['success'] = "Supplier created successfully with ID: $suplier_id";
            header("Location: ../suppliers");
            exit(); // Stop further execution
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while creating the supplier.";
            header("Location: ../suppliers");
            exit(); // Stop further execution
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
