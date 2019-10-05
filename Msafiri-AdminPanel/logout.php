<?php
include 'configClass.php';
unset($_SESSION['adminData']);
session_destroy();
header('Location: adminLogin.php');
?>