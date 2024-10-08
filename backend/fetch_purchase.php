<?php
include __DIR__ . '/../db_conn.php';

// Function to fetch purchases with supplier name
function fetchPurchase($conn) {
    try {
        // Join purchase with supplier table to get supplier name
        $stmt = $conn->prepare("SELECT p.*, s.name as supplier_name
                                FROM purchase p
                                JOIN supplier s ON p.supplier_id = s.id"); // Corrected JOIN condition
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
