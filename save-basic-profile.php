<?php
session_start();

include "dbh.php";
// 2. Fetching Form Data
$user_id = $_SESSION['user_id'];
$first_name = $_POST['first_name'];
$surname = $_POST['surname'];
$title = $_POST['title'];
$dob = $_POST['dob'];
$bio = $_POST['bio'];
$experience_years = $_POST['experience_years'];
$achievements = $_POST['achievements'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];

// Default profile picture data (null if no file is uploaded)
$profile_picture_data = null;

// 3. Handle Profile Picture Upload
if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $fileTmpPath = $_FILES['profile_picture']['tmp_name'];
    $fileSize = $_FILES['profile_picture']['size'];
    $fileType = $_FILES['profile_picture']['type'];

    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

    // Check if the file type is allowed
    if (!in_array($fileType, $allowedMimeTypes)) {
        echo "<script>alert('Error: Only JPG, PNG, and GIF files are allowed for profile picture.'); window.history.back();</script>";
        exit();
    }
    

    // Check if the file size is within the limit (2MB)
    if ($fileSize > 2 * 1024 * 1024) {
        die("Error: Profile picture size should be less than 2MB.");
    }

    // Read the file contents if it's valid
    $profile_picture_data = file_get_contents($fileTmpPath);
}

// 4. Update first name and surname in users table
$update_user = "UPDATE users SET first_name = ?, surname = ? WHERE id = ?";
$update_stmt = $conn->prepare($update_user);
$update_stmt->bind_param("ssi", $first_name, $surname, $user_id);
$update_stmt->execute();
$update_stmt->close();

// 5. Check if basic_profile already exists
$check_profile = "SELECT * FROM basic_profile WHERE user_id = ?";
$check_stmt = $conn->prepare($check_profile);
$check_stmt->bind_param("i", $user_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    // Profile exists — UPDATE it
    if ($profile_picture_data !== null) {
        $update_profile = "UPDATE basic_profile 
                           SET professional_title = ?, dob = ?, bio = ?, overall_experience = ?, achievements = ?, country = ?, state = ?, city = ?, profile_picture = ?
                           WHERE user_id = ?";
        $stmt = $conn->prepare($update_profile);
        $stmt->bind_param("sssisssssi", $title, $dob, $bio, $experience_years, $achievements, $country, $state, $city, $profile_picture_data, $user_id);
    } else {
        $update_profile = "UPDATE basic_profile 
                           SET professional_title = ?, dob = ?, bio = ?, overall_experience = ?, achievements = ?, country = ?, state = ?, city = ?
                           WHERE user_id = ?";
        $stmt = $conn->prepare($update_profile);
        $stmt->bind_param("sssissssi", $title, $dob, $bio, $experience_years, $achievements, $country, $state, $city, $user_id);
    }
} else {
    // No profile — INSERT new
    if ($profile_picture_data !== null) {
        $insert_profile = "INSERT INTO basic_profile (user_id, professional_title, dob, bio, overall_experience, achievements, country, state, city, profile_picture)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_profile);
        $stmt->bind_param("isssisssss", $user_id, $title, $dob, $bio, $experience_years, $achievements, $country, $state, $city, $profile_picture_data);
    } else {
        $insert_profile = "INSERT INTO basic_profile (user_id, professional_title, dob, bio, overall_experience, achievements, country, state, city)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_profile);
        $stmt->bind_param("isssissss", $user_id, $title, $dob, $bio, $experience_years, $achievements, $country, $state, $city);
    }
}

$check_stmt->close();

// 6. Execute and give response
if ($stmt->execute()) {
    echo "<script>
    alert('Saved successfully!');
    window.location.href = 'professional-details.php';
        </script>";
        exit();

    // header("Location: professional-details.php");
    // exit();
} else {
    echo "Error: " . $stmt->error;
}

// 7. Close Connection
$stmt->close();
$conn->close();
?>
