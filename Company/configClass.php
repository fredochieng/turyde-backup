<?php
error_reporting(0);
if (!session_id()) {
	session_start();
}
//localhost connection
define('DB_SERVER', '127.0.0.1:8889');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_DATABASE', 'ei_turyde');
define('ADMINROOT', 'http://localhost:8888/M-Safiri/Company/');
define('ROOT', 'http://localhost:8888/M-Safiri/Company/');
define('APIROOT', 'http://localhost:8888/M-safiri-API/');
define('NOUSERIMAGE', 'http://localhost:8888/M-safiri-API/driver_uploads/no_profile.png');
define('NOMAPIMAGE', 'http://localhost:8888/M-safiri-API/user_uploads/no_map.png');
define('DRIVERUPLOADS', '../../../M-safiri-API/driver_uploads/');
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
		$login_sql = "SELECT * FROM `tbl_company`
						WHERE `email` = '" . $email_id . "'
							AND `password` = '" . md5($password) . "'";
		$login_result = $this->db->query($login_sql);
		if ($login_result->num_rows > 0) {
			$adminData = $login_result->fetch_assoc();
		}
		return $adminData;
	}
}
?>