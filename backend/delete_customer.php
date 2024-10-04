<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the customers ID
    $customer_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM customer WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind the customers ID parameter
        $stmt->bindParam(':id', $customer_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Customer deleted successfully!";
            header("Location: ../customers");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while deleting the customer.";
            header("Location: ../customers");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    session_start();
    $_SESSION['error'] = "Invalid customer ID.";
    header("Location: ../customers");
}
?>
