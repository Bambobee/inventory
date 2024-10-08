<?php
include __DIR__ . '/../db_conn.php';

// Function to fetch expired stock with product name
function fetchExpiredStock($conn) {
    try {
        // Join Stock with product table to get product name and filter expired stock
        $stmt = $conn->prepare("SELECT a.*, d.name as product_name
                                FROM stock a
                                JOIN product d ON a.product_id = d.id
                                WHERE a.expiry_date < CURDATE()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch Expired Stock data
$expiredStocks = fetchExpiredStock($conn);
?>
