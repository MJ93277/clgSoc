

<?php
include "dbh.php";



$shownArchitects = isset($_POST['shownArchitects']) ? $_POST['shownArchitects'] : [];

$shownList = "'" . implode("','", array_map('mysqli_real_escape_string', array_fill(0, count($shownArchitects), $conn), $shownArchitects)) . "'";

$sql = "SELECT DISTINCT username FROM media";
if (!empty($shownArchitects)) {
    $sql .= " WHERE username NOT IN ($shownList)";
}
$sql .= " ORDER BY RAND() LIMIT 1";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo json_encode(["status" => "end"]);
    exit;
}

$row = mysqli_fetch_assoc($result);
$username = $row['username'];

// $mediaSql = "SELECT * FROM media WHERE username = ? ORDER BY RAND() LIMIT 1";
$mediaSql = "SELECT media.*, basic_profile.bio
             FROM media
             LEFT JOIN basic_profile ON media.user_id = basic_profile.user_id
             WHERE media.username = ?
             ORDER BY RAND()
             LIMIT 1";

$stmt = mysqli_prepare($conn, $mediaSql);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$mediaResult = mysqli_stmt_get_result($stmt);
$media = mysqli_fetch_assoc($mediaResult);

ob_start();

echo '<div class="card"  style="margin-top: 60px">';
echo '<div class="media-text-wrapper">';

// Left: Image/Video
echo '<div class="image-container">';
$fileExtension = pathinfo($media['file_name'], PATHINFO_EXTENSION);
// $filePath = $media['file_path'] . '/' . $media['file_name'];
$filePath = $media['file_path'];

if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
    echo '<img src="' . $filePath . '" alt="media">';
} elseif (in_array(strtolower($fileExtension), ['mp4', 'webm', 'ogg'])) {
    echo '<video controls><source src="' . $filePath . '" type="video/' . $fileExtension . '"></video>';
} else {
    echo 'Unsupported media type.';
}

echo '</div>'; // image-container

      // Right: Text and Button
      echo '<div class="text-content">';
      echo '<strong>' . htmlspecialchars($row['username']) . '</strong>';
      echo '<p>' . htmlspecialchars($media['bio']) . '</p>';
    // echo '<strong>' . htmlspecialchars($media['username']) . ' #' . $media['user_id'] . '</strong>';

  
// echo '<p>' . htmlspecialchars($media['description']) . '</p>';


    
      // Load More Button
      echo '<button id="load-btn">Load More</button>';

      // Arrow Buttons (after Load More)
      echo '<div class="arrow-buttons">';
      echo '<button class="arrow left-arrow">←</button>';
      echo '<button class="arrow right-arrow">→</button>';
      echo '</div>';

      echo '</div>'; // text-content
      echo '</div>'; // media-text-wrapper
      echo '</div>'; // card

$html = ob_get_clean();

echo json_encode([
    "status" => "success",
    "html" => $html,
    "username" => $username
]);

?>
