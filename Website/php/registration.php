<?php
	session_start();
	
	include_once("connection.php");
	
	$full_name = $_POST['full_name'];
	$phone_no = $_POST['phone_no'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];
	$cpwd = $_POST['cpwd'];
	$street = $_POST['street'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$pwd1=md5($pwd);
	$cpwd1=md5($cpwd);
	
	//get country
	$sql1 ="select country from tbl_country where id =$country";
	$result1 = $conn->query($sql1);
	while($row1 = mysqli_fetch_assoc($result1)) {
		$country = $row1["country"];
		}
	//get state
	$sql2 ="select state from tbl_state where state_id =$state";
	$result2 = $conn->query($sql2);
	while($row2= mysqli_fetch_assoc($result2)) {
		$state = $row2["state"];
		}
	
	
	//echo $contact_no;
	
	$sql ="select email_id from tbl_users where email_id ='$email'";
	$result = $conn->query($sql);
	$num_rows = mysqli_num_rows($result);
	$date =  date('Y-m-d H:i:s');
	//echo $date;
	
	if (mysqli_num_rows($result)>0) { 
			
		echo 'This email is already been registered!';
	}
	else
	{
		//$_SESSION['email'] = $email;
		$sql = "INSERT INTO tbl_users (full_name,phone_no,email_id,pwd,con_pwd,street,city,state,country,date_time)
					VALUES ('$full_name', '$phone_no', '$email','$pwd1','$cpwd1','$street','$city','$state','$country','$date')";
					//echo $sql;

				if (mysqli_query($conn, $sql)) {
						echo "You are been registered, you will get approval notice soon!";
						$_SESSION['email']      = $email;
						$id    	                = mysqli_insert_id($conn);
						$_SESSION['id']         = $id;
			            $_SESSION['full_name']  = $full_name;
						echo '<script>window.location = "index.php"</script>';
					} else {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
	}
	
	
			
	
?>