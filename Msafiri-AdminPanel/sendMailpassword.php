<?php
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
require 'PHPMailer-master/PHPMailerAutoload.php';
$code = substr(str_shuffle("0123456789"), 0, 4);;
$mail = new PHPMailer;
if(isset($_GET['email']) && !empty($_GET['email'])){
	$mail->isSMTP(); // Set mailer to use SMTP
	$mail->Host = 'mail.itechgaints.com'; // Specify main and backup server
	$mail->SMTPAuth = true;// Enable SMTP authentication
	$mail->Username = 'prabhat@itechgaints.com';// SMTP username
	$mail->Password = 'prabhat@123';// SMTP password
	// Enable encryption, 'ssl' also accepted
	$mail->Port = 25;//Set the SMTP port number - 587 for authenticated TLS
	$mail->setFrom('prabhat@itechgaints.com', 'Eleganzit');     //Set who the message is to be sent from
	$mail->addAddress($_GET['email'], 'info@eleganzit.com');  // Add a recipient
	$mail->WordWrap = 50;// Set word wrap to 50 characters
	$mail->isHTML(true); // Set email format to HTML

	$mail->Subject = 'M-safiri Password Varification code';
	$mail->Body    = 'Use this varification for reset your password <b>'.$code.'</b>';

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body

	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	   $json = array("status" => 0,"message"=>"failed", "data" => $result);
	}
	else
	{
		// update user data for code
		$queryModel = "UPDATE `tbl_driverdata` SET `sentcode` = '".$code."' WHERE `email` = '".$_GET['email']."'";
		$resultModel = $db->query($queryModel);
		$json = array("status" => 1,"message"=>"success", "data" => $result);
	}
}
if(isset($_GET['user_email']) && !empty($_GET['user_email'])){
	$mail->isSMTP(); // Set mailer to use SMTP
	$mail->Host = 'mail.itechgaints.com'; // Specify main and backup server
	$mail->SMTPAuth = true;// Enable SMTP authentication
	$mail->Username = 'prabhat@itechgaints.com';// SMTP username
	$mail->Password = 'prabhat@123';// SMTP password
	// Enable encryption, 'ssl' also accepted
	$mail->Port = 25;//Set the SMTP port number - 587 for authenticated TLS
	$mail->setFrom('prabhat@itechgaints.com', 'Eleganzit');     //Set who the message is to be sent from
	$mail->addAddress($_GET['user_email'], 'info@eleganzit.com');  // Add a recipient
	$mail->WordWrap = 50;// Set word wrap to 50 characters
	$mail->isHTML(true); // Set email format to HTML

	$mail->Subject = 'M-safiri Password Varification code';
	$mail->Body    = 'Use this varification for reset your password <b>'.$code.'</b>';

	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body

	if(!$mail->send()) {
	   echo 'Message could not be sent.';
	   echo 'Mailer Error: ' . $mail->ErrorInfo;
	   exit;
	   $json = array("status" => 0,"message"=>"failed", "data" => $result);
	}
	else
	{
		// update user data for code
		$queryModel = "UPDATE `tbl_userdata` SET `sentcode` = '".$code."' WHERE `user_email` = '".$_GET['user_email']."'";
		$resultModel = $db->query($queryModel);
		$json = array("status" => 1,"message"=>"success", "data" => $result);
	}
}

echo json_encode($json);