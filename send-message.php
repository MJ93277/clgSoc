<?php
session_start();
require 'dbh.php'; // Ensure this file connects to your DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_id = intval($_POST['sender_id']);
    $receiver_id = intval($_POST['receiver_id']);
    $message = trim($_POST['message']);

    if ($message !== '') {
        // Insert the message into the database
        $stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
        

        $stmt2 = $conn->prepare("INSERT INTO conversations (client_id, architect_id) VALUES (?, ?)");
        $stmt2->bind_param("ii", $sender_id, $receiver_id);

        $stmt2->execute();

        if ($stmt->execute()) {
            echo "Message sent successfully";  // Return success message for AJAX
        } else {
            echo "Database error: " . $stmt->error;  // Return error message if insert fails
        }

        $stmt->close();
    } else {
        echo "Empty message";  // Return error if message is empty
    }
} else {
    echo "Invalid request";  // Handle invalid request methods
}
?>
