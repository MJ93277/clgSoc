<?php
include 'dbh.php';
session_start();

$user_id = $_SESSION['user_id'];
$experience_firm_name = $_POST['experience_firm_name'];
$start_month = $_POST['work_start_date'];
$end_month = $_POST['work_end_date'];
$role_responsibilities = $_POST['role_responsibilities'];
$key_projects = $_POST['key_projects'];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die('User not logged in.');
}


// Calculate difference in days
$start_date = new DateTime($start_month . '-01');
$end_date = new DateTime($end_month . '-01');
$interval = $start_date->diff($end_date);
$days = $interval->days;

if ($days === false) {
    die('Invalid date difference.');
}

// Pehle check karo: already data hai ya nahi
$check_sql = "SELECT work_experience_id FROM work_experience WHERE user_id = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("i", $user_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // Record exists → UPDATE
    $row = $check_result->fetch_assoc();
    $work_experience_id = $row['work_experience_id'];

    $update_sql = "UPDATE work_experience 
               SET experience_firm_name = ?, duration_days = ?, role_responsibilities = ?, key_projects = ?
               WHERE user_id = ?";

$update_stmt = $conn->prepare($update_sql);

// RIGHT ORDER:
$update_stmt->bind_param("sissi", $experience_firm_name, $days, $role_responsibilities, $key_projects, $user_id);


    if ($update_stmt->execute()) {
        // header("Location: social-links.php?success=updated");
           echo "<script>
    alert('Saved successfully!');
    window.location.href = 'social-links.php';
        </script>";
        exit();
    } else {
        echo "Error in update: " . $update_stmt->error;
    }

} else {
    // Record not exists → INSERT
    $insert_sql = "INSERT INTO work_experience (user_id, experience_firm_name, duration_days, role_responsibilities, key_projects)
                   VALUES (?, ?, ?, ?, ?)";

    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("isiss", $user_id, $experience_firm_name, $days, $role_responsibilities, $key_projects);

    if ($insert_stmt->execute()) {
           echo "<script>
    alert('Saved successfully!');
    window.location.href = 'social-links.php';
        </script>";
        // header("Location: social-links.php?success=inserted");
        exit();
    } else {
        echo "Error in insert: " . $insert_stmt->error;
    }
}
?>
