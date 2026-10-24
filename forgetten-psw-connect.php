<?php
include "sendmail.php";
date_default_timezone_set("Asia/kolkata");
$username = $_POST['username'];

session_start();
$_SESSION['username'] = $username;



//database connection
$conn = new mysqli('localhost','root','','urarchitect');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from users where  username = '$username' ";
$result = mysqli_query($conn,$sql);
$present = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
if($present>0){
  // echo $row["Email"];
       $mail_status = senddetails($row["email"],$row["first_name"],$row["surname"],$row["username"]);

}else{
  
  echo '<script>alert("Incorrect Username"); location.href="unameenter.html";</script>';
}
?>




 

