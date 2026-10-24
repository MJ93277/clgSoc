<?php
session_start();

include "dbh.php";
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Session expired. Please log in again.'); window.location.href = 'login.php';</script>";
    exit();
}

// Validate and process file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['post']) && isset($_POST['description'])) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
    $description = trim($_POST['description']);

    $file = $_FILES['post'];
    $file_name = basename($file['name']);
    $file_tmp = $file['tmp_name'];
    $file_size = $file['size'];
    $file_type = mime_content_type($file_tmp);

    // Allowed types
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg', 'video/mp4', 'video/quicktime', 'video/x-msvideo'];
    if (!in_array($file_type, $allowed_types)) {
        die("Unsupported file type.");
    }

    // Optional: limit file size (e.g., 50MB max)
    if ($file_size > 50 * 1024 * 1024) {
        die("File is too large. Max 50MB allowed.");
    }

    // Save the file
    // $upload_dir = "gallery/ . $username";
     $upload_dir = "gallery/" . $username . '/';

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $new_file_name = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $file_name);
    $file_path = $upload_dir . $new_file_name;
    if (move_uploaded_file($file_tmp, $file_path)) {
        // Save record in database
        $stmt = $conn->prepare("INSERT INTO media (user_id, username, file_name, file_path, description) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $username, $file_name, $file_path, $description);

        if ($stmt->execute()) {
            echo "<script>alert('Post uploaded successfully!'); window.location.href = 'upload-post.php';</script>";
        } else {
            echo "Database error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload file.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>
