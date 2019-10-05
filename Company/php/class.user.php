<?php
include("connection.php");
$newobj = new connectionClass();
$db = $newobj ->db;
class User{
	public $db;

        public function __construct(){

            $this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

            if(mysqli_connect_errno()) {
                echo "Error: Could not connect to database.";
                    exit;
            }
        }


		public function check_login($email, $pwd){
				$sql = "SELECT * FROM tbl_company WHERE email='$email' and password='".md5($pwd)."'";
				$result = $this->db->query($sql);
				$num_rows = mysqli_num_rows($result);
				
				while($row = mysqli_fetch_assoc($result)) {
				$id = $row["id"];
				$email = $row["email"];
				$pass = $row["password"];
				$fullname = $row["fullname"];
				}
				
				if (mysqli_num_rows($result)>0) { 
					$_SESSION['id'] = $id; 
					$_SESSION['email'] = $email; 
					$_SESSION['fullname'] = $fullname;
					return true;
				}
				else{
					return false;
				}
		}
		
		public function insert_GeoLocation($address_pickup,$address_dest,$dt_pickup,$dt_dest,$id){
			$managePic 			= "SELECT * from tbl_location where address = '".$address_pickup."'";
			$resultManagePic 	= $this->db->query($managePic);
			while($pick = mysqli_fetch_assoc($resultManagePic)) {
				$lat_pickup =  $pick['latitude'];
				$lng_pickup =  $pick['longitude'];
			}
			$manageDes 			= "SELECT * from tbl_location where address = '".$address_dest."'";
		    $resultManageDest 	= $this->db->query($manageDes);
			while($dest = mysqli_fetch_assoc($resultManageDest)) {
			
			$lat_dest 	=  $dest['latitude'];
			$lng_dest 	=  $dest['latitude'];
		}
			
			$sql = "INSERT INTO tbl_driver_setlocation (driver_id, from_title, from_lat, from_lng,from_address, datetime, to_title, to_lat, to_lng,to_address, end_datetime)VALUES ($id,'$address_pickup', '$lat_pickup', '$lng_pickup','$address_pickup','$dt_pickup','$address_dest','$lat_dest','$lng_dest','$address_dest','$dt_dest')";
			if(mysqli_query($this->db, $sql)){
				return true;
			}
			else{
				return false;
			}
		}
		public function paging($id){
		$sql = "SELECT count(*) as 'total' FROM tbl_route where company_id=$id";
		$result = $this->db->query($sql);
			//echo $sql;
			$response = array();
			$route = array();
			while($row = mysqli_fetch_assoc($result)) {
			
				$response['total'] = $row["total"];
				array_push($route,$response);
				}
			echo json_encode($route);	
	    }
		public function getRoute($id,$page,$result_per_page){
			$start_from = ($page-1) * $result_per_page;
			$sql = "SELECT r.* FROM tbl_driver_setlocation as r left join tbl_driverdata as d ON d.id=r.driver_id where d.company_id=$id ORDER BY r.id ASC LIMIT $start_from, ".$result_per_page;
			$result = $this->db->query($sql); 
			$response = array();
			$route = array();
		
			while($row = mysqli_fetch_assoc($result)) {
				$response['id'] = $row["id"];
				$response['pickup_location'] = $row["from_address"];
			    $response['destination_location'] = $row["to_address"];
				$response['pickup_datetime'] = $row["datetime"];
			    $response['destination_datetime'] = $row["end_datetime"];
				array_push($route,$response);
			}
			echo json_encode($route);
		}
				
		/* getRouteData : for Edit */
		public function getRouteData($id){
			$sql = "SELECT * FROM tbl_driver_setlocation where id=$id";
			$result = $this->db->query($sql);
			$response = array();
			$route = array();
		
			while($row = mysqli_fetch_assoc($result)) {
			
				$response['id'] = $row["id"];
				$response['address_pickup'] = $row["from_address"];
			    $response['address_dest'] = $row["to_address"];
				
				array_push($route,$response);
        
			}
			echo json_encode($route);
		}
		
		/* Saving an edited route in database */
		public function saveEditRouteData($id,$add_pickup,$add_dest){
			$sql = "Update tbl_driver_setlocation set from_address = '$add_pickup', to_address = '$add_dest' where id =$id";
			//echo $sql;
			if(mysqli_query($this->db, $sql)){
			return true;
			}
			else{
				return false;
			}
		}
		
		/* Delete route */
		public function removeRoute($id){
			$sql = "Delete from tbl_driver_setlocation where id = $id";
			if(mysqli_query($this->db, $sql)){
			return true;
			}
			else{
				return false;
			}
		}
		
		/* Get Vehicle Data to Datatables */
		public function getVehicle($id){
			$sql = "SELECT * FROM tbl_driver_vehicle where company_id=$id";
			$result = $this->db->query($sql);
			//echo $sql;
			$response = array();
			$vehicle = array();
			$count = 1;
			while($row = mysqli_fetch_assoc($result)) {
				$response['count'] = $count++;
				$response['vehicle_id'] = $row["id"];
				//$response['photo'] = $row["id"];
				$response['vehicle_name'] = $row["vehicle_name"];
			    $response['vehicle_type'] = $row["vehicle_type"];
				$response['vehicle_number'] = $row["vehicle_number"];
				$response['seats'] = $row["seats"];
				array_push($vehicle,$response);
			}
			echo json_encode($vehicle);
		}
		/* To get vehicle data to update it */
		public function getVehicleUpdate($vehicle_id){
			$sql= "Select id,vehicle_name,vehicle_type, vehicle_number,seats,company_id,vehicle_profile from tbl_driver_vehicle where id=$vehicle_id";
			$result = $this->db->query($sql);
			//echo $sql;
			$response = array();
			$vehicle = array();
			while($row = mysqli_fetch_assoc($result)) {
				$response['id'] = $row["id"];
				$response['vehicle_name'] = $row["vehicle_name"];
				$response['vehicle_type'] = $row["vehicle_type"];
			    $response['vehicle_number'] = $row["vehicle_number"];
				$response['seats'] = $row["seats"];
				$response['company_id'] = $row["company_id"];
				$response['vehicle_profile'] = $row["vehicle_profile"];
			
				array_push($vehicle,$response);
        
			}
			echo json_encode($vehicle);
		}
		
		/* Update Vehicle */
		public function updateVehicle($vehicle_id, $vehicle_type, $vehicle_model, $plate_no, $seats, $target_file){
			$sql1 = "Update tbl_driver_vehicle set vehicle_name = '$vehicle_type', vehicle_type ='$vehicle_model', vehicle_number='$plate_no', seats=$seats, vehicle_profile='$target_file' where id=$vehicle_id";
			$result = mysqli_query($this->db, $sql1);
			
			if($result){
				return true;
				}else{
				return false;
				}
		}
		
		/* Check for plate not in database */
		
		public function verifyPlateNo($vehicle_number){
		$sql = "SELECT vehicle_number from tbl_driver_vehicle  WHERE vehicle_number='$vehicle_number'";
		//echo $sql;
		$result = $this->db->query($sql);
		
		if (mysqli_num_rows($result)>0) { 
					return true;
				}
				else{
				return false;
				}
		}
		
		/* Add New Driver */
		public function addVehicleDetails($company_id,$vehicle_type,$vehicle_model,$plate_no,$seats,$target_file,$imageVeh){
		$sql = "INSERT INTO tbl_driver_vehicle (driver_id,company_id,vehicle_name, vehicle_type,vehicle_number,seats,vehicle_profile)
						VALUES (0,$company_id,'$vehicle_type','$vehicle_model','$plate_no',$seats,'$target_file')";
						$result = mysqli_query($this->db, $sql);
		$vehicle_id = mysqli_insert_id($this->db);
		
		 
		 $fileCount = count($imageVeh); //echo $fileCount;
		 $lic = "LIC";
		 $doc = "DOC";
		 //for($i=0;$i<$fileCount;$i++){
		 foreach ($imageVeh as $value) {
		 //$docFileType =  implode(', ', $docFile);
			 if( strpos( $value , "Veh" )) {
				$photo_type = "photo";
								
			}
			if( strpos( $value, "pl" )) {
				$photo_type = "plate";
								
			}
		$sql3 = "INSERT INTO tbl_vehicledetails (vehicle_id,driver_id,photo_type,photo) VALUES ($vehicle_id,0,'$photo_type','$value')";
		$result3 = mysqli_query($this->db, $sql3);
		}
		
		 
		if($result && $result3){
			return true;
			}
			else{
				return false;
			}
		}
		
		/* Get Individual Vehicle Details */
		public function getIndVehicleDetails($vehicle_id){
		$sql= "Select vehicle_name,vehicle_type, vehicle_number,seats from tbl_driver_vehicle where id=$vehicle_id";
			$result = $this->db->query($sql);
			//echo $sql;
			$response = array();
			$vehicle = array();
		
			while($row = mysqli_fetch_assoc($result)) {
			
				//$response['id'] = $row["id"];
				$response['vehicle_name'] = $row["vehicle_name"];
				$response['vehicle_type'] = $row["vehicle_type"];
			    $response['vehicle_number'] = $row["vehicle_number"];
				$response['seats'] = $row["seats"];
			
				array_push($vehicle,$response);
        
			}
			echo json_encode($vehicle);
		}
		
		/* Delete Vehicle */
		public function deleteVehicle($vehicle_id){
			$sql = "Delete from tbl_driver_vehicle where id=$vehicle_id"; echo $sql;
			$result = mysqli_query($this->db, $sql);
			if($result){
			return true;
			}
			else{
				return false;
			}
		}
		
		/* Get Driver Details */
		public function getDriver($id){
			$sql = "SELECT tbl_driverdetails.driver_id, tbl_driverdata.id,photo, fullname, email, mobile_number, state, city, status from tbl_driverdetails, tbl_driverdata where tbl_driverdata.id = tbl_driverdetails.driver_id and tbl_driverdata.company_id = '".$id."'";
			$result = $this->db->query($sql);
			//echo $sql;
			$response = array();
			$driver = array();
			$count 	= 1;
			while($row = mysqli_fetch_assoc($result)) {
				$response['count'] = $count++;
				$response['driver_id'] = $row["driver_id"];
				$response['photo'] = ADMINROOT.'uploadDriverImage/'.$row["photo"];
				$response['fullname'] = $row["fullname"];
			    $response['email'] = $row["email"];
				$response['mobile_number'] = $row["mobile_number"];
				$response['state'] = $row["state"];
				$response['city'] = $row["city"];
				$response['status'] = $row["status"];
				array_push($driver,$response);
        
			}
			echo json_encode($driver);
		}
		
		/* Edit Driver Details */
		public function driverEditDetails($driver_id){
			$sql = "SELECT tbl_driverdetails.driver_id, tbl_driverdata.id, fullname, tbl_driverdetails.photo,email, mobile_number, dob, gender, street, country, state, city, postal_code, password from tbl_driverdetails, tbl_driverdata, tbl_driverdocuments where tbl_driverdocuments.driver_id = tbl_driverdetails.driver_id and photo_type='license' and tbl_driverdata.id = tbl_driverdetails.driver_id and tbl_driverdetails.driver_id=$driver_id";
			$result = $this->db->query($sql);
			//echo $sql;
			$response = array();
			$driver = array();
		
			while($row = mysqli_fetch_assoc($result)) {
			
				$response['driver_id'] = $row["driver_id"];
				$response['photo'] = $row["photo"];
				$response['fullname'] = $row["fullname"];
			    $response['email'] = $row["email"];
				$response['mobile_number'] = $row["mobile_number"];
				$response['dob'] = $row["dob"];
				$response['gender'] = $row["gender"];
				$response['street'] = $row["street"];
				$response['country'] = $row["country"];
				$response['state'] = $row["state"];
				$response['city'] = $row["city"];
				$response['postal_code'] = $row["postal_code"];
				$response['password'] = $row["password"];
				array_push($driver,$response);
        
			}
			echo json_encode($driver);
		}
		
		/* Update Driver Details */
		public function updateDriverDetails($driver_id,$fullname,$email,$phone,$dob,$gender,$street,$country,$state,$city,$zipcode,$password,$fileName,$driver_photo){
			
			$sql = "Update tbl_driverdetails, tbl_driverdata set fullname = '$fullname', email = '$email', mobile_number = '$phone', dob='$dob', gender='$gender', street='$street', country='$country', state='$state', city='$city', postal_code='$zipcode', password='$password',photo='$driver_photo' where tbl_driverdata.id = tbl_driverdetails.driver_id and driver_id=$driver_id";
			if($fileName != ""){
				$sql1 = "Update tbl_driverdocuments set  photo ='$fileName' where photo_type='license' and driver_id=$driver_id";
			    mysqli_query($this->db, $sql1);
			}
			//echo $sql;
			if(mysqli_query($this->db, $sql)){
			return true;
			}
			else{
				return false;
			}
		}
		public function updateDriverstatus($driver_id){
		$sql = "select status from tbl_driverdata where id=$driver_id";
		$result = $this->db->query($sql);
		$response = array();
		$status_act = array();
		$status_deact = array();
		$status = array();
		
			while($row = mysqli_fetch_assoc($result)) {
			
				$response['status'] = $row["status"];
			
			//array_push($status,$response);
				if($response['status'] == "active"){
				$sql = "Update tbl_driverdata set status = 'deactive' where id = $driver_id"; echo $sql;
				//$result = $this->db->query($sql);
				mysqli_query($this->db, $sql);
				
				$status_act['status'] = 'deactive';
				array_push($status,$status_act);
				}
				if($response['status'] == "deactive"){
				$sql = "Update tbl_driverdata set status = 'active' where id = $driver_id";
				//$result = $this->db->query($sql);
				mysqli_query($this->db, $sql);
				
				$status_act['status'] = 'active';
				array_push($status,$status_act);
				}
			
			
			}
			echo json_encode($status);
		}
		
		/* Add New Driver */
		public function addDriverDetails($company_id, $fullname,$email,$phone,$dob,$gender,$street,$country,$state,$city,$zipcode,$password,$authentication_code,$docFile,$driver_photo){
		$sql = "INSERT INTO tbl_driverdata (type,company_id,fullname, email,password,old_password,authentication_code,sentcode,device_id,device_token,status)
						VALUES ('company',$company_id,'$fullname','$email','$password','$password','$authentication_code','','','','deactive')";
		$result = mysqli_query($this->db, $sql);
		$driver_id = mysqli_insert_id($this->db);
		if (!file_exists('../../M-safiri-API/driver_uploads/'.$driver_id)) {
		    mkdir('../../M-safiri-API/driver_uploads/'.$driver_id, 0777, true);
		}
		$sql1 = "INSERT INTO tbl_driverdetails (driver_id,gender, dob, street, city, state, country,mobile_number,photo, postal_code,vehicle_profile,licence,ratting)
						VALUES ($driver_id,'$gender', '$dob','$street', '$city', '$state', '$country','$phone','$driver_photo','$zipcode','','','')";
		 $result1= mysqli_query($this->db, $sql1);		
		 $fileCount = count($docFile); //echo $fileCount;
		 $lic = "LIC";
		 $doc = "DOC";
		 //for($i=0;$i<$fileCount;$i++){
		 foreach ($docFile as $value) {
		 //$docFileType =  implode(', ', $docFile);
			 if( strpos( $value , "LIC" )) {
				$photo_type = "license";
								
			}
			if( strpos( $value, "DOC" )) {
				$photo_type = "proof";					
			}
		$sql3 = "INSERT INTO tbl_driverdocuments (driver_id,photo_type,photo) VALUES ($driver_id,'$photo_type','$value')"; //echo $sql3;
		$result3 = mysqli_query($this->db, $sql3);
		}
		
		 
		if($result && $result1 && $result3){
			return true;
			}
			else{
				return false;
			}
			 }
			 
		/* Checking for existing user */
		
		public function checkEmail($email){
		$sql = "SELECT email from tbl_driverdata  WHERE email!='$email'";
		$result = $this->db->query($sql);
		
		if (mysqli_num_rows($result)>0) { 
					return true;
				}
				else{
				return false;
				}
		}
		public function checkUpdateEmail($email,$driver_id){
		$sql = "SELECT count(*) from tbl_driverdata  WHERE email!='$email' and id=$driver_id";
		$result = $this->db->query($sql);
		
		if (mysqli_num_rows($result)>0) { 
					return true;
				}
				else{
				return false;
				}
		}
		
		
		/* Delete Driver */
		
		public function deleteDriver($driver_id){
		$sql = "Delete from tbl_driverdata where id=$driver_id"; echo $sql;
		$result = mysqli_query($this->db, $sql);
		$sql1 = "Delete from tbl_driverdetails where driver_id=$driver_id"; echo $sql1;
		$result1 = mysqli_query($this->db, $sql1);
		$sql2 = "Delete from tbl_driverdocuments where driver_id=$driver_id"; echo $sql2;
		$result2 = mysqli_query($this->db, $sql2);
		
		if($result && $result1 && $result2){
			return true;
			}
			else{
				return false;
			}
		}
		
		public function getDriverDetails($driver_id){
		$sql = "SELECT tbl_driverdata.id, fullname, driver_photo, email, mobile_number, dob, gender, street, city, state, status from tbl_driverdetails, tbl_driverdata where  tbl_driverdata.id = tbl_driverdetails.driver_id and tbl_driverdetails.driver_id=$driver_id";
		$result = $this->db->query($sql);
			//echo $sql;
			$response = array();
			$driver = array();
		
			while($row = mysqli_fetch_assoc($result)) {
			
				$response['id'] = $row["id"];
				$response['driver_photo'] = $row["driver_photo"];
				$response['fullname'] = $row["fullname"];
			    $response['email'] = $row["email"];
				$response['mobile_number'] = $row["mobile_number"];
				$response['dob'] = $row["dob"];
				$response['gender'] = $row["gender"];
				$response['street'] = $row["street"];
				//$response['country'] = $row["country"];
				$response['state'] = $row["state"];
				$response['city'] = $row["city"];
				$response['status'] = $row["status"];
				//$response['postal_code'] = $row["postal_code"];
				//$response['password'] = $row["password"];

				
				
				
				array_push($driver,$response);
        
			}
			echo json_encode($driver);
		}
		
		
}

?>