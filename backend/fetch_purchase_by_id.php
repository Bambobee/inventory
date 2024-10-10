<?php
include __DIR__ . '/../db_conn.php';

if (isset($purchaseId)) {
    try {
        // Prepare the SQL statement to fetch the purchase details along with product prices
        $stmt = $conn->prepare("
            SELECT p.*, pr.selling_price 
            FROM purchase p
            JOIN product pr ON FIND_IN_SET(pr.id, p.product_id) > 0
            WHERE p.id = :purchaseId
        ");
        $stmt->execute([':purchaseId' => $purchaseId]);

        // Fetch the purchase data
        $purchaseData = $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll to get all results

        if ($purchaseData) {
            // Assuming the columns in your purchase table are named correctly
            $date = $purchaseData[0]['date']; // Fetch the date
            $supplier_id = $purchaseData[0]['supplier_id']; // Fetch the supplier ID
            $shipping = $purchaseData[0]['shipping']; // Fetch the shipping cost
            $tax = $purchaseData[0]['tax']; // Fetch the tax amount
            $details = $purchaseData[0]['details']; // Fetch the purchase details
            $discount = $purchaseData[0]['discount']; // Fetch the discount amount
            $grand_total = $purchaseData[0]['grand_total']; // Fetch the grand total
            
            // Initialize arrays for products, quantities, and sub-totals
            $product_ids = explode(',', $purchaseData[0]['product_id']); // Assuming 'product_id' is a comma-separated string
            $quantities = explode(',', $purchaseData[0]['qty']); // Assuming 'qty' is a comma-separated string
            $sub_totals = explode(',', $purchaseData[0]['sub_total']); // Assuming 'sub_total' is a comma-separated string

            // Fetching product prices from the result set
            $product_prices = [];
            foreach ($purchaseData as $data) {
                $product_prices[] = $data['selling_price']; // Get the selling price for each product
            }

            // Now you have arrays for product prices
        } else {
            // Handle case where no purchase is found
            echo "No purchase found with the specified ID.";
        }
    } catch (PDOException $ex) {
        echo "Error fetching purchase data: " . $ex->getMessage();
    }
} else {
    echo "Purchase ID is not set.";
}
?>
