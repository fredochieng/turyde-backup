<?php
/*Database Connection */
	// $servername = "localhost";
	// $username = "root";
	// $password = "";
	// $dbname = "test";
	
	// $conn = new mysqli($servername, $username, $password, $dbname);
	//Check connection
	// if ($conn->connect_error) {
		// die("Connection failed: " . $conn->connect_error);
	// }
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ei_turyde');
define('ADMINROOT', 'http://localhost/Msafiri/Company/');

//define('DB_PORT', 3306);
class connectionClass
{
public $db;
public $resquest;
public $server;
public $root;
	function __construct()
	{
		$this->db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		mysqli_set_charset($this->db,"utf8");
		if($this->db->connect_errno > 0)
		{
		  die('Unable to connect to database [' . $db->connect_error . ']');
		}
	}
}
	
?>