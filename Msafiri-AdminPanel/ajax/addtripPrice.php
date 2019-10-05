<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
	$trip_id = $_REQUEST['trip_id'];
	$tripPrice = $_REQUEST['tripPrice'];
	
	$sql = "UPDATE `tbl_driver_setlocation` SET `trip_price` = '".$tripPrice."' WHERE `id` = '".$trip_id."'";
	$query = $db->query($sql);

?>