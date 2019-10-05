<?php
include '../../Msafiri-AdminPanel/configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
if(isset($_GET['mobile_number']) && !empty($_GET['mobile_number'])){
	require 'vendor/autoload.php';
	use AfricasTalking\SDK\AfricasTalking;

	$username = "sandbox";
	$apiKey = "220a3b399d2fae69b03fe94453348c9ec2445dcc93b691b3f7a2326c2b93014d";

	$AT = new AfricasTalking($username, $apiKey);
	// Get one of the services
	$sms      = $AT->sms();
	// Use the service
	// $result   = $sms->send([
	//     'to'      => '+919033281528',
	//     'message' => 'Your OTP for Turyde:1234'
	// ]);

	// check user data
	//$code = substr(str_shuffle("0123456789"), 0, 4);
	$code = '1234';
	$selectUser = "SELECT mobile_number FROM tbl_userdata WHERE mobile_number = '".$_GET['mobile_number']."'";
	$resultselectUser = $db->query($selectUser);
	if($resultselectUser->num_rows > 0){
	    //check otp
	    // update user data for code
		$queryModel = "UPDATE `tbl_userdata` SET `sentcode` = '".$code."' WHERE `mobile_number` = '".$_GET['mobile_number']."'";
		$resultModel = $db->query($queryModel);
		// response
		$user = "SELECT * FROM tbl_userdata WHERE mobile_number = '".$_GET['mobile_number']."'";
		$user_type = "registered";
	}
	else{
	    // register new user
	    $insert = "INSERT INTO `tbl_userdata` (`sentcode`,`mobile_number`) VALUES ('".$code."','".$_GET['mobile_number']."')";
		$resultInsert = $db->query($insert);

	    $lastID     = mysqli_insert_id($db);
		$user = "SELECT * FROM tbl_userdata WHERE id = '".$lastID."'";
		$user_type = "newuser";
	}
	$resultUser = $db->query($user);
	$dataUser = $resultUser->fetch_assoc();
	$result[] = array('user_id'=>$dataUser['id'],'user_email'=>$dataUser['user_email'],'username' => $dataUser['username'],'sentcode'=>$dataUser['sentcode'],'mobile_number' => $dataUser['mobile_number'], 'gender' => $dataUser['gender'] ,'photo' => $photoPath,'fname'=>$dataUser['fname'] , 'lname' =>$dataUser['lname'] , 'country' =>$dataUser['country'],'device_id' => $dataUser['device_id'],'status' => $dataUser['status'],'user_type' => $user_type);
	$json = array("status" => 1,"message"=>"success", "data" => $result);
	//echo "<pre>";
	//print_r($result);
}
else{
	$json = array("status" => 0,"message"=>"fail");
}
