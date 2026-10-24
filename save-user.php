<?php
include "dbh.php";

// Sanitize & collect form data
$first_name = $conn->real_escape_string($_POST['first_name']);
$surname    = $conn->real_escape_string($_POST['surname']);
$username   = $conn->real_escape_string($_POST['username']);
$email      = $conn->real_escape_string($_POST['email']);
$phone      = $conn->real_escape_string($_POST['phone']);
$password   = $conn->real_escape_string($_POST['password']);
$role       = "Architect";

// Step 1: Check if username exists
$username_check_sql = "SELECT id FROM users WHERE username = ?";
$username_stmt = $conn->prepare($username_check_sql);
$username_stmt->bind_param("s", $username);
$username_stmt->execute();
$username_stmt->store_result();

if ($username_stmt->num_rows > 0) {
  echo "<script>alert('❌ Username already taken!'); window.history.back();</script>";
  $username_stmt->close();
  $conn->close();
  exit();
}
$username_stmt->close();

// Step 2: Check if email exists
$email_check_sql = "SELECT id FROM users WHERE email = ?";
$email_stmt = $conn->prepare($email_check_sql);
$email_stmt->bind_param("s", $email);
$email_stmt->execute();
$email_stmt->store_result();

if ($email_stmt->num_rows > 0) {
  echo "<script>alert('❌ Email already registered!'); window.history.back();</script>";
  $email_stmt->close();
  $conn->close();
  exit();
}
$email_stmt->close();

// Step 3: Insert new user
$insert_sql = "INSERT INTO users (role, first_name, surname, username, email, phone, password) 
               VALUES (?, ?, ?, ?, ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("sssssss", $role, $first_name, $surname, $username, $email, $phone, $password);

if ($insert_stmt->execute()) {
  // Only create a folder if the role is "Architect"
  if ($role == 'Architect') {
    $username_folder = "gallery/" . $username;  // Path where the folder will be created (change 'gallery' to your desired directory)
    
    if (!file_exists($username_folder)) {
      if (mkdir($username_folder, 0777, true)) {
        echo "<script>alert('✅ Registered successfully! Folder created for your username.'); window.location.href = 'login.php';</script>";
      } else {
        echo "<script>alert('❌ Error: Folder creation failed!'); window.history.back();</script>";
      } 
    } else {
      echo "<script>alert('✅ Registered successfully! Folder already exists.'); window.location.href = 'login.php';</script>";
    }
  } else {
    echo "<script>alert('✅ Registered successfully!'); window.location.href = 'login.php';</script>";
  }
} else {
  echo "<script>alert('❌ Error: " . $insert_stmt->error . "'); window.history.back();</script>";
}

$insert_stmt->close();
$conn->close();
?>
