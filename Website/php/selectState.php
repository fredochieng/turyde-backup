<?php
include_once("connection.php");
$country = $_REQUEST['country'];

	$sql ="select id from tbl_country where country='$country'";
	$result = $conn->query($sql);
	
	$response = array();
	$state = array();
	
	while($row = mysqli_fetch_assoc($result)) {
		$id = $row["id"];
		
		}
		$sql1 ="select state_id, state from tbl_state where country_id='$id'"; //echo $sql1;
		$result1 = $conn->query($sql1);
		while($row = mysqli_fetch_assoc($result1)) {
		
		$response['state_id'] = $row["state_id"];
		$response['state'] = $row["state"];
		array_push($state,$response);
		}
		echo json_encode($state);


?>