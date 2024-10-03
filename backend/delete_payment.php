<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the account ID
    $account_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM payment_method WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind the account ID parameter
        $stmt->bindParam(':id', $account_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Payment Method deleted successfully!";
            header("Location: ../payment_method");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while deleting the Payment Method.";
            header("Location: ../payment_method");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    session_start();
    $_SESSION['error'] = "Invalid Payment Method ID.";
    header("Location: ../payment_method");
}
?>
