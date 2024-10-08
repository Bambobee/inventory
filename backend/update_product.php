<?php
// Include the database connection
require_once '../db_conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $product_cost = $_POST['product_cost'];
    $selling_price = $_POST['selling_price'];
    $unit = $_POST['unit'];
    $status = $_POST['status'];

    // Validation: Ensure that required fields are not empty
    if (!empty($id) && !empty($name) && !empty($category) && !empty($product_cost) && !empty($selling_price)  && !empty($unit) && !empty($status)) {
        try {
            // Update query to modify product details in the products table
            $query = "UPDATE product SET 
                name = :name,
                category = :category,
                product_cost = :product_cost,
                selling_price = :selling_price,
                unit = :unit,
                status = :status
                WHERE id = :id";

            // Prepare the statement
            $stmt = $conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR);
            $stmt->bindParam(':product_cost', $product_cost, PDO::PARAM_INT);
            $stmt->bindParam(':selling_price', $selling_price, PDO::PARAM_INT);
            $stmt->bindParam(':unit', $unit, PDO::PARAM_STR);
            $stmt->bindParam(':status', $status, PDO::PARAM_STR);

            // Execute the update statement
            if ($stmt->execute()) {
                // Success message
                session_start();
                $_SESSION['success'] = "Product updated successfully!";
                header('Location: ../products'); // Redirect to a product list or any relevant page
                exit();
            } else {
                // Error message if the query fails
                session_start();
                $_SESSION['error'] = "Failed to update the product.";
                header('Location: ../products'); // Redirect back with an error
                exit();
            }
        } catch (PDOException $e) {
            // Handle any errors
            session_start();
            $_SESSION['error'] = "Error: " . $e->getMessage();
            header('Location: ../products');
            exit();
        }
    } else {
        // Error message if required fields are empty
        session_start();
        $_SESSION['error'] = "Please fill in all the required fields.";
        header('Location: ../products');
        exit();
    }
} else {
    // Redirect if the request method is not POST
    header('Location: ../products');
    exit();
}
