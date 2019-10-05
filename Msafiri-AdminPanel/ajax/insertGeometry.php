<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
	$address = $_REQUEST['address'];
	$lat = $_REQUEST['lat'];
	$lng = $_REQUEST['lng'];
	
	$selectUser = "SELECT * FROM `tbl_location` WHERE `address` = '".$address."'";
    $resultselectUser = $db->query($selectUser);
    if($resultselectUser->num_rows > 0){
    	echo "exist";
    }
    else{
		$sql = "INSERT INTO tbl_location (address, latitude, longitude)
						VALUES ('".$address."', '".$lat."', '".$lng."')";
		$query = $db->query($sql);
    }
    

?>