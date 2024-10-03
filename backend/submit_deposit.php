<?php
session_start();
// Include database connection
require_once '../db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $acc_id = $_POST['acc_id'];
    $amount = $_POST['amount'];
    $date_of_payment = $_POST['date_of_payment'];
    $payment_method = $_POST['payment_method'];
    $description = $_POST['description'];

    // Generate a random deposit reference in the format DEP_number
    $deposit_ref = 'DEP_' . mt_rand(100000, 999999);

    // File upload handling
    $image_dir = 'Upload/proof/';
    
    // Check if the directory exists, if not create it
    if (!is_dir($image_dir)) {
        mkdir($image_dir, 0777, true); // Create directory with write permissions
    }

    $image_file = $image_dir . basename($_FILES['image']['name']);
    $upload_ok = 1;
    $file_type = strtolower(pathinfo($image_file, PATHINFO_EXTENSION));

    // Check if file is an actual image or PDF
    if (isset($_FILES['image'])) {
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false || $file_type == "pdf") {
            // File is valid
            if (move_uploaded_file($_FILES['image']['tmp_name'], $image_file)) {
                $image_status = "File uploaded successfully.";
            } else {
                $image_status = "File upload failed.";
                $upload_ok = 0;
            }
        } else {
            $image_status = "File is not an image or PDF.";
            $upload_ok = 0;
        }
    }

    // Insert deposit data into the 'deposit' table only if upload is OK
    if ($upload_ok == 1) {
        try {
            // Begin transaction
            $conn->beginTransaction();

            // Insert deposit details including the image file path
            $sql = "INSERT INTO deposit (acc_id, amount, deposit_ref, date_of_payment, payment_method, proof, description) 
                    VALUES (:acc_id, :amount, :deposit_ref, :date_of_payment, :payment_method, :proof, :description)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':acc_id' => $acc_id,
                ':amount' => $amount,
                ':deposit_ref' => $deposit_ref,
                ':date_of_payment' => $date_of_payment,
                ':payment_method' => $payment_method,
                ':proof' => $image_file, // Save the image file path in the database
                ':description' => $description
            ]);

            // Update account balance by incrementing with the deposit amount
            $update_sql = "UPDATE accounts SET balance = balance + :amount WHERE id = :acc_id";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->execute([
                ':amount' => $amount,
                ':acc_id' => $acc_id
            ]);

            // Commit transaction
            $conn->commit();

            // Success message
            $_SESSION['success'] = "Deposit submitted successfully!";
        } catch (PDOException $e) {
            // Rollback in case of error
            $conn->rollBack();
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = $image_status;
    }

    // Redirect after submission
    header('Location: ../deposit');
    exit;
}
?>
