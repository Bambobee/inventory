<?php
include __DIR__ . '/../db_conn.php';

// Function to fetch low stock with product name
function fetchLowStock($conn) {
    try {
        // Join Stock with product table to get product name and filter low stock
        $stmt = $conn->prepare("SELECT a.*, d.name as product_name
                                FROM stock a
                                JOIN product d ON a.product_id = d.id
                                WHERE a.stock_level <= a.stock_alert_level");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch Low Stock data
$lowStocks = fetchLowStock($conn);
?>
