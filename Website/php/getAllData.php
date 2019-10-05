<?php
	session_start();
	include_once("connection.php");
	
	$id = $_GET['id'];
	//echo $id;
	
		$sql = "SELECT id,driver_name,contact_no,car_type,model_name,plate_no FROM tbl_vehicle where mechanic_id=$id limit 5";
		$result = $conn->query($sql);
		//echo $sql;
		$response = array();
		$vehicle = array();
		
			while($row = mysqli_fetch_assoc($result)) {
			
				$response['id'] = $row["id"];
				$response['contact_no'] = $row["contact_no"];
			    $response['driver_name'] = $row["driver_name"];
				$response['car_type'] = $row["car_type"];
				$response['model_name'] = $row["model_name"];
				$response['plate_no'] = $row["plate_no"];
				
				array_push($vehicle,$response);
        
			}
			echo json_encode($vehicle);
?>