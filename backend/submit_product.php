<?php
// Include database connection file
include '../db_conn.php';

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and trim to remove unnecessary spaces
    $name = trim($_POST['name']);
    $category = trim($_POST['category']);
    $product_cost = trim($_POST['product_cost']);
    $selling_price = trim($_POST['selling_price']);
    $unit = trim($_POST['unit']);
    $status = trim($_POST['status']);

    // Start session to store messages
    session_start();

    // Validate inputs to check if any of the required fields are empty
    if (empty($name) || empty($category) || empty($product_cost) || empty($selling_price) || empty($unit) || empty($status)) {
        $_SESSION['error'] = "All fields are required!";
        header("Location: ../products"); // Redirect back to the form page
        exit();
    }

    try {
        // Prepare the SQL statement to insert the product into the database
        $sql = "INSERT INTO product (name, category, product_cost, selling_price,  unit, status) 
                VALUES (:name, :category, :product_cost, :selling_price, :unit, :status)";
        
        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the values
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':product_cost', $product_cost);
        $stmt->bindParam(':selling_price', $selling_price);
        $stmt->bindParam(':unit', $unit);
        $stmt->bindParam(':status', $status);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success'] = "Product added successfully!";
            header("Location: ../products"); // Redirect to a success page
            exit();
        } else {
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
