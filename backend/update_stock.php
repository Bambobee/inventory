<?php
include __DIR__ . '/../db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the POST data and sanitize it
    $id = $_POST['id'];
    $stock_id = htmlspecialchars($_POST['stock_id']);
    $product_id = htmlspecialchars($_POST['product_id']);
    $stock_level = htmlspecialchars($_POST['stock_level']);
    $stock_alert_level = htmlspecialchars($_POST['stock_alert_level_figure']);
    $expiry_date = htmlspecialchars($_POST['expiry_date']);
    $created_at = htmlspecialchars($_POST['created_at']);

    // Validate the input data as needed (e.g., check if the fields are not empty)
    if (!empty($id) && !empty($stock_id) && !empty($product_id) && !empty($stock_level) && !empty($stock_alert_level)) {
        try {
            // Prepare the update statement
            $stmt = $conn->prepare("UPDATE stock 
                                    SET stock_id = :stock_id,
                                        product_id = :product_id,
                                        stock_level = :stock_level,
                                        stock_alert_level = :stock_alert_level,
                                        expiry_date = :expiry_date,
                                        created_at = :created_at
                                    WHERE id = :id");

            // Bind the parameters to the query
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':stock_id', $stock_id, PDO::PARAM_STR);
            $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt->bindParam(':stock_level', $stock_level, PDO::PARAM_INT);
            $stmt->bindParam(':stock_alert_level', $stock_alert_level, PDO::PARAM_INT);
            $stmt->bindParam(':expiry_date', $expiry_date, PDO::PARAM_STR);
            $stmt->bindParam(':created_at', $created_at, PDO::PARAM_STR);

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect with success message (session-based or query string-based)
                session_start();
                $_SESSION['success'] = "Stock updated successfully!";
                header("Location: ../stock_levels"); // Replace with the page where the form is located
                exit();
            } else {
                // Handle case where the update failed
                session_start();
                $_SESSION['error'] = "Failed to update stock.";
                header("Location: ../stock_levels");
                exit();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Handle validation errors
        session_start();
        $_SESSION['error'] = "Please fill out all required fields.";
        header("Location: ../stock_levels");
        exit();
    }
} else {
    // If the request is not POST, redirect back
    header("Location: ../stock_levels");
    exit();
}
