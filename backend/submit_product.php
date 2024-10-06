<?php
// Include database connection file
include '../db_conn.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $category = $_POST['category'];
    $product_cost = $_POST['product_cost'];
    $selling_price = $_POST['selling_price'];
    $supplier_id = $_POST['supplier_id'];
    $unit = $_POST['unit'];
    $status = $_POST['status'];

    try {
        // Prepare the SQL statement to insert the product into the database
        $sql = "INSERT INTO product (name, category, product_cost, selling_price, supplier_id, unit, status) 
                VALUES (:name, :category, :product_cost, :selling_price, :supplier_id, :unit, :status)";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the values
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':product_cost', $product_cost);
        $stmt->bindParam(':selling_price', $selling_price);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->bindParam(':unit', $unit);
        $stmt->bindParam(':status', $status);

        // Execute the statement
        if ($stmt->execute()) {
            // Start session to store success message
            session_start();
            $_SESSION['success'] = "Product added successfully!";
            header("Location: ../products"); // Redirect to a success page
            exit();
        } else {
            // Start session to store error message
            session_start();
            $_SESSION['error'] = "Failed to add product!";
            header("Location: ../products"); // Redirect to an error page
            exit();
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
