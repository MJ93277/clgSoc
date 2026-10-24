<?php
//date_default_timezone_set("Asia/kolkata");


// mail for otp
    function senddetails($mail,$fname,$sname,$uname){
        
        //echo $mail;
        regenarate:
        $otp =rand(100000,999999);
            
          // $otp = 100806; 
            
           //database connection
            $conn = new mysqli('localhost','root','','urarchitect');
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }else {

                $sql = "SELECT * from otptable where  OTP = '$otp' AND otpstatus = 'unused' ";
                $result = mysqli_query($conn,$sql);
                $present = mysqli_num_rows($result);
                if($present>0){
                    goto regenarate;

                   // echo '<script>alert("otp already exists");</script>';
                    
                    //header("location: usernamealert.php");
                    
                    }
                }
        

        require 'PHPMailer-master\src/Exception.php';

        require 'PHPMailer-master\src/SMTP.php';

        require 'PHPMailer-master\src/PHPMailer.php';


        $email = new PHPMailer\PHPMailer\PHPMailer();

        $email->IsSMTP();

        $email->SMTPAuth = true;

        $email->SMTPSecure = 'ssl';

        $email->Host = "smtp.gmail.com";

        $email->Port = 465;

        $email->isHTML(true);

        $email->Username = "";

        $email->Password = "";

        $email->SetFrom("");

        $email->AddAddress($mail);

        $email->Subject = "Reset password";
        
        $message ="<b>Dear ". $sname ." ". $fname .", </b>
        <br> you have requested to reset or change password for <b>". $uname ." </b> account. <br>". $otp ." is OTP to reset Password<br>Thank you";
        
        $email->Body = $message;

       // $email->addStringAttachment($pdfdoc,'statement.pdf');

        if(!$email->Send()) {   

        echo "Error: " . $email->ErrorInfo;

        } else {
            //database connection
                $conn = new mysqli('localhost','root','','urarchitect');
                if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                }else {
                    $otps = "unused";
                    echo $otps;
                    echo $mail;
                    $date = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO otptable (OTP, Email, Username,otpstatus,otptime)
                    VALUES ( '$otp', '$mail','$uname','$otps','$date')";}
                    if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('OTP sent to mail');
                        location.href='reset.php';
                        </script>";                            
                      } else {  

                      }
        }
}



// contact us mail

function conusfun($fname,$sname,$mail,$mbno,$msg){

    require 'PHPMailer-master\src/Exception.php';

    require 'PHPMailer-master\src/SMTP.php';

    require 'PHPMailer-master\src/PHPMailer.php';


    $email = new PHPMailer\PHPMailer\PHPMailer();

    $email->IsSMTP();

    $email->SMTPAuth = true;

    $email->SMTPSecure = 'ssl';

    $email->Host = "smtp.gmail.com";

    $email->Port = 465;

    $email->isHTML(true);

    $email->Username = "sending email add here";

    $email->Password = "apppassword";

    $email->SetFrom("xyz@gmail.com"); // sent mail from this mail

    $email->AddAddress('xyz@gmail.com'); // business mail for service details
    $email->Subject = "Contact us";
    
    $message.= "Name : ". $sname ." ". $fname ."<br>Email : ". $mail ."<br>Mobile no. : ". $mbno ."<br> 
    Message : ". $msg;
    
    $email->Body = $message;

   // $email->addStringAttachment($pdfdoc,'statement.pdf');

    if(!$email->Send()) {   
    echo "Error: " . $email->ErrorInfo;
    } else {

    }
}





 