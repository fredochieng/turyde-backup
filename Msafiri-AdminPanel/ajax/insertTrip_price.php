<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
	$from_address = $_REQUEST['from_address'];
	$to_address = $_REQUEST['to_address'];
	$price = $_REQUEST['add_price'];
	$type = $_REQUEST['type'];

	// get lat1 and lng1
	$selectFromadd = "SELECT * FROM `tbl_location` WHERE `address` = '".$from_address."'";
    $resultFromadd = $db->query($selectFromadd);
    $getLatlong1 = $resultFromadd->fetch_assoc();

    // get lat2 and lng2
    $selectFromadd2 = "SELECT * FROM `tbl_location` WHERE `address` = '".$to_address."'";
    $resultFromadd2 = $db->query($selectFromadd2);
    $getLatlong2 = $resultFromadd2->fetch_assoc();

	$lat1 = $getLatlong1['latitude'];
	$lng1 = $getLatlong1['longitude'];
	$lat2 = $getLatlong2['latitude'];
	$lng2 = $getLatlong2['longitude'];

	$selectTrip = "SELECT * FROM `tbl_new_trip_price` WHERE `from_address` = '".$from_address."' AND `to_address` = '".$to_address."'";
    $resultTrip = $db->query($selectTrip);
    if($resultTrip->num_rows > 0){
    	echo "exist";
    }
    else{
    	if($type == 'per_distance'){
			// distance
			$distance = $newobj->calDistance($lat1,$lng1,$lat2,$lng2,'K');
			$calPrice = $price * $distance;
			$getprice = number_format($calPrice, 2);
		}
		else{
			$getprice = $price;
		}
		$sql = "INSERT INTO tbl_new_trip_price (type,from_address, to_address, price)
						VALUES ('".$type."','".$from_address."', '".$to_address."', '".$getprice."')";
		$query = $db->query($sql);
    }
    

?>