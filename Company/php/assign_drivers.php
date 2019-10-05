<?php
include '../configClass.php';
$newobj = new connectionClass();
$db 	= $newobj ->db;
if(isset($_POST["operation"]))
{

	if($_POST["operation"] == "Add")
	{
		$statement   = "INSERT INTO `tbl_assign_driver`(`company_id`,`driver_id`,`vehicle_id`) VALUES ('".$_POST['company_id']."','".$_POST['driver_id']."','".$_POST['vehicle_id']."')";
		$result = $db->query($statement);

		$statement  = "UPDATE tbl_driver_vehicle SET driver_id='".$_POST['driver_id']."' WHERE id ='".$_POST["vehicle_id"]."'";
		$result = $db->query($statement);

		$statement1  = "UPDATE tbl_vehicledetails SET driver_id='".$_POST['driver_id']."' WHERE vehicle_id ='".$_POST["vehicle_id"]."'";
		$result1     = $db->query($statement1);

		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
}

?>