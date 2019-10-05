<?php
	session_start();
	
	include_once("connection.php");
	
	$driver_name = $_POST['driver_name'];
	$contact_no = $_POST['contact_no'];
	$car_type = $_POST['car_type'];
	$model_no = $_POST['model_no'];
	$plate_no = $_POST['plate_no'];
	$mechanic_id = $_POST['id'];
	$repairs=$_POST['repairs'];
	//echo $mechanic_id."Arpi";
	/* Convert sterialized string to array */
	$params = array();
	parse_str($repairs, $params);
	
	/* Validation*/
	if (empty($driver_name)) {
    echo 'Driver Name is required'."<br/>";
	}
	if (empty($contact_no)) {
    echo 'Contact No is required'."<br/>";
	}
	if (empty($car_type)) {
    echo 'Car Type is required'."<br/>";
	}
	if (empty($model_no)) {
    echo 'Model No. is required'."<br/>";
	}
	if (empty($plate_no)) {
    echo 'Plate no. is required'."<br/>";
	}
		

	
	$sql ="select plate_no from tbl_vehicle where plate_no ='$plate_no'";
	$result = $conn->query($sql);
	$num_rows = mysqli_num_rows($result);
	//echo $num_rows;
	
	if (mysqli_num_rows($result)>0) { 
			
		echo 'This Car is already been registered!';
	}
	else
	{
		
			if(!empty($driver_name) && !empty($contact_no) && !empty($car_type) && !empty($model_no) && !empty($plate_no) )
				{
						if($repairs != ""){
								$sql = "INSERT INTO tbl_vehicle (mechanic_id,driver_name,contact_no,car_type,model_name,plate_no,filename,filename1)
								VALUES ($mechanic_id,'$driver_name', '$contact_no', '$car_type','$model_no','$plate_no','','')";
								if (mysqli_query($conn, $sql)) {
									$last_id = mysqli_insert_id($conn);
								}
								$number = count($params['repairs']);
								//echo $number;
						
								if($number > 0){
								for($i=0;$i<$number;$i++){
										$val = $params['repairs'][$i];
										$sql = "INSERT INTO tbl_repairs (mechanic_id,vehicle_id,repair_comment)
												VALUES ($mechanic_id,$last_id,'$val')"; //echo $sql;
										if (mysqli_query($conn, $sql)) {
											echo "New record created successfully";
											//$_SESSION['email'] = $email;
											echo '<script>window.location = "index.php"</script>';
										} else {
											echo "Error: " . $sql . "<br>" . mysqli_error($conn);
										}
									}
								}
						}
						else{
							$sql = "INSERT INTO tbl_vehicle (mechanic_id,driver_name,contact_no,car_type,model_name,plate_no,filename,filename1)
							VALUES ($mechanic_id,'$driver_name', '$contact_no', '$car_type','$model_no','$plate_no','','')";
							if (mysqli_query($conn, $sql)) {
								echo '<script>window.location = "index.php"</script>';
							}
					
						}
				 
					}
				
				}

?>