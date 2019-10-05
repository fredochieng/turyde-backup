<?php
include_once("connection.php");

	$sql ="select * from tbl_country";
	$result = $conn->query($sql);
	
	$response = array();
	$country = array();
	
	while($row = mysqli_fetch_assoc($result)) {
		
		$response['id'] = $row["id"];
		$response['country'] = $row["country"];
		array_push($country,$response);
	}
	
	echo json_encode($country);


?>