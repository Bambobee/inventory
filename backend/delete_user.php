<?php
include __DIR__ . '/../db_conn.php'; // include your database connection file
session_start(); // start the session to display success/error messages

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Fetch the user's data, including the image path
    try {
        // Prepare the SQL statement to fetch the user record
        $stmt = $conn->prepare("SELECT image FROM users WHERE id = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as associative array

        if ($user) {
            // Check if the image exists and delete it
            $imagePath = __DIR__ . '/../uploads/users/' . $user['image'];
            if (!empty($user['image']) && file_exists($imagePath)) {
                unlink($imagePath); // delete the image from the server
            }

            // Delete the user record from the database
            $deleteStmt = $conn->prepare("DELETE FROM users WHERE id = :id");
            $deleteStmt->bindParam(':id', $user_id, PDO::PARAM_INT);
            if ($deleteStmt->execute()) {
                $_SESSION['success'] = "User and associated image deleted successfully!";
            } else {
                $_SESSION['error'] = "Failed to delete user!";
            }
        } else {
            $_SESSION['error'] = "User not found!";
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    // Redirect back to the users list page
    header("Location: ../user");
    exit();
} else {
    $_SESSION['error'] = "No user ID provided!";
    header("Location: ../user");
    exit();
}
?>
