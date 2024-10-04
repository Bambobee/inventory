<?php
// Include database connection
require_once '../db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $added_date = $_POST['added_date'];
    $status = $_POST['status'];
    $total_sale_due = $_POST['total_sale_due'];
    $total_sales_due_returned = $_POST['total_sales_due_returned'];

    // Update query
    $sql = "UPDATE customer 
            SET name = :name, email = :email, contact = :contact, added_date = :added_date, status = :status, total_sale_due = :total_sale_due, total_sales_due_returned = :total_sales_due_returned    
            WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':added_date', $added_date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':total_sale_due', $total_sale_due);
        $stmt->bindParam(':total_sales_due_returned', $total_sales_due_returned);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Customer updated successfully!";
            header("Location: ../customers");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while updating the customer.";
            header("Location: ../customers");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
