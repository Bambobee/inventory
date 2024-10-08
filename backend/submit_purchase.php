<?php
session_start(); // Start the session
include '../db_conn.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate purchase ID in the form 'PUR_figure'
    $purchase_id = 'PUR_' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
    
    // Collect form data
    $date = $_POST['date'];
    $supplier_id = $_POST['supplier_id'];
    $product_ids = $_POST['product_id']; // Array
    $qtys = $_POST['qty']; // Array
    $sub_totals = $_POST['sub_total']; // Array
    $grand_total = $_POST['grand_total'];
    $shipping = $_POST['shipping'];
    $details = $_POST['details'];
    $discount = $_POST['discount'];
    $tax = $_POST['tax'];
    $due = $_POST['due'];
    
    // Convert arrays to comma-separated strings
    $product_ids_str = implode(',', $product_ids);
    $qtys_str = implode(',', $qtys);
    $sub_totals_str = implode(',', $sub_totals);

    // Insert data into the database
    try {
        $sql = "INSERT INTO purchase 
                (purchase_id, date, supplier_id, product_id, qty, sub_total, grand_total, shipping, details, discount, tax,payment_status,paid_amount,due)
                VALUES 
                (:purchase_id, :date,  :supplier_id, :product_id, :qty, :sub_total, :grand_total, :shipping, :details, :discount, :tax,'Unpaid',0,:due)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':purchase_id' => $purchase_id,
            ':date' => $date,
            ':supplier_id' => $supplier_id,
            ':product_id' => $product_ids_str,
            ':qty' => $qtys_str,
            ':sub_total' => $sub_totals_str,
            ':grand_total' => $grand_total,
            ':shipping' => $shipping,
            ':details' => $details,
            ':discount' => $discount,
            ':tax' => $tax,
            ':due' => $due
        ]);

        // Set a success message in the session
        $_SESSION['success'] = "Purchase added successfully!";
        
    } catch (PDOException $e) {
        // Set an error message in the session
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    // Redirect to purchase.php
    header('Location: ../purchases');
    exit();
}
?>