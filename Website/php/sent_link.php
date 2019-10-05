<?php
include("connection.php");

ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
$sender = 'arpi.shah08@gmail.com';
$recipient = 'sachin.s.shah@gmail.com';

$subject = "php mail test";
$message = "php test message";
$headers = 'From:' . $sender;

if (mail($recipient, $subject, $message, $headers))
{
    echo "Message accepted";
}
else
{
    echo "Error: Message not accepted";
}


// $to       = 'sachin.s.shah@gmail.com';
// $subject  = 'Testing sendmail.exe';
// $message  = 'Hi, you just received an email using sendmail!';
// $headers  = 'From: arpi.shah08@gmail.com' . "\r\n" .
            // 'MIME-Version: 1.0' . "\r\n" .
            // 'Content-type: text/html; charset=utf-8';
// if(mail($to, $subject, $message, $headers))
    // echo "Email sent";
// else
    // echo "Email sending failed";

// $receiver_email = $_POST['email'];
// ini_set("SMTP","ssl://smtp.gmail.com");
// ini_set("smtp_port","25");



  
  /*$select=mysqli_query("select email_id,pwd,full_name from tbl_user where email_id='$receiver_email'");
  $result = $conn->query($sql);
  $number = mysqli_num_rows($result);
  if($number>0)
  {
    while($row=mysqli_fetch_assoc($result))
    {
      $email=md5($row['email_id']);
      $pass=md5($row['pwd']);
	  $name=$row['full_name'];
    }
	}*/
	
	// $to = $receiver_email;
// $subject = "My subject";
// $txt = "Hello world!";
// $headers = "From: arpi.shah08@gmail.com" . "\r\n";

// if(mail($to,$subject,$txt,$headers)){
// echo "email sent";
// }
// else{
// echo "Not";
// }
  


    /*$link="<a href='http://localhost/website/reset.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
    require_once('phpmail/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "arpi.shah08@gmail.com";
    // GMAIL password
    $mail->Password = "sachin1980";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='arpi.shah08@gmail.com';
    $mail->FromName='Arpi Shah';
    $mail->AddAddress($receiver_email, $name);
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$pass.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }*/

?>