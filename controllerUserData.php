<?php
session_start();
require "db_conn.php"; // Use the PDO connection here
$email = "";
$name = "";
$errors = array();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

// if user clicks continue button in forgot password form
if (isset($_POST['check-email'])) {
    $email = $_POST['email'];

    // Prepared statement to prevent SQL Injection
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $check_email->bindParam(':email', $email);
    $check_email->execute();

    if ($check_email->rowCount() > 0) {
        $code = rand(999999, 111111);
        $insert_code = $conn->prepare("UPDATE users SET code = :code WHERE email = :email");
        $insert_code->bindParam(':code', $code);
        $insert_code->bindParam(':email', $email);

        if ($insert_code->execute()) {
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";

            $mail = new PHPMailer(true);

            try {
                // Enable verbose debug output (comment out for production)
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;  // Set to 0 to disable debug in production

                // Send using SMTP
                $mail->isSMTP();

                // Set the SMTP server to send through
                $mail->Host = 'smtp.gmail.com';

                // Enable SMTP authentication
                $mail->SMTPAuth = true;

                // SMTP username
                $mail->Username = 'rickrambo29@gmail.com';

                // SMTP password
                $mail->Password = 'phgtqljdlwsukzsx';

                // Enable TLS encryption; `PHPMailer::ENCRYPTION_STARTTLS` encouraged
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

                // TCP port to connect to
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('rickrambo29@gmail.com', 'Shop');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $message;

                // Send email
                $mail->send();

                // Success message and session setup
                $info = "We've sent a password reset OTP to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: reset-code');
                exit();
            } catch (Exception $e) {
                // Handle errors with sending mail
                $errors['otp-error'] = "Failed while sending code! Mailer Error: " . $mail->ErrorInfo;
            }
        } else {
            $errors['db-error'] = "Something went wrong!";
        }
    } else {
        $errors['email'] = "This email address does not exist!";
    }
}


// if user clicks check reset OTP button
if (isset($_POST['check-reset-otp'])) {
    $_SESSION['info'] = "";
    $otp_code = $_POST['otp'];
    $check_code = $conn->prepare("SELECT * FROM users WHERE code = :otp_code");
    $check_code->bindParam(':otp_code', $otp_code);
    $check_code->execute();

    if ($check_code->rowCount() > 0) {
        $fetch_data = $check_code->fetch();
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    } else {
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

// if user clicks change password button
if (isset($_POST['change-password'])) {
    $_SESSION['info'] = "";
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password !== $cpassword) {
        $errors['password'] = "Confirm password does not match!";
    } else {
        $code = 0;
        $email = $_SESSION['email']; // getting this email using session
        $encpass = password_hash($password, PASSWORD_BCRYPT);

        $update_pass = $conn->prepare("UPDATE users SET code = :code, password = :password WHERE email = :email");
        $update_pass->bindParam(':code', $code);
        $update_pass->bindParam(':password', $encpass);
        $update_pass->bindParam(':email', $email);

        if ($update_pass->execute()) {
            $info = "Your password has been changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
            exit();
        } else {
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

// if login now button clicked
if (isset($_POST['login-now'])) {
    header('Location: index.php');
}


if (isset($_POST['login'])) {
    // Escape email and password inputs
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query to check if the email exists
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    // Check if a user with this email exists
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch();
        $hashed_password = $user['password']; // Hashed password from the database

        // Verify the password entered with the hashed password from the database
        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email;  // Store email in session
            
            // Redirect to dashboard
            header('Location: dashboard');
            exit();
        } else {
            $errors['login'] = "Incorrect email or password!";
        }
    } else {
        $errors['login'] = "It looks like you're not a member!";
    }
}


?>