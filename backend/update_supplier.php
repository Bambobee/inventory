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
    $date = $_POST['date'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $total_purchased_due = $_POST['total_purchased_due'];
    $total_purchased_due_returned = $_POST['total_purchased_due_returned'];

    // Update query
    $sql = "UPDATE supplier 
            SET name = :name, email = :email, contact = :contact, date = :date, address = :address, status = :status, total_purchased_due = :total_purchased_due, total_purchased_due_returned = :total_purchased_due_returned    
            WHERE id = :id";

    try {
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':address', $address);  // Added missing binding for address
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':total_purchased_due', $total_purchased_due);
        $stmt->bindParam(':total_purchased_due_returned', $total_purchased_due_returned);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Supplier updated successfully!";
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while updating the supplier.";
        }
        // Redirect back to suppliers page
        header("Location: ../suppliers");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
