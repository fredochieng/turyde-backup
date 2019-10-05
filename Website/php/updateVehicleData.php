<?php
	session_start();
	include_once("connection.php");
	
	$id = $_POST['id'];
	$driver_name = $_POST['driver_name'];
	$contact_no = $_POST['contact_no'];
	$car_type = $_POST['car_type'];
	$model_no = $_POST['model_no'];
	$plate_no = $_POST['plate_no'];
	//echo $id;
	
	$sql ="Update tbl_vehicle set driver_name='$driver_name', contact_no='$contact_no', car_type='$car_type', model_name='$model_no', plate_no='$plate_no' where id=$id";
	//echo $sql;
	$result = $conn->query($sql);
	echo '<script>window.location = "index.php"</script>';
	
?>