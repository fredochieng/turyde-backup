<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
	$response = array();
		$location = array();
	$sql = "SELECT id,address,latitude,longitude FROM tbl_location";
			$result = $db->query($sql);
			//$users = mysqli_fetch_assoc($result);
			while($row = mysqli_fetch_assoc($result)) {
				$response['id'] = $row["id"];
			    $response['address'] = $row["address"];
				$response['latitude'] = $row["latitude"];
				$response['longitude'] = $row["longitude"];
				
				array_push($location,$response);
        
			}
			echo json_encode($location);
?>