<?php
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
//get trips
$today = date('Y-m-d');
// $update = "UPDATE `tbl_driverdata` SET `approvel` = 'yes' WHERE `type` = 'individual'";
// $resultupdate = $db->query($update);
$selectUserTrips = "SELECT t1.* FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id WHERE t2.approvel='yes' AND t2.online_status = 'active' AND t1.status = 'pending' AND t1.datetime LIKE '%".$today."%'";
$resultselectUserTrip = $db->query($selectUserTrips);
if($resultselectUserTrip->num_rows > 0){
	$datetoday = date("Y-m-d H:i:s");
	while ($dataselectUserTrips = $resultselectUserTrip->fetch_assoc()) {
		if($dataselectUserTrips['trip_price'] == "" || $dataselectUserTrips['trip_price'] == '0' || empty($dataselectUserTrips['trip_price'])){
		 	continue;
		}
		elseif($datetoday >= $dataselectUserTrips['datetime']){
			$updateDriverTrips = "UPDATE `tbl_driver_setlocation` SET `status` = 'active' WHERE `id` = '".$dataselectUserTrips['id']."'";
			$updateDriverTrip = $db->query($updateDriverTrips);
		}
	}
}
?>