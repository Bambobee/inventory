<?php
// Use absolute path to avoid issues with relative path
include __DIR__ . '/../db_conn.php';

// Function to fetch suppliers with their total due amounts
function fetchSupplierWithTotalDue($conn) {
    try {
        $stmt = $conn->prepare("
            SELECT supplier.*, 
                   SUM(purchase.due) AS total_due
            FROM supplier
            LEFT JOIN purchase ON supplier.id = purchase.supplier_id
            GROUP BY supplier.id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch supplier data with total due amounts
$suppliers = fetchSupplierWithTotalDue($conn) ?? [];
?>
