<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the account ID
    $account_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM stock WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind the account ID parameter
        $stmt->bindParam(':id', $account_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "stock deleted successfully!";
            header("Location: ../stock_levels");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while deleting the stock.";
            header("Location: ../stock_levels");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    session_start();
    $_SESSION['error'] = "Invalid stock ID.";
    header("Location: ../stock_levels");
}
?>
