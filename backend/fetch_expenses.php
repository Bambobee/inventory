<?php
include __DIR__ . '/../db_conn.php';

// Function to fetch Deposit with Account Name
function fetchDeposit($conn) {
    try {
        // Join deposit with account table to get account name
        $stmt = $conn->prepare("SELECT d.*, a.acc_name 
                                FROM expenses d 
                                JOIN accounts a ON d.acc_id = a.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return []; // Return an empty array if there's an error
    }
}

// Fetch deposit data
$expenses = fetchDeposit($conn);
?>
