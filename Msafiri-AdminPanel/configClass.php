<?php
error_reporting(0);
if (!session_id()) {
	session_start();
}
//localhost connection
// define('DB_SERVER', 'localhost');
// define('DB_USERNAME', 'itechi9o_msafiri');
// define('DB_PASSWORD', '@(gbvAMRkMcB');
// define('DB_DATABASE', 'itechi9o_msafiri');
// define('ROOT', 'http://itechgaints.com/M-Safiri/Msafiri-AdminPanel/');
// define('ADMINROOT', 'http://itechgaints.com/M-Safiri/Msafiri-AdminPanel/');
// define('APIROOT', 'http://itechgaints.com/M-safiri-API/');
// define('NOUSERIMAGE', 'http://itechgaints.com/M-safiri-API/driver_uploads/no_profile.png');
// define('NOMAPIMAGE', 'http://itechgaints.com/M-safiri-API/user_uploads/no_map.png');
// define('COMPANYUPLOADS', '../../../M-safiri-API/company_uploads/');
define('DB_SERVER', '127.0.0.1:8889');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'ei_turyde');
define('ROOT', 'http://localhost:8888/M-Safiri/Msafiri-AdminPanel/');
define('ADMINROOT', 'http://localhost:8888/M-Safiri/Msafiri-AdminPanel/');
define('APIROOT', 'http://localhost:8888/M-safiri-API/');
define('NOUSERIMAGE', 'http://localhost:8888/M-safiri-API/driver_uploads/no_profile.png');
define('NOMAPIMAGE', 'http://localhost:8888/M-safiri-API/user_uploads/no_map.png');
define('COMPANYUPLOADS', '../../../M-safiri-API/company_uploads/');
?>
<?php
class connectionClass
{
	public $db;
	public $resquest;
	public $server;
	public $root;
	function __construct()
	{
		$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		mysqli_set_charset($this->db, "utf8");
		if ($this->db->connect_errno > 0) {
			die('Unable to connect to database [' . $db->connect_error . ']');
		}
	}
	// Adminpanel Login function
	function get_login($email_id, $password)
	{
		$adminData = array();
		$login_sql = "SELECT * FROM `admin_user`
						WHERE `email_id` = '" . $email_id . "'
							AND `password` = '" . md5($password) . "'";
		$login_result = $this->db->query($login_sql);
		if ($login_result->num_rows > 0) {
			$adminData = $login_result->fetch_assoc();
		}
		return $adminData;
	}
	function calDistance($lat1, $lon1, $lat2, $lon2, $unit)
	{
		// $lat1 = '23.0810287';
		// $lat2 = '22.9961698';
		// $lon1 = '72.5768002';
		// $lon2 = '72.5995843';
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);

		if ($unit == "K") {
			return ($miles * 1.609344);
		} else if ($unit == "N") {
			return ($miles * 0.8684);
		} else {
			return $miles;
		}
	}
	function get_time_difference($time1, $time2)
	{
		$time1 = strtotime("1/1/1980 $time1");
		$time2 = strtotime("1/1/1980 $time2");

		if ($time2 < $time1) {
			$time2 = $time2 + 86400;
		}

		return ($time2 - $time1) / 3600;
	}
}
?>