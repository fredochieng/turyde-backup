<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj->db;

if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$sDirPath = COMPANYUPLOADS.$_SESSION['adminData']['id'].'/';
		if (!is_dir($sDirPath))
	   	{
		    mkdir($sDirPath,0777,true);
	    }
		if($_FILES["vehicle_profile"]["name"] != '')
		{
			if(isset($_FILES["vehicle_profile"]))
			{
				$date 			= date('YmdHis');
				$extension 		= explode('.', $_FILES['vehicle_profile']['name']);
				$new_name 		= $_SESSION['adminData']['id']."_".$date."VehPhoto".".".$extension[1];
				$destination 	= $sDirPath.$new_name;
				move_uploaded_file($_FILES['vehicle_profile']['tmp_name'], $destination);
			}
		}
		$sql = "INSERT INTO tbl_driver_vehicle(driver_id,company_id,vehicle_name, vehicle_type,vehicle_number,seats,vehicle_profile)
						VALUES (0,'".$_SESSION['adminData']['id']."','".$_POST['vehicle_name']."','".$_POST['vehicle_type']."','".$_POST['vehicle_number']."','".$_POST['seats']."','".$new_name."')";
		$result = $db->query($sql);
		$vehicle_id  = mysqli_insert_id($db);
    
		
		foreach($_FILES["fileToUploadVehicle"]["name"] as $key2=>$val2)
	    {
			if($_FILES["fileToUploadVehicle"]["name"][$key2] != '')
			{
					$date2 	    = date('YmdHis');
					$extension2 = explode('.', $_FILES['fileToUploadVehicle']['name'][$key2]);
					$new_name2  = $_SESSION['adminData']['id']."_".$date2."PL".$key2 . '.' . $extension2[1];;
					$destination2 = $sDirPath.$new_name2;
					move_uploaded_file($_FILES['fileToUploadVehicle']['tmp_name'][$key2], $destination2);
			
			}
			$sql2 = "INSERT INTO tbl_vehicledetails (vehicle_id,driver_id,photo_type,photo) VALUES ('".$vehicle_id."',0,'plate','".$new_name2."')";
			$result2 = $db->query($sql2);
		}

		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$sDirPath = COMPANYUPLOADS.$_SESSION['adminData']['id'].'/';
		if (!is_dir($sDirPath))
	   	{
		    mkdir($sDirPath,0777,true);
	    }
		if($_FILES["vehicle_profile"]["name"] != '')
		{
			if(isset($_FILES["vehicle_profile"]))
			{
				$date 			= date('YmdHis');
				$extension 		= explode('.', $_FILES['vehicle_profile']['name']);
				$new_name 		= $_SESSION['adminData']['id']."_".$date."VehPhoto".".".$extension[1];
				$destination 	= $sDirPath.$new_name;
				move_uploaded_file($_FILES['vehicle_profile']['tmp_name'], $destination);
			}
		}
		else
		{
			$new_name = $_POST["vehicle_profile_edit"];
		}

		$statement  = "UPDATE tbl_driver_vehicle SET vehicle_name='".$_POST['vehicle_name']."',vehicle_number='".$_POST['vehicle_number']."',vehicle_type='".$_POST['vehicle_type']."',seats='".$_POST['seats']."',vehicle_profile='".$new_name."' WHERE id='".$_POST["vehicle_id"]."'";
		$result = $db->query($statement);

		if($_FILES["fileToUploadVehicle"]["name"][0] != '')
		{
			$deleteDoc = "DELETE from tbl_vehicledetails where vehicle_id='".$_POST['vehicle_id']."' and photo_type = 'plate'";
		    $delRes    = $db->query($deleteDoc);
			foreach($_FILES["fileToUploadVehicle"]["name"] as $key2=>$val2)
		    {
				if($_FILES["fileToUploadVehicle"]["name"][$key2] != '')
				{
						$date2 	    = date('YmdHis');
						$extension2 = explode('.', $_FILES['fileToUploadVehicle']['name'][$key2]);
						$new_name2  = $_SESSION['adminData']['id']."_".$date2."PL".$key2 . '.' . $extension2[1];;
						$destination2 = $sDirPath.$new_name2;
						move_uploaded_file($_FILES['fileToUploadVehicle']['tmp_name'][$key2], $destination2);
				
				}
				$sql2 = "INSERT INTO tbl_vehicledetails (vehicle_id,driver_id,photo_type,photo) VALUES ('".$_POST['vehicle_id']."',0,'plate','".$new_name2."')";
				$result2 = $db->query($sql2);
			}
		}

		if(!empty($result))
		{
			echo 'Data Updated';
		}
	}
}

?>