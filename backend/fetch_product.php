<?php
include __DIR__ . '/../db_conn.php';

// Function to fetch product details with Supplier Name
function fetchProduct($conn) {
    try {
        // Join product with supplier table to get supplier name
        $stmt = $conn->prepare("SELECT p.*, s.name AS supplier_name 
                                FROM product p 
                                JOIN supplier s ON p.supplier_id = s.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch product data
$products = fetchProduct($conn);
?> 