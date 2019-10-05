<?php

	require 'vendor/autoload.php';
	use AfricasTalking\SDK\AfricasTalking;

	$username = "sandbox";
	$apiKey = "220a3b399d2fae69b03fe94453348c9ec2445dcc93b691b3f7a2326c2b93014d";

	$AT = new AfricasTalking($username, $apiKey);
	include '../../Msafiri-AdminPanel/configClass.php';
	$newobj = new connectionClass();
	$db = $newobj ->db;
	if(isset($_GET['mobile_number']) && !empty($_GET['mobile_number']) && $_GET['type'] == "userdata"){
		//check user data
		//$code = substr(str_shuffle("0123456789"), 0, 4);
		$code = '1234';
		// Get one of the services
		$sms      = $AT->sms();
		// Use the service
		// $result   = $sms->send([
		//     'to'      => '+asdasf',
		//     'message' => 'Your OTP for Turyde:1234'
		// ]);


		$selectUser = "SELECT mobile_number FROM tbl_userdata WHERE mobile_number = '".$_GET['mobile_number']."'";
		$resultselectUser = $db->query($selectUser);
		if($resultselectUser->num_rows > 0){
		    //check otp
		    // update user data for code
			$queryModel = "UPDATE `tbl_userdata` SET `sentcode` = '".$code."' WHERE `mobile_number` = '".$_GET['mobile_number']."'";
			$resultModel = $db->query($queryModel);
			// echo "<pre>";
			// print_r($result);
			// response
			$user = "SELECT id,mobile_number FROM tbl_userdata WHERE mobile_number = '".$_GET['mobile_number']."'";
			$resultUser = $db->query($user);
			$dataUser = $resultUser->fetch_assoc();
			$result[] = array('user_id'=>$dataUser['id'],'sentcode'=>$dataUser['sentcode']);
			$json = array("status" => 1,"message"=>"success", "data" => $result);
		}
		else{
		    $json = array("status" => 0,"message"=>"fail");
	    }
	}
	elseif(isset($_GET['mobile_number']) && !empty($_GET['mobile_number']) && $_GET['type'] == "driverdata"){
		//check user data
		//$code = substr(str_shuffle("0123456789"), 0, 4);
		$code = '1234';
		// Get one of the services
		$sms      = $AT->sms();
		// Use the service
		// $result   = $sms->send([
		//     'to'      => '+asdasf',
		//     'message' => 'Your OTP for Turyde:1234'
		// ]);


		$selectUser = "SELECT mobile_number,driver_id FROM tbl_driverdetails WHERE mobile_number = '".$_GET['mobile_number']."'";
		$resultselectUser = $db->query($selectUser);
		if($resultselectUser->num_rows > 0){
		    $dataUser = $resultselectUser->fetch_assoc();
		    //check otp
		    // update user data for code
			$queryModel = "UPDATE `tbl_driverdata` SET `sentcode` = '".$code."' WHERE `id` = '".$dataUser['driver_id']."'";
			$resultModel = $db->query($queryModel);
			// echo "<pre>";
			// print_r($result);
			// response
			$result[] = array('driver_id'=>$dataUser['driver_id'],'sentcode'=>$code);
			$json = array("status" => 1,"message"=>"success", "data" => $result);
		}
		else{
		    $json = array("status" => 0,"message"=>"No driverdata");
	    }
	}
	else{
		$json = array("status" => 0,"message"=>"fail");
	}
	echo json_encode($json);
	// echo "<pre>";
	// print_r($result);