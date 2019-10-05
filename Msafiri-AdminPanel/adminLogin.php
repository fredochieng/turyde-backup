<?php 
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
if(isset($_SESSION['adminData']) && !empty($_SESSION['adminData']))
{
 echo "<script>window.location=\"".ADMINROOT."index.php\"</script>";
}
if(isset($_POST['loginbtn']) && !empty($_POST['loginbtn']))
{ 
    $email_id = $_POST['email_id'];
    $password = $_POST['password'];
    $adminData = $newobj->get_login($email_id, $password);
    if(count($adminData) > 0)
    {
        $_SESSION['adminData'] = $adminData;
        echo "<script>window.location=\"".ADMINROOT."index.php\"</script>";
        exit;
    }
    else
    {
        $message = 'Invalid Email Id or Password';
    }
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
        <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon" />

        <!-- Fonts -->
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

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
    </head>
    <body class="login_page">
        <div class="container-fluid">
            <div class="login-wrapper row">
                <div id="login" class="login loginpage col-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-xs-offset-0 col-xs-12 col-sm-6 col-lg-4">    
                    <div class="login-form-header">
                        <img src="assets/images/icons/padlock.png" alt="login-icon" style="max-width:64px">
                        <div class="login-header">
                            <h4 class="bold color-white">Login Now!</h4>
                            <h4><small>Please enter your credentials to login.</small></h4>
                        </div>
                    </div>
                    <div class="box login">
                        <div class="content-body" style="padding-top:30px">
                            <form class="no-mb no-mt" method="post">
                                <?php
                                if(isset($message)){?>
                                    <p style="color: red;"><?php echo $message;?></p>
                                <?php }
                                ?>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="email_id" placeholder="Enter Email Address" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <div class="controls">
                                                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                            </div>
                                        </div>
                                        <div class="pull-left">
                                            <!-- <a href="dashboard.html" class="btn btn-primary mt-10 btn-corner">Log In</a> -->
                                            <input type="submit" name="loginbtn" class="btn btn-primary mt-10 btn-corner" value="Log in">
                                            <a href="forgot-password.html" class="btn mt-10 btn-corner btn-link">Forgot password?</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main-container :: end -->
        <!-- js -->
        <script src="assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
        <script src="assets/js/jquery.easing.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/moment-with-locales.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
        <script src="assets/js/pace.min.js" type="text/javascript"></script>
        <script src="assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
        <script src="assets/js/viewportchecker.js" type="text/javascript"></script> 
        <script src="assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/icheck.min.js" type="text/javascript"></script>
        <script src="assets/js/img-upload.js" type="text/javascript"></script>
        <script src="assets/js/scripts.js" type="text/javascript"></script>
    </body>
</html>