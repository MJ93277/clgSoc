<?php
session_start();
require 'dbh.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Session expired. Please log in again.'); window.location.href = 'login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $availability = $_POST['availability'] ?? '';
    $preferred_project_type = $_POST['preferred_project_type'] ?? '';
    $state = $_POST['state'] ?? '';
    $city = $_POST['city'] ?? '';
    $willing_to_relocate = $_POST['willing_to_relocate'] ?? '';

    if (empty($availability) || empty($preferred_project_type) || empty($state) || empty($city) || empty($willing_to_relocate)) {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
        exit();
    }

    // Check if record already exists
    $checkStmt = $conn->prepare("SELECT availability_preferences_id FROM availability_preferences WHERE user_id = ?");
    $checkStmt->bind_param("i", $user_id);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        // Record exists, so UPDATE
        $updateStmt = $conn->prepare("UPDATE availability_preferences SET availability = ?, preferred_project_type = ?, state = ?, city = ?, willing_to_relocate = ? WHERE user_id = ?");
        $updateStmt->bind_param("sssssi", $availability, $preferred_project_type, $state, $city, $willing_to_relocate, $user_id);

        if ($updateStmt->execute()) {
            echo "<script>alert('Availability & Preferences Updated Successfully!'); window.location.href='upload-post.php';</script>";
        } else {
            echo "<script>alert('Error updating your preferences. Please try again.'); window.history.back();</script>";
        }

        $updateStmt->close();
    } else {
        // No record, so INSERT
        $insertStmt = $conn->prepare("INSERT INTO availability_preferences (user_id, availability, preferred_project_type, state, city, willing_to_relocate) VALUES (?, ?, ?, ?, ?, ?)");
        $insertStmt->bind_param("isssss", $user_id, $availability, $preferred_project_type, $state, $city, $willing_to_relocate);

        if ($insertStmt->execute()) {
            echo "<script>alert('Availability & Preferences Saved Successfully!'); window.location.href='upload-post.php';</script>";
        } else {
            echo "<script>alert('Error saving your preferences. Please try again.'); window.history.back();</script>";
        }

        $insertStmt->close();
    }

    $checkStmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid access.'); window.location.href='availability.php';</script>";
}
?>
