<?php
// Include database connection
require_once '../db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the account ID
    $account_id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM accounts WHERE id = :id";

    try {
        $stmt = $conn->prepare($sql);

        // Bind the account ID parameter
        $stmt->bindParam(':id', $account_id, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            session_start();
            $_SESSION['success'] = "Account deleted successfully!";
            header("Location: ../account");
        } else {
            session_start();
            $_SESSION['error'] = "Error occurred while deleting the account.";
            header("Location: ../account");
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    session_start();
    $_SESSION['error'] = "Invalid account ID.";
    header("Location: ../account");
}
?>
