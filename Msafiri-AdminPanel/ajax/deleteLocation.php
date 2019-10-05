<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
	$id = $_REQUEST['id'];
	
	$sql ="Delete from tbl_location where id=$id"; 
	$result = $db->query($sql);
	echo "Record Deleted Successfully!";
?>