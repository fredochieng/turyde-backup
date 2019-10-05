<?php
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
// get trips
$today = date('Y-m-d');
$selectDriverTrips = "SELECT t1.* FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id WHERE t1.status = 'pending' AND t1.notify_datetime LIKE '%".$today."%' AND t2.online_status='deactive' AND t2.approvel='yes' AND t1.notify_count != '4'";
//$selectDriverTrips = "SELECT * FROM tbl_driverdata WHERE online_status='deactive' AND status = 'active'";
$resultselectDriverTrip = $db->query($selectDriverTrips);
// notification key
$androidAuthKey		= "AAAAtGOUWZk:APA91bHmcm1PA38CmzUX_9C9IadlDr9HYIt1KUTkgd6xIVurkK8mFSGkSYn-Q-JE1oL0Nv9TY075JFlPIhwEABDXTWCdRFC_ehKALXrBvNhj-KEqKowCAv8tXtdYKuR-tINwePMAczfk"; 

if($resultselectDriverTrip->num_rows > 0){
	$datetoday = date("Y-m-d H:i:s");
	while ($dataselectDriverTrips = $resultselectDriverTrip->fetch_assoc()) {
		// before 30 min
		$startTime = date("Y-m-d H:i:s", strtotime("-30 minutes", $dataselectDriverTrips['datetime']));
		$setTime = date("Y-m-d H:i:s", strtotime("+5 minutes", $dataselectDriverTrips['notify_datetime']));
		if($datetoday >= $startTime && $datetoday <= $dataselectDriverTrips['notify_datetime']){
			$count = $dataselectDriverTrips['notify_count'];
			$notify_count = $count+1;
			if($notify_count == 4){
				$subquery = " , `status` = 'cancel'";
				// cancel all user and send them notifications
				$updateusertrip = "UPDATE `tbl_user_trips` SET `status` = 'cancel' WHERE `trip_id` = '".$dataselectDriverTrips['id']."'";
				$resultupdateusertrip = $db->query($updateusertrip);
				// send notification to users
				$selectUserTrips = "SELECT t1.*,t2.device_id,t2.device_token FROM tbl_user_trips as t1 INNER JOIN tbl_userdata as t2 WHERE t1.trip_id = '".$dataselectUserTrips['id']."'";
				$resultselectUserTrip = $db->query($selectUserTrips);
				if($resultselectUserTrip->num_rows > 0){
					while ($dataselectUserTrips = $resultselectDriver->fetch_assoc()) {
						$device_token = $dataselectUserTrips['device_token'];
						if($dataselectUserTrips['device_id'] == "android"){
							// notification
							$url = 'https://fcm.googleapis.com/fcm/send';
					        $fields = array();
					        $fields1 = array();
					        $fields['to'] = $device_token;
					        $json = array("message" => "Dear, User your upcoming trip has been cancelled.","type" => 'cancel_trip',"trip_id" => $dataselectUserTrips['id']);
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
							//ios
							$apnsHost = 'gateway.sandbox.push.apple.com';
							$apnsCert = 'Certificates.pem';
							$apnsPort = 2195;
							$apnsPass = '123456';
					        $t_registration_id = str_replace('%20', '', $device_token); 
					        $ts_registration_id = str_replace(' ', '', $t_registration_id); 
							$token = $ts_registration_id;

							$payload['aps'] = array('alert'=>'Dear, User your upcoming trip has been cancelled.','data' => array("type" => 'cancel_trip',"trip_id" => $dataselectUserTrips['id'], "action-loc-key"=>"View"), 'badge' => 1, 'sound' => 'default');
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
				//PASSANGER
				$updateusertrip = "UPDATE `tbl_trip_passanger` SET `status` = 'cancel' WHERE `trip_id` = '".$dataselectDriverTrips['id']."'";
				$resultupdateusertrip = $db->query($updateusertrip);
			}
			else{
				$subquery = "";
			}
			/** 
		     *  For Android GCM
			 * 	$params["msg"] : Expected Message For GCM 
		     */
			$device_token = $dataselectDriverTrips['device_token'];
		    if($dataselectDriverTrips['device_id'] == 'android'){
		        $url = 'https://fcm.googleapis.com/fcm/send';
		        $fields = array();
		        $fields1 = array();
		        $fields['to'] = $device_token;
		        //$fields['type'] = 'go_online';
		        $json = array("message" => "Dear, Driver your trip is comming. Please Go online.","type" => 'go_online');
		        $fields1['message'] = json_encode($json);
		        $fields1['title'] = 'TuRyde';
		        $fields['data'] = $fields1; 

		        $fields = json_encode ( $fields );
		        $headers = array (
		                'Authorization: key=' . "AAAAtGOUWZk:APA91bHmcm1PA38CmzUX_9C9IadlDr9HYIt1KUTkgd6xIVurkK8mFSGkSYn-Q-JE1oL0Nv9TY075JFlPIhwEABDXTWCdRFC_ehKALXrBvNhj-KEqKowCAv8tXtdYKuR-tINwePMAczfk",
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
		    }
		    else{
		    	// ios
	    		$apnsHost = 'gateway.sandbox.push.apple.com';
				$apnsCert = 'Certificates_Driver.pem';
				$apnsPort = 2195;
				$apnsPass = '123456';
		        $t_registration_id = str_replace('%20', '', $device_token); 
		        $ts_registration_id = str_replace(' ', '', $t_registration_id); 
				$token = $ts_registration_id;

				$payload['aps'] = array('alert' => 'Dear, Driver your trip is comming. Please Go online.','data' => array("type" => 'go_online', "action-loc-key"=>"View"), 'badge' => 1, 'sound' => 'default');
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
			$updateDriverTrips = "UPDATE `tbl_driver_setlocation` SET `notify_count` = '".$notify_count."',`notify_datetime` = '".$setTime."' $subquery WHERE `id` = '".$dataselectDriverTrips['id']."'";
			$updateDriverTrip = $db->query($updateDriverTrips);
			echo "sent"."<br>";
		}
		else{
		 	continue;
		}

	}
}
?>