<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the units ID
    $unit_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM unit WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind the units ID parameter
        $stmt->bindParam(':id', $unit_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "unit deleted successfully!";
            header("Location: ../units");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while deleting the unit.";
            header("Location: ../units");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    session_start();
    $_SESSION['error'] = "Invalid unit ID.";
    header("Location: ../units");
}
?>
