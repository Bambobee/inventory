<?php
include __DIR__ . '/../db_conn.php';

// Function to fetch purchases with supplier name and optionally account number
function fetchPurchase($conn) {
    try {
        // Left join purchase with supplier and accounts table
        $stmt = $conn->prepare("SELECT p.*, s.name as supplier_name, a.acc_number
                                FROM purchase p
                                JOIN supplier s ON p.supplier_id = s.id
                                LEFT JOIN accounts a ON p.acc_id = a.id"); // LEFT JOIN ensures all purchase records are fetched
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch purchase data
$purchases = fetchPurchase($conn);
?>
