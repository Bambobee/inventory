<?php
// Include the database connection file
include '../db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];

    // Basic validation (optional)
    if (!empty($id) && !empty($name) && !empty($date) && !empty($description)) {
        try {
            // Prepare the SQL update statement
            $sql = "UPDATE category SET name = :name, date = :date, description = :description WHERE id = :id";
            $stmt = $conn->prepare($sql);

            // Bind the parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':id', $id);

            // Execute the statement
            if ($stmt->execute()) {
                // Set success message and redirect
                $_SESSION['success'] = "Category updated successfully.";
                header("Location: ../category"); // Change this to your categories listing page
                exit();
            } else {
                // Set error message
                $_SESSION['error'] = "Failed to update category. Please try again.";
                header("Location: ../category");
                exit();
            }
        } catch (PDOException $e) {
            // Handle error
            $_SESSION['error'] = "Error: " . $e->getMessage();
            header("Location: ../category");
            exit();
        }
    } else {
        // Set validation error
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../category");
        exit();
    }
} else {
    // Redirect if the request method is not POST
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../category");
    exit();
}
