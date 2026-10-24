<?php

$otpfromuser = $_POST['otpfromuser'];
$npasword = $_POST['npsw'];

session_start();
$uname = $_SESSION['username'];

//database connection
$conn = new mysqli('localhost','root','','urarchitect');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//$pinstatus = "unused";
$sql = "SELECT * from otptable where OTP = '$otpfromuser' and otpstatus = 'unused'";
$result = mysqli_query($conn,$sql);
$present = mysqli_num_rows($result);
$row = mysqli_fetch_assoc($result);
//$uname = $row["UserName"];
echo $row["username"];

//$otptem = $row["OTP"]; 



if($present>0){
  if($row["username"]==$uname)
    {

      $pswl = strlen($npasword);
      if($pswl<8){
        echo '<script>alert("Weak Password"); location.href="reset.php";</script>';
      }else{$sql = "UPDATE users SET password = '$npasword'  WHERE username = '$uname' ";
        $sql1 = "UPDATE otptable SET otpstatus = 'used'  WHERE OTP = '$otpfromuser' "; 
        $result = mysqli_query($conn,$sql1); 
    
          session_destroy();
        echo '<script>alert("password reset done"); location.href="login.php";</script>';
      }
    
    }
    else{
      echo '<script>alert("incorrect OTP"); location.href="reset.php";</script>';    
    }
  }else {
  echo '<script>alert("incorrect OTP"); location.href="reset.php";</script>';
}
if ($conn->query($sql) === TRUE) {
 // header("location: login.html"); 
  
}  






?>




 

