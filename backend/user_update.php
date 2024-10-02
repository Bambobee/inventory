<?php
include __DIR__ . '/../db_conn.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $date = $_POST['date'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $address = $_POST['address'];

    // Fetch the current user data to check the current image
    $stmt = $conn->prepare("SELECT image FROM users WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch();

    // Check if a new image is uploaded
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
        $target_dir = "uploads/users/"; // Change to your desired upload directory
        $new_image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $new_image_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Allow only specific file formats (optional)
        $allowed_types = ['jpg', 'png', 'jpeg', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit;
        }
      
        // Check if file upload is successful
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Delete the old image if it exists
            if (file_exists("uploads/users/" . $user['image']) && !empty($user['image'])) {
                unlink("uploads/users/" . $user['image']);
            }

            // Prepare to update the new image in the database
            $image_path = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    } else {
        // If no new image, keep the old one
        $image_path = $user['image'];
    }

    // Update the user data in the database
    $sql = "UPDATE users SET name = :name, email = :email, contact = :contact, date = :date, role = :role, status = :status, address = :address, image = :image WHERE id = :id";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':image', $image_path);

    // Execute the update
    if ($stmt->execute()) {
        // Redirect back with a success message
        session_start();
        $_SESSION['success'] = "User data updated successfully!";
        header('Location: ../user');
    } else {
        echo "Error updating record.";
    }
}
?>
