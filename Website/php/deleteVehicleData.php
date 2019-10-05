<?php
	session_start();
	include_once("connection.php");
	$id = $_POST['id'];
	
	$sql ="Delete from tbl_vehicle where id=$id"; 
	$result = $conn->query($sql);
	
	
	//echo '<script>window.location = "index.php"</script>';
	echo "Record Deleted Successfully!";
	
?>