<?php
/*Database Connection */
$servername = "127.0.0.1:8889";
$username = "root";
$password = "root";
$dbname = "itechi9o_msafiri";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
define('ADMINROOT', 'http://localhost:8888/M-Safiri/Website/');
	
// 