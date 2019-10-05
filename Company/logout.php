<?php

session_start();
unset($_SESSION['id']);
unset($_SESSION['email_id']);
//unset($GLOBALS['id']);
session_destroy();
header("location:login.php");
?>
