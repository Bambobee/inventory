<?php
// Start the session
session_start();

// Include database connection file
require_once '../db_conn.php';

// Define the folder to store images
$imageDirectory = 'uploads/users/';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    $date = htmlspecialchars($_POST['date']);
    $role = htmlspecialchars($_POST['role']);
    $status = htmlspecialchars($_POST['status']);
    $address = htmlspecialchars($_POST['address']);
    
    // Check if email already exists
    try {
        $emailCheckQuery = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $conn->prepare($emailCheckQuery);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $emailCount = $stmt->fetchColumn();

        if ($emailCount > 0) {
            $_SESSION['error'] = "Email already exists. Please use a different email.";
            header("Location: ../user");
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = "Database error: " . $e->getMessage();
        header("Location: ../user");
        exit();
    }

    // Handle the image upload
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Check if the image directory exists, if not, create it
        if (!is_dir($imageDirectory)) {
            mkdir($imageDirectory, 0777, true); // Create directory with permissions
        }
        
        // Store image to the specified folder
        $imagePath = $imageDirectory . basename($_FILES['image']['name']);
        
        // Move the uploaded file to the folder
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $image = $imagePath; // Store the image path in the database
        } else {
            $_SESSION['error'] = "Failed to upload image.";
            header("Location: ../user");
            exit();
        }
    }

    try {
        // Prepare the SQL query with placeholders
        $sql = "INSERT INTO users (name, email, contact, date, role, status, address, image) 
                VALUES (:name, :email, :contact, :date, :role, :status, :address, :image)";
        $stmt = $conn->prepare($sql);
        
        // Bind parameters to the placeholders
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':image', $image);
        
        // Execute the query
        if ($stmt->execute()) {
            // Set success message in the session
            $_SESSION['success'] = "User added successfully!";
        } else {
            $_SESSION['error'] = "Failed to add user. Please try again.";
        }
    } catch (PDOException $e) {
        // Catch and handle any errors
        $_SESSION['error'] = "Database error: " . $e->getMessage();
    }

    // Redirect to the form page to display the message
    header("Location: ../user");
    exit();
}
?>
