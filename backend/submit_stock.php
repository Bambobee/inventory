<?php
session_start(); // Start the session to store messages
require '../db_conn.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $stock_id = !empty($_POST['stock_id']) ? trim($_POST['stock_id']) : null;
    $product_id = !empty($_POST['product_id']) ? intval($_POST['product_id']) : null;
    $stock_level = !empty($_POST['stock_level']) ? intval($_POST['stock_level']) : null;
    $stock_alert_level = !empty($_POST['stock_alert_level_figure']) ? intval($_POST['stock_alert_level_figure']) : null;
    $expiry_date = !empty($_POST['expiry_date']) ? $_POST['expiry_date'] : null;
    $created_at = !empty($_POST['created_at']) ? $_POST['created_at'] : null;

    // Check if the required fields are filled
    if ($stock_id && $product_id && $stock_level && $stock_alert_level && $expiry_date && $created_at) {
        try {
            // Check if the combination of product_id and stock_id already exists
            $check_sql = "SELECT COUNT(*) FROM stock WHERE product_id = :product_id AND stock_id = :stock_id";
            $check_stmt = $conn->prepare($check_sql);
            $check_stmt->bindParam(':product_id', $product_id);
            $check_stmt->bindParam(':stock_id', $stock_id);
            $check_stmt->execute();

            $count = $check_stmt->fetchColumn();

            if ($count > 0) {
                // Error message if the record already exists
                $_SESSION['error'] = "This stock entry with the same product ID and stock ID already exists.";
            } else {
                // Prepare SQL statement for inserting data
                $sql = "INSERT INTO stock (stock_id, product_id, stock_level, stock_alert_level, expiry_date, created_at) 
                        VALUES (:stock_id, :product_id, :stock_level, :stock_alert_level, :expiry_date, :created_at)";

                $stmt = $conn->prepare($sql);

                // Bind parameters
                $stmt->bindParam(':stock_id', $stock_id);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':stock_level', $stock_level);
                $stmt->bindParam(':stock_alert_level', $stock_alert_level);
                $stmt->bindParam(':expiry_date', $expiry_date);
                $stmt->bindParam(':created_at', $created_at);

                // Execute the statement
                $stmt->execute();

                // Success message
                $_SESSION['success'] = "Stock successfully added!";
            }
        } catch (PDOException $ex) {
            // Error message
            $_SESSION['error'] = "Error adding stock: " . $ex->getMessage();
        }
    } else {
        // Error message for missing required fields
        $_SESSION['error'] = "Please fill in all required fields.";
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
}

// Redirect back to the form page
header("Location: ../stock_levels");
exit();
?>
