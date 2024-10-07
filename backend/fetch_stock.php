<?php
include __DIR__ . '/../db_conn.php';

// Function to fetch Stock with Product Name
function fetchStock($conn) {
    try {
        // Join Stock with product table to get product name
        $stmt = $conn->prepare("SELECT a.*, d.name as product_name
                                FROM stock a
                                JOIN product d ON a.product_id = d.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch Stock data
$stocks = fetchStock($conn);
?>
