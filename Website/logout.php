<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['full_name']);
session_destroy();
header("location:login.php");

?>

