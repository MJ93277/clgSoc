<?php
session_start();
include "dbh.php";

// Get email and password from form
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

// Query to check if user exists with provided email and password
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password);

//------------------


// $sql = "SELECT * FROM users WHERE username = ? AND password = ?";

// $stmt = $conn->prepare($sql);

// if ($stmt === false) {
//     die("SQL Prepare Error: " . $conn->error);
// }

// $stmt->bind_param("ss", $username, $password);
// $stmt->execute();

//------------------




$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // User found
    $user = $result->fetch_assoc();

    // Set session variables
    $_SESSION['user_id']    = $user['id'];
    $_SESSION['username']   = $user['username'];
    $_SESSION['role']       = $user['role'];
    $_SESSION['first_name'] = $user['first_name'];

    // Redirect based on role
    if ($user['role'] === 'Architect') {
        echo "<script>window.location.href = 'userindex.php';</script>";
    } elseif ($user['role'] === 'Client') {
        echo "<script>window.location.href = 'cuser.php';</script>";
    } else {
        // Unknown role
        echo "<script>alert('❌ Unknown user role'); window.history.back();</script>";
    }
} else {
    // Invalid credentials
    echo "<script>alert('❌ Invalid username or password'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
