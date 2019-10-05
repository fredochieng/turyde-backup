<?php
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
//get trips
$today = date('Y-m-d');
$selectUserTrips = "SELECT t1.*,t2.datetime as getdatetime FROM tbl_user_trips as t1 INNER JOIN tbl_driver_setlocation as t2 ON t1.trip_id=t2.id WHERE t1.status !='0' AND t1.status !='cancel' AND t1.status !='onboard' AND t2.datetime LIKE '%".$today."%'";
$resultselectUserTrip = $db->query($selectUserTrips);
if($resultselectUserTrip->num_rows > 0){
	$datetoday = date("Y-m-d H:i:s");
	while ($dataselectUserTrips = $resultselectDriver->fetch_assoc()) {
		if($datetoday >= $dataselectUserTrips['getdatetime']){
			$updateDriverTrips = "UPDATE `tbl_user_trips` SET `status` = 'missed' WHERE `id` = '".$dataselectUserTrips['id']."'";
			$updateDriverTrip = $db->query($updateDriverTrips);
		}
	}
}
?>