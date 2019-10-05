<?php
include '../configClass.php';
$newobj = new connectionClass();
$db = $newobj->db;

if(isset($_POST["operation"]))
{
	$dob = date("Y-m-d", strtotime(str_replace('/','-',$_POST["dob"])));
	if($_POST["operation"] == "Add")
	{
       $sql = "INSERT INTO tbl_driverdata (type,company_id,fullname,email,password,old_password,authentication_code,sentcode,device_id,device_token,status,approvel)
		VALUES ('company','".$_SESSION['adminData']['id']."','".$_POST["fullname"]."','".$_POST["email"]."','','','123456','','','','active','yes')";
		$result 		= $db->query($sql);
		$driver_id    	= mysqli_insert_id($db);

		$sDirPath = DRIVERUPLOADS.$driver_id.'/';
		if (!is_dir($sDirPath))
	   	{
		    mkdir($sDirPath,0777,true);
	    }
	    
	    if($_FILES["photo"]["name"] != '')
		{
			if(isset($_FILES["photo"]))
			{
				$date 			= date('YmdHis');
				$extension 		= explode('.', $_FILES['photo']['name']);
				$new_name 		= $_SESSION['adminData']['id']."_".$date."D".".".$extension[1];
				$destination 	= $sDirPath.$new_name;
				move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
			}
		}

		$sql1 = "INSERT INTO tbl_driverdetails (driver_id,gender,dob,street, city,state,country,mobile_number,photo,postal_code,vehicle_profile,licence,ratting)VALUES ('".$driver_id."','".$_POST["gender"]."','".$dob."','".$_POST["street"]."','".$_POST["city"]."', '".$_POST["state"]."','".$_POST["country"]."','".$_POST["mobile_number"]."','".$new_name."','".$_POST["postal_code"]."','','','')";
		$result1 = $db->query($sql1);
		
		if($_FILES["licence"]["name"] != '')
		{
				$date1 	    = date('YmdHis');
				$extension1 = explode('.', $_FILES['licence']['name']);
				$new_name1  = $_SESSION['adminData']['id']."_".$date1."LIC". '.' . $extension1[1];;
				$destination1 = $sDirPath.$new_name1;
				move_uploaded_file($_FILES['licence']['tmp_name'], $destination1);
		
		}
		$sql3 = "INSERT INTO tbl_driverdocuments (driver_id,photo_type,photo) VALUES ('".$driver_id."','licence','".$new_name1."')"; //echo $sql3;
		$result3 = $db->query($sql3);
		
		foreach($_FILES["document"]["name"] as $key2=>$val2)
	    {
			if($_FILES["document"]["name"][$key2] != '')
			{
					$date2 	    = date('YmdHis');
					$extension2 = explode('.', $_FILES['document']['name'][$key2]);
					$new_name2  = $_SESSION['adminData']['id']."_".$date2."DOC".$key2 . '.' . $extension2[1];;
					$destination2 = $sDirPath.$new_name2;
					move_uploaded_file($_FILES['document']['tmp_name'][$key2], $destination2);
			
			}
			$sql2 = "INSERT INTO tbl_driverdocuments (driver_id,photo_type,photo) VALUES ('".$driver_id."','proof','".$new_name2."')"; //echo $sql3;
			$result2 = $db->query($sql2);
		}

		if(!empty($result))
		{
			echo 'Data Inserted';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$sDirPath = DRIVERUPLOADS.$driver_id.'/';
		if (!is_dir($sDirPath))
	   	{
		    mkdir($sDirPath,0777,true);
	    }
	    if($_FILES["photo"]["name"] != '')
		{
			if(isset($_FILES["photo"]))
			{
				$date 			= date('YmdHis');
				$extension 		= explode('.', $_FILES['photo']['name']);
				$new_name 		= $_SESSION['adminData']['id']."_".$date."D".".".$extension[1];
				$destination 	= $sDirPath.$new_name;
				move_uploaded_file($_FILES['photo']['tmp_name'], $destination);
			}
		}
		else
		{
			$new_name = $_POST["photo_edit"];
		}
		$statement  = "UPDATE tbl_driverdata SET fullname='".$_POST['fullname']."',email='".$_POST['email']."',password='".md5($_POST['password'])."',old_password='".md5($_POST['password'])."' WHERE id='".$_POST["driver_id"]."'";
		$result = $db->query($statement);

		
		$dob 		= date("Y-m-d", strtotime(str_replace('/','-',$_POST["dob"])));
		$statement1 = "UPDATE tbl_driverdetails SET gender='".$_POST['gender']."',dob='".$dob."',street='".$_POST['street']."',city='".$_POST['city']."',state='".$_POST['state']."',country='".$_POST['country']."',mobile_number='".$_POST['mobile_number']."',photo='".$new_name."',postal_code='".$_POST['postal_code']."' WHERE driver_id='".$_POST["driver_id"]."'";
		$result1 = $db->query($statement1);

		if($_FILES["licence"]["name"] != '')
		{
				$deleteDoc = "DELETE from tbl_driverdocuments where driver_id='".$_POST['driver_id']."' and photo_type = 'licence'";
			    $delRes    = $db->query($deleteDoc);

				$date1 	    = date('YmdHis');
				$extension1 = explode('.', $_FILES['licence']['name']);
				$new_name1  = $_SESSION['adminData']['id']."_".$date1."LIC". '.' . $extension1[1];;
				$destination1 = $sDirPath.$new_name1;
				move_uploaded_file($_FILES['licence']['tmp_name'], $destination1);
			
				$sql3 = "INSERT INTO tbl_driverdocuments (driver_id,photo_type,photo) VALUES ('".$_POST["driver_id"]."','licence','".$new_name1."')"; //echo $sql3;
				$result3 = $db->query($sql3);
			
		}
		else
		{
			$new_name1 = $_POST["licence_edit"];
		}
		// $statement2  = "UPDATE tbl_driverdocuments SET photo='".$new_name1."' WHERE driver_id='".$_POST["driver_id"]."'";
		// $result2 = $db->query($statement2);


		if($_FILES["document"]["name"][0] != '')
		{
			$deleteDoc = "DELETE from tbl_driverdocuments where driver_id='".$_POST['driver_id']."' and photo_type = 'proof'";
		    $delRes    = $db->query($deleteDoc);
			foreach($_FILES["document"]["name"] as $key2=>$val2)
		    {
				if($_FILES["document"]["name"][$key2] != '')
				{
					$date2 	    = date('YmdHis');
					$extension2 = explode('.', $_FILES['document']['name'][$key2]);
					$new_name2  = $_SESSION['adminData']['id']."_".$date2."DOC".$key2 . '.' . $extension2[1];;
					$destination2 = $sDirPath.$new_name2;
					move_uploaded_file($_FILES['document']['tmp_name'][$key2], $destination2);
				
				}

				$sql2 = "INSERT INTO tbl_driverdocuments (driver_id,photo_type,photo) VALUES ('".$_POST["driver_id"]."','proof','".$new_name2."')"; //echo $sql3;
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