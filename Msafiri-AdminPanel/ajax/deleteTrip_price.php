<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
	$id = $_REQUEST['id'];
	$sql ="DELETE FROM `tbl_new_trip_price` WHERE `price_id` = '".$id."'"; 
	$result = $db->query($sql);
	echo "Record Deleted Successfully!";
?>