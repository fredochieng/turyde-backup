<?php
include '../configClass.php';
$newobj = new connectionClass();
$db 	= $newobj ->db;

//assign driver delete
if(isset($_POST["action"]) && $_POST["action"] == 'assignDriverDelete' && isset($_POST["assign_id"]))
{
	$statement 	= "DELETE FROM `tbl_assign_driver` WHERE `id` = '".$_POST["assign_id"]."'";
	$result 	= $db->query($statement);
}

// driver delete
if(isset($_POST["action"]) && $_POST["action"] == 'driverDelete' && isset($_POST["driver_id"]))
{
	$statement 	= "DELETE FROM `tbl_assign_driver` WHERE `driver_id` = '".$_POST["driver_id"]."'";
	$result 	= $db->query($statement);
	
	$statement1 = "DELETE FROM `tbl_driverdetails` WHERE `driver_id` = '".$_POST["driver_id"]."'";
	$result1    = $db->query($statement1);

	$statement2 = "DELETE FROM `tbl_driverdocuments` WHERE `driver_id` = '".$_POST["driver_id"]."'";
	$result2    = $db->query($statement2);

	$statement3 = "DELETE FROM `tbl_driverdata` WHERE `id` = '".$_POST["driver_id"]."'";
	$result3 = $db->query($statement3);
}

//route delete
if(isset($_POST["action"]) && $_POST["action"] == 'routeDelete' && isset($_POST["route_id"]))
{
	$statement 	= "DELETE FROM `tbl_driver_setlocation` WHERE `id` = '".$_POST["route_id"]."'";
	$result 	= $db->query($statement);
}

//vehicle delete
if(isset($_POST["action"]) && $_POST["action"] == 'vehicleDelete' && isset($_POST["vehicle_id"]))
{

	$statement2 = "DELETE FROM `tbl_vehicledetails` WHERE `vehicle_id` = '".$_POST["vehicle_id"]."'";
	$result2    = $db->query($statement2);

	$statement 	= "DELETE FROM `tbl_assign_driver` WHERE `vehicle_id` = '".$_POST["vehicle_id"]."'";
	$result 	= $db->query($statement);

	$statement1 = "DELETE FROM `tbl_driver_vehicle` WHERE `id` = '".$_POST["vehicle_id"]."'";
	$result1    = $db->query($statement1);

}
?>