<?php

	require 'vendor/autoload.php';
	use AfricasTalking\SDK\AfricasTalking;

	$username = "sandbox";
	$apiKey = "220a3b399d2fae69b03fe94453348c9ec2445dcc93b691b3f7a2326c2b93014d";

	$AT = new AfricasTalking($username, $apiKey);
	include '../../Msafiri-AdminPanel/configClass.php';
	$newobj = new connectionClass();
	$db = $newobj ->db;
	if(isset($_POST['mobile_number']) && !empty($_POST['mobile_number']) && !empty($_POST['device_id']) && !empty($_POST['device_token'])){
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


		$selectUser = "SELECT id,mobile_number FROM tbl_userdata WHERE mobile_number = '".$_POST['mobile_number']."'";
		$resultselectUser = $db->query($selectUser);
		if($resultselectUser->num_rows > 0){
		    //check otp
		    // update user data for code
		    $getdataUser = $resultselectUser->fetch_assoc();
		    // check device data
		   $selectdevicedata = "SELECT user_id,device_token FROM tbl_user_devicedata WHERE user_id = '".$getdataUser['id']."' AND device_token = '".$_POST['device_token']."' LIMIT 1";
			$resultdevicedata = $db->query($selectdevicedata);
			//if($resultdevicedata->num_rows > 0){
				$getdevicedata = $resultdevicedata->fetch_assoc();
			    if($getdevicedata['device_token'] != $_POST['device_token']){
			    	$deviceQuery = "INSERT INTO `tbl_user_devicedata`(`user_id`, `device_id`, `device_token`) VALUES ('".$getdataUser['id']."','".$_POST['device_id']."','".$_POST['device_token']."')";
			    	$resultdeviceQuery = $db->query($deviceQuery);
			    }
			//}
		    
			$queryModel = "UPDATE `tbl_userdata` SET `sentcode` = '".$code."' WHERE `mobile_number` = '".$_POST['mobile_number']."'";
			$resultModel = $db->query($queryModel);
			// response
			$user = "SELECT * FROM tbl_userdata WHERE mobile_number = '".$_POST['mobile_number']."'";
			$user_type = "registered";
		}
		else{
		    // register new user
		    $insert = "INSERT INTO `tbl_userdata` (`sentcode`,`mobile_number`,`device_id`,`device_token`) VALUES ('".$code."','".$_POST['mobile_number']."','".$_POST['device_id']."','".$_POST['device_token']."')";
			$resultInsert = $db->query($insert);
			
		    $lastID     = mysqli_insert_id($db);
		    if (!file_exists('../../../M-safiri-API/user_uploads/'.$lastID)) {
			    mkdir('../../../M-safiri-API/user_uploads/'.$lastID, 0777, true);
			}
			// device data
			$deviceQuery = "INSERT INTO `tbl_user_devicedata`(`user_id`, `device_id`, `device_token`) VALUES ('".$lastID."','".$_POST['device_id']."','".$_POST['device_token']."')";
		    $resultdeviceQuery = $db->query($deviceQuery);
			$user = "SELECT * FROM tbl_userdata WHERE id = '".$lastID."'";
			$user_type = "newuser";
		}
		$resultUser = $db->query($user);
		$dataUser = $resultUser->fetch_assoc();
		if($dataUser['photo'] == 'no_profile.png' || $dataUser['photo'] == '')
		{
			$photoPath = NOUSERIMAGE;
		}
		else{
			$photoPath = APIROOT."user_uploads/".$dataUser['id']."/".$dataUser['photo'];
		}
		//
		$user_email = isset($dataUser['user_email']) ? $dataUser['user_email'] :'';
		$username = isset($dataUser['username']) ? $dataUser['username'] :'';
		$sentcode = isset($dataUser['sentcode']) ? $dataUser['sentcode'] :'';
		$mobile_number = isset($dataUser['mobile_number']) ? $dataUser['mobile_number'] :'';
		$gender = isset($dataUser['gender']) ? $dataUser['gender'] :'';
		$fname = isset($dataUser['fname']) ? $dataUser['fname'] :'';
		$lname = isset($dataUser['lname']) ? $dataUser['lname'] :'';
		$country = isset($dataUser['country']) ? $dataUser['country'] :'';
		$device_id = isset($dataUser['device_id']) ? $dataUser['device_id'] :'';
		$device_token = isset($dataUser['device_token']) ? $dataUser['device_token'] :'';
		$status = isset($dataUser['status']) ? $dataUser['status'] :'';

		$result[] = array('user_id'=>$dataUser['id'],'user_email'=>$user_email,'username' => $username,'sentcode'=>$sentcode,'mobile_number' => $mobile_number, 'gender' => $gender ,'photo' => $photoPath,'fname'=>$fname , 'lname' =>$lname , 'country' =>$country,'device_id' => $device_id,'device_token' => $device_token,'status' => $status,'user_type' => $user_type);
		$json = array("status" => 1,"message"=>"success", "data" => $result);
		//echo "<pre>";
		//print_r($result);
	}
	else{
		$json = array("status" => 0,"message"=>"Missing parameters");
	}
	echo json_encode($json);
	// echo "<pre>";
	// print_r($result);