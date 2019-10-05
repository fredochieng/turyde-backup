<?php
include '../configClass.php';
$newobj = new connectionClass();
$db 	= $newobj ->db;

if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
			$managePic 			= "SELECT * from tbl_location where address = '".$_POST['addressPickup']."'";
			$resultManagePic 	= $db->query($managePic);
			while($pick = $resultManagePic->fetch_assoc()) 
			{
				$lat_pickup =  $pick['latitude'];
				$lng_pickup =  $pick['longitude'];
			}
			$manageDes 			= "SELECT * from tbl_location where address = '".$_POST['addressDestination']."'";
		    $resultManageDest 	= $db->query($manageDes);
			while($dest = $resultManageDest->fetch_assoc()) 
			{
				$lat_dest 	=  $dest['latitude'];
				$lng_dest 	=  $dest['latitude'];
			}
			$date 		= date_create($_POST['date_pickup']);
        	$start_date = date_format($date,"Y-m-d H:i:s");
        	$date1 		= date_create($_POST['date_dest']);
        	$end_date 	= date_format($date1,"Y-m-d H:i:s");
			$sql = "INSERT INTO tbl_driver_setlocation (driver_id, from_title, from_lat, from_lng,from_address, datetime, to_title, to_lat, to_lng,to_address, end_datetime)VALUES ('".$_POST['driver_id']."','".$_POST['addressPickup']."','".$lat_pickup."','".$lng_pickup."','".$_POST['addressPickup']."','".$start_date."','".$_POST['addressDestination']."','".$lat_dest."','".$lng_dest."','".$_POST['addressDestination']."','".$end_date."')";
			$result = $db->query($sql);
			if(!empty($result))
			{
				echo 'Data Inserted';
			}
	}
	if($_POST["operation"] == "Edit")
	{
		$managePic 			= "SELECT * from tbl_location where address = '".$_POST['addressPickup']."'";
			$resultManagePic 	= $db->query($managePic);
			while($pick = $resultManagePic->fetch_assoc()) 
			{
				$lat_pickup =  $pick['latitude'];
				$lng_pickup =  $pick['longitude'];
			}
			$manageDes 			= "SELECT * from tbl_location where address = '".$_POST['addressDestination']."'";
		    $resultManageDest 	= $db->query($manageDes);
			while($dest = $resultManageDest->fetch_assoc()) 
			{
				$lat_dest 	=  $dest['latitude'];
				$lng_dest 	=  $dest['latitude'];
			}
			$date 		= date_create($_POST['date_pickup']);
        	$start_date = date_format($date,"Y-m-d H:i:s");
        	$date1 		= date_create($_POST['date_dest']);
        	$end_date 	= date_format($date1,"Y-m-d H:i:s");

        	$statement  = "UPDATE tbl_driver_setlocation SET driver_id='".$_POST['driver_id']."',from_lat='".$lat_pickup."',from_lng='".$lng_pickup."',from_address='".$_POST['addressPickup']."',datetime='".$start_date."',to_title='".$_POST['addressDestination']."',to_lat='".$lat_dest."',to_lng='".$lng_dest."',to_address='".$_POST['addressDestination']."',end_datetime='".$end_date."' WHERE id='".$_POST["route_id"]."'";
        	$result = $db->query($statement);
			if(!empty($result))
			{
				echo 'Data Updated';
			}
	}
}

?>