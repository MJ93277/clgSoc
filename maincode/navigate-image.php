<?php
include "dbh.php";

$username = $_POST['username'] ?? '';
$direction = $_POST['direction'] ?? 'next';

if (empty($username)) {
    echo json_encode(["status" => "error", "message" => "Username is missing"]);
    exit;
}

// Get all media for this user
$sql = "SELECT * FROM media WHERE username = ? ORDER BY id";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$mediaList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $mediaList[] = $row;
}

// Store current index in session or use a hidden input (simplified here using session)
session_start();
if (!isset($_SESSION['media_index'][$username])) {
    $_SESSION['media_index'][$username] = 0;
}
$currentIndex = $_SESSION['media_index'][$username];

if ($direction === 'next') {
    $currentIndex = ($currentIndex + 1) % count($mediaList);
} elseif ($direction === 'prev') {
    $currentIndex = ($currentIndex - 1 + count($mediaList)) % count($mediaList);
}

$_SESSION['media_index'][$username] = $currentIndex;
$currentMedia = $mediaList[$currentIndex];

// Prepare media HTML
ob_start();
$fileExtension = pathinfo($currentMedia['file_name'], PATHINFO_EXTENSION);
$filePath = $currentMedia['file_path'] . '/' . $currentMedia['file_name'];

if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
    echo '<img src="' . $filePath . '" alt="media">';
} elseif (in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg'])) {
    echo '<video controls><source src="' . $filePath . '" type="video/' . $fileExtension . '"></video>';
} else {
    echo 'Unsupported media type.';
}
$mediaHTML = ob_get_clean();

echo json_encode([
    "status" => "success",
    "mediaHTML" => $mediaHTML
]);
?>
