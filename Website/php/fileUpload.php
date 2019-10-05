<?php
session_start();
	
include_once("connection.php");
$vehicle_id=$_REQUEST['vehicle_id'];
$mechanic_id=$_REQUEST['mechanic_id'];
$target_dir="../upload/";
$target_dir1="../upload1/";
$date=date('YmdHis');
if($_FILES["fileToUpload"]["name"] != '')
{
	if(isset($_FILES["fileToUpload"]))
	{
		$extension 		= explode('.', $_FILES['fileToUpload']['name']);
		$new_name 		= $vehicle_id.$mechanic_id.$date."file".".".$extension[1];
		$destination 	= $target_dir.$new_name;
		move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $destination);
	}
}
else
{
		$new_name = $_POST['fileToUploadOld']; 
}

if($_FILES["fileToUpload1"]["name"] != '')
{
	if(isset($_FILES["fileToUpload1"]))
	{
		$extension1 	= explode('.', $_FILES['fileToUpload1']['name']);
		$new_name1 		= $vehicle_id.$mechanic_id.$date."file1".".".$extension1[1];
		$destination1 	= $target_dir1.$new_name1;
		move_uploaded_file($_FILES['fileToUpload1']['tmp_name'], $destination1);
	}
}
else
{
		$new_name1 = $_POST['fileToUploadOld1']; 
}

    
/* Inserting into Database */

$sql ="Update tbl_vehicle set filename='$new_name' where id = $vehicle_id";
//echo $sql;
$result = $conn->query($sql);
$sql1 ="Update tbl_vehicle set filename1='$new_name1' where id = $vehicle_id";
//echo $sql;
$result1 = $conn->query($sql1);
	
	


?>