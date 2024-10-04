<?php
// Start session to store messages
session_start();

// Include the database connection file
require '../db_conn.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $base_unit = $_POST['base_unit'];

    // Valibase_unit input
    if (!empty($name) && !empty($base_unit) ) {
        try {
            // Prepare the SQL query to insert data
            $sql = "INSERT INTO unit (name, base_unit) VALUES (:name, :base_unit)";
            $stmt = $conn->prepare($sql);
            
            // Bind parameters
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':base_unit', $base_unit);
            
            // Execute the query
            if ($stmt->execute()) {
                // Success message in session
                $_SESSION['success'] = "unit added successfully!";
            } else {
                // Error message in session
                $_SESSION['error'] = "Error: Could not execute the query.";
            }
        } catch (PDOException $e) {
            // Error message in session
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    } else {
        // Validation error message in session
        $_SESSION['error'] = "Please fill in all required fields.";
    }
    
    // Redirect back to the form or another page
    header("Location: ../units"); // Change this to the form page or where you want to redirect
    exit();
}
?>
