<?php
 include_once("connection.php");
 
 $id = $_REQUEST['id'];
			$sql1="select * from tbl_repairs where vehicle_id=$id";
			$result1 = $conn->query($sql1);
			$num_rows = mysqli_num_rows($result1);
	//echo $num_rows;
		
 
					$sql="Select driver_name,contact_no,car_type,model_name,plate_no from tbl_vehicle where id =$id"; 
					//echo $sql;
					$result = $conn->query($sql);
					
					$response = array();
					
					$vehicle = array();
					//$empty_array = array();
					
					while($row = mysqli_fetch_assoc($result)) {
					
						//$response['id'] = $row["id"];
						
						$response['driver_name'] = $row["driver_name"];
						$response['contact_no'] = $row["contact_no"];
						$response['car_type'] = $row["car_type"];
						$response['model_name'] = $row["model_name"];
						$response['plate_no'] = $row["plate_no"];
						
						//echo $response['repair_comment'];
						array_push($vehicle,$response);
						//print_r($vehicle);
				
					}
					
				
			if (mysqli_num_rows($result1)>0) { 
					$sql1="Select repair_comment from tbl_repairs where vehicle_id =$id"; 
					//echo $sql;
					$result1 = $conn->query($sql1);
					$response1 = array();
					$repair = array();
					$result_val = array();
					//echo $sql;
					while($row1 = mysqli_fetch_assoc($result1)) {
					$response1['repair_comment'] = $row1["repair_comment"];
					
					array_push($repair,$response1);
					
					}
					//array_push($vehicle,$repair);
					
			}
			
			
				if($num_rows >0){
			
				$arr = json_encode($vehicle);
				$arr1 = json_encode($repair);
				
				$user[] = json_decode($arr,true);
				$user[] = json_decode($arr1,true);
				 
				echo json_encode($user);
				}
				else
				{
					echo json_encode($vehicle);
				}
				
				
			?>