<?php
include '../db_conn.php';

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    
    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT selling_price FROM product WHERE id = :product_id");
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch();

    if ($result) {
        echo json_encode(['selling_price' => $result['selling_price']]);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
}
