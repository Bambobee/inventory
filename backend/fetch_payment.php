<?php
// Use absolute path to avoid issues with relative path
include __DIR__ . '/../db_conn.php';

// Function to fetch users
function fetchPayment($conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM payment_method");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch user data
$payment_methods = fetchPayment($conn) ?? [];
?>
