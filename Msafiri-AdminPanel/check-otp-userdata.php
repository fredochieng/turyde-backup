<?php
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
if(isset($_GET['sentcode']) && !empty($_GET['id']) && !empty($_GET['id']) && $_GET['type'] == 'userdata'){
	$selectUser = "SELECT id,sentcode FROM tbl_userdata WHERE sentcode = '".$_GET['sentcode']."' AND id = '".$_GET['id']."'";
	$resultselectUser = $db->query($selectUser);
	if($resultselectUser->num_rows > 0){
		$json = array("status" => 1,"message"=>"success");
	}
	else{
		$json = array("status" => 0,"message"=>"fail");
	}
}
elseif(isset($_GET['sentcode']) && !empty($_GET['id']) && !empty($_GET['id']) && $_GET['type'] == 'driverdata'){
	$selectDriver = "SELECT id,sentcode FROM tbl_driverdata WHERE sentcode = '".$_GET['sentcode']."' AND id = '".$_GET['id']."'";
	$resultselectDriver = $db->query($selectDriver);
	if($resultselectDriver->num_rows > 0){
		$json = array("status" => 1,"message"=>"success");
	}
	else{
		$json = array("status" => 0,"message"=>"fail");
	}
}
else{
	$json = array("status" => 0,"message"=>"param missing");
}

echo json_encode($json);