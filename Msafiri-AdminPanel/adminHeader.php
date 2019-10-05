<?php 
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
if(!isset($_SESSION['adminData']) && empty($_SESSION['adminData']))
{
 echo "<script>window.location=\"".ADMINROOT."adminLogin.php\"</script>";
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

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo ADMINROOT;?>assets/images/favicon.ico" type="image/x-icon" />

        <!-- Fonts -->
        <link href="<?php echo ADMINROOT;?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/fonts/flaticon/flaticon.css" rel="stylesheet" type="text/css"/>

        <!-- Css -->
        <link href="<?php echo ADMINROOT;?>assets/css/pace-theme-flash.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/animate.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/perfect-scrollbar.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/icheck.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/img-upload.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo ADMINROOT;?>assets/css/responsive.css" rel="stylesheet" type="text/css"/>
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
                        <li class="profile">
                            <a href="<?php echo ADMINROOT;?>logout.php" class="btn btn-border"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- tobar :: end -->