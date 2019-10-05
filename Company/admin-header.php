<?php 
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
if(!isset($_SESSION['adminData']) && empty($_SESSION['adminData']))
{
 echo "<script>window.location=\"".ADMINROOT."login.php\"</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="M-Safiri" />
        <meta name="keywords" content="M-Safiri" />
        <meta name="author" content="M-Safiri">
        <title>M-Safiri</title>

       <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon" />

        <!-- Fonts -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/fonts/flaticon/flaticon.css" rel="stylesheet" type="text/css"/>

        <!-- Css -->
        <link href="assets/css/pace-theme-flash.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/icheck.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/img-upload.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/daterangepicker.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <!-- tobar :: start -->
        <div class='page-topbar '>
            <a href="<?php echo ADMINROOT;?>index.php" class='logo-area'><span></span></a>
            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="javascript:;" data-toggle="sidebar" class="sidebar_toggle"><i class="fa fa-bars"></i></a>
                        </li>
                    </ul>
                </div>
                <div class='pull-right'>
                     <ul class="info-menu right-links list-inline list-unstyled">
                        <li class="profile showopacity">
                            <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                                <img src="assets/images/profile/avatar-1.png" alt="user-image" class="img-circle img-inline">
                                <span><?php echo $_SESSION['adminData']['fullname'];?> <i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li class="last"><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- tobar :: end -->