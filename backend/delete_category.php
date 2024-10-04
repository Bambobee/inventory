<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the categorys ID
    $category_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM category WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind the categorys ID parameter
        $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "category deleted successfully!";
            header("Location: ../category");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while deleting the category.";
            header("Location: ../category");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    session_start();
    $_SESSION['error'] = "Invalid category ID.";
    header("Location: ../category");
}
?>
