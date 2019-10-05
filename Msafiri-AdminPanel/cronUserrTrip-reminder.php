<?php
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
//get trips
$today = date('Y-m-d');
$selectUserTrips = "SELECT t1.*,t2.fname,t2.lname,t2.device_id,t2.device_token FROM tbl_user_trips as t1 INNER JOIN tbl_userdata as t2 ON t1.user_id=t2.id WHERE t2.status = 'active' AND t1.notify_datetime LIKE '%".$today."%' AND t1.status !='0' AND t1.status !='cancel' AND t1.notify_count = '0'";
//$selectUserTrips = "SELECT t1.*,t2.fname,t2.lname,t2.device_id,t2.device_token FROM tbl_user_trips as t1 INNER JOIN tbl_userdata as t2 ON t1.user_id=t2.id WHERE t2.status = 'active'";
$resultselectUserTrip = $db->query($selectUserTrips); 
// notification key
$androidAuthKey		= "AAAAfadO3yo:APA91bGdQj7W4BuRZ2DZmwaBWoIcDbG4-6Ka8FgHEIbqCK6d5pJws8fE_ItZWH3OIALz7tJAQrqdl1xhr6ZROtluNK-ZeremEoabt11MIREru211InBApZ1_NeGofeAnW4p7W1ExZlzy";
if($resultselectUserTrip->num_rows > 0){
	$datetoday = date("Y-m-d H:i:s");
	while ($dataselectUserTrips = $resultselectUserTrip->fetch_assoc()) {
		// before 30 min
		$setTime = date("Y-m-d H:i:s", strtotime("+15 minutes", $dataselectUserTrips['notify_datetime']));
		 if($datetoday >= $setTime){
			$updateDriverTrips = "UPDATE `tbl_user_trips` SET `notify_datetime` = '".$setTime."' WHERE `id` = '".$dataselectUserTrips['id']."' AND `notify_count` = '1'";
			$updateDriverTrip = $db->query($updateDriverTrips);
			$devicedata = "SELECT * FROM `tbl_user_devicedata` WHERE `user_id` = '".$dataselectUserTrips['user_id']."'";
			$resultdevicedata = $db->query($devicedata); 
			if($resultdevicedata->num_rows > 0){
				while ($datadevicedata = $resultdevicedata->fetch_assoc()) {
					$device_token = $dataselectUserTrips['device_token'];
					$device_id = $dataselectUserTrips['device_id'];
					if($device_id == "android"){
						// notification
						$url = 'https://fcm.googleapis.com/fcm/send';
				        $fields = array();
				        $fields1 = array();
				        $fields['to'] = $device_token;
				        $json = array("message" => "Dear, User your trip is comming soon.Trip reminder.","type" => 'user_reminder');
				        $fields1['message'] = json_encode($json);
				        $fields1['title'] = 'TuRyde';
				        //$fields['type'] = 'user_reminder';
				        $fields['data'] = $fields1; 

				        $fields = json_encode ( $fields );
				        $headers = array (
				                'Authorization: key=' . "AAAAfadO3yo:APA91bGdQj7W4BuRZ2DZmwaBWoIcDbG4-6Ka8FgHEIbqCK6d5pJws8fE_ItZWH3OIALz7tJAQrqdl1xhr6ZROtluNK-ZeremEoabt11MIREru211InBApZ1_NeGofeAnW4p7W1ExZlzy",
				                'Content-Type: application/json'
				        );
				        $ch = curl_init ();
				        curl_setopt ( $ch, CURLOPT_URL, $url );
				        curl_setopt ( $ch, CURLOPT_POST, true );
				        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
				        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
				        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
				        $result = curl_exec ( $ch );
				        curl_close ( $ch );
				        $rtn["code"]	= "000";//means result OK
						$rtn["msg"]		= "OK"; 
						$rtn["result"]	= $result;
					}else{
						// ios
			    		$apnsHost = 'gateway.sandbox.push.apple.com';
						$apnsCert = 'Certificates.pem';
						$apnsPort = 2195;
						$apnsPass = '123456';
				        $t_registration_id = str_replace('%20', '', $device_token); 
				        $ts_registration_id = str_replace(' ', '', $t_registration_id); 
						$token = $ts_registration_id;

						$payload['aps'] = array('alert' => "Dear, User your trip is comming soon.Trip reminder.","data" => array("type" =>'user_reminder', "action-loc-key"=>"View"), 'badge' => 1, 'sound' => 'default');
						$payload['extra_info'] = array('apns_msg' => "TuRyde Notification"); 
						$output = json_encode($payload);
						$token = pack('H*', str_replace(' ', '', $token));
						$apnsMessage = chr(0).chr(0).chr(32).$token.chr(0).chr(strlen($output)).$output;

						$streamContext = stream_context_create();
						stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
						stream_context_set_option($streamContext, 'ssl', 'passphrase', $apnsPass);

						$apns = stream_socket_client('ssl://'.$apnsHost.':'.$apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
						fwrite($apns, $apnsMessage);
						fclose($apns);
						$rtn["code"]	= "0001";//means result OK
						$rtn["msg"]		= "OK";
					}
				}
			}
			
	 	}
	 	else{
	 		continue;
	 	}

	 }
}

?>