<?php
session_start(); // Start the session to store messages

// Include the database connection file
require_once '../db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the payment method title from the form
    $title = trim($_POST['title']);

    // Validate the input
    if (empty($title)) {
        // Store an error message in the session and redirect back to the form
        $_SESSION['error'] = "Payment Method is required.";
        header("Location: ../payment_method"); // Change to your form page
        exit();
    }

    try {
        // Prepare an SQL statement to insert the payment method into the database
        $sql = "INSERT INTO payment_method (title) VALUES (:title)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);

        // Execute the statement
        if ($stmt->execute()) {
            // Store a success message in the session and redirect back to the form
            $_SESSION['success'] = "Payment Method added successfully.";
        } else {
            // Store an error message in the session if the query fails
            $_SESSION['error'] = "Failed to add Payment Method.";
        }
    } catch (PDOException $ex) {
        // Catch any errors and store them in the session
        $_SESSION['error'] = "Error: " . $ex->getMessage();
    }

    // Redirect back to the form page
    header("Location: ../payment_method");
    exit();
} else {
    // Redirect if the form is not submitted via POST
    header("Location: ../payment_method");
    exit();
}
?>
