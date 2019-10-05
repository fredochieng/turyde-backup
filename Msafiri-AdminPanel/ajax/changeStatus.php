<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;

// user update
if(isset($_POST["userStatus"]) && isset($_POST["sid"]))
{
	$statement = "UPDATE `tbl_userdata` SET `status` = '".$_POST["userStatus"]."' WHERE `id` = '".$_POST["sid"]."'";
	$result = $db->query($statement);
}

// driver update
if(isset($_POST["driverStatus"]) && isset($_POST["sid"]))
{
	$statement = "UPDATE `tbl_driverdata` SET `status` = '".$_POST["driverStatus"]."' WHERE `id` = '".$_POST["sid"]."'";
	$result = $db->query($statement);
}

// location Status update
if(isset($_POST["locationStatus"]) && isset($_POST["sid"]))
{
	$statement = "UPDATE `tbl_location` SET `status` = '".$_POST["locationStatus"]."' WHERE `id` = '".$_POST["sid"]."'";
	$result = $db->query($statement);
}
// location Status update
if(isset($_POST["mechanicStatus"]) && isset($_POST["sid"]))
{
	$statement = "UPDATE `tbl_users` SET `status` = '".$_POST["mechanicStatus"]."' WHERE `mechanic_id` = '".$_POST["sid"]."'";
	$result = $db->query($statement);
}
// mechanic vehicle Status update
if(isset($_POST["mechanicvehicleStatus"]) && isset($_POST["sid"]))
{
	$statement = "UPDATE `tbl_vehicle` SET `status` = '".$_POST["mechanicvehicleStatus"]."' WHERE `id` = '".$_POST["sid"]."'";
	$result = $db->query($statement);
}
//company
if(isset($_POST["companyStatus"]) && isset($_POST["cid"]))
{
	$statement = "UPDATE `tbl_company` SET `status` = '".$_POST["companyStatus"]."' WHERE `id` = '".$_POST["cid"]."'";
	$result = $db->query($statement);
}


// if(isset($_POST["mechanicreportStatus"]) && isset($_POST["sid"]))
// {
// 	$statement = "UPDATE `tbl_vehicle` SET `status` = '".$_POST["mechanicreportStatus"]."' WHERE `id` = '".$_POST["sid"]."'";
// 	$result = $db->query($statement);
// }
?>