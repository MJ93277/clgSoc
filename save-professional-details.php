<?php

session_start();

include "dbh.php";


// 2. Get data from user form
$user_id = $_SESSION['user_id'];
$firm_name = $_POST['firm_name'];
$type_of_architect = $_POST['type_of_architect'];
$expertise_areas = $_POST['expertise_areas'];
$affiliated_organizations = $_POST['affiliated_organizations'];
$license_number = $_POST['license_number'];
$degree = $_POST['degree'];
$institution = $_POST['institution'];
$passing_year = $_POST['passing_year'];
$specialization = $_POST['specialization'];
$certification_name = $_POST['certification_name'];
$certification_institution = $_POST['certification_institution'];
$certification_year = $_POST['certification_year'];
$certification_number = $_POST['certification_number'];
$language = $_POST['language'];




$sql = "SELECT * FROM professional_details WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 2. If record exists, UPDATE
    $sql = "UPDATE professional_details 
            SET firm_name = ?, type_of_architect = ?, expertise_areas = ?, 
                affiliated_organizations = ?, license_number = ?, 
                degree = ?, institution = ?, passing_year = ?, 
                specialization = ?, certification_name = ?, 
                certification_institution = ?, certification_year = ?, 
                certification_number = ?, language = ?
            WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssssssssssi", 
        $firm_name, $type_of_architect, $expertise_areas, 
        $affiliated_organizations, $license_number, 
        $degree, $institution, $passing_year, 
        $specialization, $certification_name, 
        $certification_institution, $certification_year, 
        $certification_number, $language, $user_id
    );
    if ($stmt->execute()) {
        echo "<script>alert('Saved successfully!'); window.location.href = 'work-experience.php';</script>";
      } else {
        echo "<script>alert('❌ Error: " . $insert_stmt->error . "'); window.history.back();</script>";
      }
    // $stmt->execute();
} else {
    // 3. If no record, INSERT     isssssssisssiis
    $sql = "INSERT INTO professional_details (
                user_id, firm_name, type_of_architect, expertise_areas, 
                affiliated_organizations, license_number, 
                degree, institution, passing_year, specialization, 
                certification_name, certification_institution, 
                certification_year, certification_number, language
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "isssssssisssiss", 
        $user_id, $firm_name, $type_of_architect, $expertise_areas, 
        $affiliated_organizations, $license_number, 
        $degree, $institution, $passing_year, $specialization, 
        $certification_name, $certification_institution, 
        $certification_year, $certification_number, $language
    );if ($stmt->execute()) {
        // echo "<script>alert('2 prefessional details done!'); window.location.href = 'work-experience.php';</script>";
           echo "<script>
    alert('Saved successfully!');
    window.location.href = 'work-experience.php';
        </script>";
      } else {
        echo "<script>alert('❌ Error: " . $insert_stmt->error . "'); window.history.back();</script>";
      }
    // $stmt->execute();
}
?>
