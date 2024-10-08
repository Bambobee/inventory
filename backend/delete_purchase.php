<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the purchase ID
    $purchase_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM purchase WHERE id = :id";

    try {
        // Prepare the delete statement
        $stmt = $conn->prepare($sql);

        // Bind the purchase ID parameter
        $stmt->bindParam(':id', $purchase_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Start session if not started already
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Set success message and redirect
            $_SESSION['success'] = "Purchase deleted successfully!";
            header("Location: ../purchases");
            exit();
        } else {
            // Start session if not started already
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            // Set error message and redirect
            $_SESSION['error'] = "Error occurred while deleting the purchase.";
            header("Location: ../purchases");
            exit();
        }
    } catch (PDOException $e) {
        // Handle errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // If no ID is passed in the URL
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['error'] = "Invalid purchase ID.";
    header("Location: ../purchases");
    exit();
}
?>
