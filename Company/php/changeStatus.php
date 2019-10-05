<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;

// driver update
if(isset($_POST["driverStatus"]) && isset($_POST["sid"]))
{
	$statement = "UPDATE `tbl_driverdata` SET `status` = '".$_POST["driverStatus"]."' WHERE `id` = '".$_POST["sid"]."'";
	$result = $db->query($statement);
}

?>