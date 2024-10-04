<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the suppliers ID
    $supplier_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM supplier WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind the suppliers ID parameter
        $stmt->bindParam(':id', $supplier_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "supplier deleted successfully!";
            header("Location: ../suppliers");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while deleting the supplier.";
            header("Location: ../suppliers");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    session_start();
    $_SESSION['error'] = "Invalid supplier ID.";
    header("Location: ../suppliers");
}
?>
