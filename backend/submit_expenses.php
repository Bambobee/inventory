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

    // Generate a random expense reference in the format EXP_number
    $exp_ref = 'EXP_' . mt_rand(100000, 999999);

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

    // Only proceed if the file upload was successful
    if ($upload_ok == 1) {
        try {
            // Start a transaction
            $conn->beginTransaction();

            // Step 1: Fetch the current balance from the account
            $balance_stmt = $conn->prepare("SELECT balance FROM accounts WHERE id = :acc_id");
            $balance_stmt->bindParam(':acc_id', $acc_id, PDO::PARAM_INT);
            $balance_stmt->execute();
            $account = $balance_stmt->fetch(PDO::FETCH_ASSOC);

            if ($account) {
                $current_balance = $account['balance'];

                // Step 2: Check if the amount exceeds the current balance
                if ($amount > $current_balance) {
                    // Insufficient balance
                    $_SESSION['error'] = "Insufficient balance. Your current balance is " . $current_balance;
                    $conn->rollBack();
                } else {
                    // Step 3: Proceed with the expense submission and balance deduction
                    $sql = "INSERT INTO expenses (acc_id, amount, exp_ref, date_of_payment, payment_method, proof, description) 
                            VALUES (:acc_id, :amount, :exp_ref, :date_of_payment, :payment_method, :proof, :description)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':acc_id' => $acc_id,
                        ':amount' => $amount,
                        ':exp_ref' => $exp_ref,
                        ':date_of_payment' => $date_of_payment,
                        ':payment_method' => $payment_method,
                        ':proof' => $image_file, // Save the image file path in the database
                        ':description' => $description
                    ]);

                    // Step 4: Update account balance by deducting the expense amount
                    $update_sql = "UPDATE accounts SET balance = balance - :amount WHERE id = :acc_id";
                    $update_stmt = $conn->prepare($update_sql);
                    $update_stmt->execute([
                        ':amount' => $amount,
                        ':acc_id' => $acc_id
                    ]);

                    // Commit transaction
                    $conn->commit();

                    // Success message
                    $_SESSION['success'] = "Expense submitted successfully!";
                }
            } else {
                $_SESSION['error'] = "Account not found.";
                $conn->rollBack();
            }

        } catch (PDOException $e) {
            // Rollback in case of error
            $conn->rollBack();
            $_SESSION['error'] = "Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = $image_status;
    }

    // Redirect after submission
    header('Location: ../expenses');
    exit;
}
?>
