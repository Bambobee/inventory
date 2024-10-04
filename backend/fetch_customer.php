<?php
// Use absolute path to avoid issues with relative path
include __DIR__ . '/../db_conn.php';

// Function to fetch users
function fetchCustomer($conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM customer");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch user data
$customers = fetchCustomer($conn) ?? [];
?>
