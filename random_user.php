<?php
// random_user.php

$conn = new mysqli('localhost', 'root', '', 'urarchitect');

if ($conn->connect_error) {
    die(json_encode(['error' => 'Database connection failed']));
}

// Fetch 1 random user
$sql = "SELECT first_name FROM users ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    echo json_encode([
        'name' => $user['first_name']
    ]);
} else {
    echo json_encode(['error' => 'No user found']);
}

$conn->close();
?>
