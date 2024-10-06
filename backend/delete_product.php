<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the account ID
    $account_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM product WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind the account ID parameter
        $stmt->bindParam(':id', $account_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "product deleted successfully!";
            header("Location: ../productsgit a");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while deleting the product.";
            header("Location: ../productsgit a");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    session_start();
    $_SESSION['error'] = "Invalid product ID.";
    header("Location: ../productsgit a");
}
?>
