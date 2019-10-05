<?php
	session_start();
	include("connection.php");
	
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$pwd1=md5($pwd);
	
	$sql = "SELECT mechanic_id, email_id,full_name,pwd FROM tbl_users WHERE email_id='$email' and pwd='$pwd1'";
	$result = $conn->query($sql);
	//echo $sql;
	
	$num_rows = mysqli_num_rows($result);
	//echo $num_rows;
	while($row = mysqli_fetch_assoc($result)) {
		$id = $row["mechanic_id"];
		$full_name = $row["full_name"];
		}
		//echo $id;
	if (mysqli_num_rows($result)>0) { 
			$_SESSION['id'] = $id;
			$_SESSION['full_name'] = $full_name;
		echo '<script>window.location = "index.php"</script>';
	}
	else
	{
		/* If user is registered but access is not yet approved */
			$sql1 = "SELECT mechanic_id, email_id,full_name,pwd FROM tbl_users WHERE email_id='$email' and pwd='$pwd1' and status='active'";
			$result1 = $conn->query($sql1);
			if (mysqli_num_rows($result1)>0) { 
					echo "Access is not yet approved by admin";
			}
			else{
			echo "Username and passsword dosen't match ";
		
			}
	}
	
	
?>