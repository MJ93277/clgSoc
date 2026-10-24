<?php

session_start();

include "dbh.php";


// 2. Get data from user form
$user_id = $_SESSION['user_id'];


// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
  // die('User not logged in.');
  echo "<script>alert('BYE BYE '); window.location.href = 'login.php';</script>";
}

$linkedin = $_POST['linkedin'];
$facebook = $_POST['facebook'];
$instagram = $_POST['instagram'];


$sql = "SELECT * FROM social_links WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 2. If record exists, UPDATE
    $sql = "UPDATE social_links 
            SET linkedin = ?, facebook = ?, instagram = ?
            WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssi", 
        $linkedin, $facebook, $instagram, $user_id
    );
    if ($stmt->execute()) {
        echo "<script>alert('Saved successfully!'); window.location.href = 'availability.php';</script>";
      } else {
        echo "<script>alert('❌ Error: " . $insert_stmt->error . "'); window.history.back();</script>";
      }
    // $stmt->execute();
} else {
    // 3. If no record, INSERT
    $sql = "INSERT INTO social_links (
                user_id, linkedin, facebook, instagram
            ) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isss", 
        $user_id, $linkedin, $facebook, $instagram
    );if ($stmt->execute()) {
        echo "<script>alert('Saved successfully!'); window.location.href = 'availability.php';</script>";
      } else {
        echo "<script>alert('❌ Error: " . $insert_stmt->error . "'); window.history.back();</script>";
      }
    // $stmt->execute();
}
?>
