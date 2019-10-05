<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;

// user delete
if(isset($_POST["action"]) && $_POST["action"] == 'userDelete' && isset($_POST["user_id"]))
{
	$statement = "DELETE FROM `tbl_userdata` WHERE `tbl_userdata`.`id` = '".$_POST["user_id"]."'";
	$result = $db->query($statement);
}

// driver delete
if(isset($_POST["action"]) && $_POST["action"] == 'driverDelete' && isset($_POST["driver_id"]))
{
	$statement = "DELETE FROM `tbl_driverdata` WHERE `tbl_driverdata`.`id` = '".$_POST["driver_id"]."'";
	$result = $db->query($statement);
}
// mechanic delete
if(isset($_POST["action"]) && $_POST["action"] == 'mechanicDelete' && isset($_POST["mechanic_id"]))
{
	$statement = "DELETE FROM `tbl_users` WHERE `tbl_users`.`mechanic_id` = '".$_POST["mechanic_id"]."'";
	$result = $db->query($statement);
}
// company delete
if(isset($_POST["action"]) && $_POST["action"] == 'companyDelete' && isset($_POST["company_id"]))
{
	$statement = "DELETE FROM `tbl_company` WHERE `id` = '".$_POST["company_id"]."'";
	$result = $db->query($statement);
}
?>