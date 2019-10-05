<?php
include 'configClass.php';
$newobj = new connectionClass();
$db = $newobj ->db;
if(isset($_POST['resetpassword']) && !empty($_POST['resetpassword']))
{
    $email_id = $_GET['email_id'];
    $password = $_POST['password'];
    $password       = md5($_POST['password']);
    $statement      = "UPDATE `tbl_company` SET `password` = '".$password."' WHERE `email` = '".$email_id."'";
    $result         = $db->query($statement);
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
         <script src="assets/js/ajax.js" type="text/javascript"></script>
    </head>
    <body class="login_page">
        <div class="container-fluid">
            <div class="login-wrapper row">
                <div id="login" class="login loginpage col-lg-offset-4 col-md-offset-3 col-sm-offset-3 col-xs-offset-0 col-xs-12 col-sm-6 col-lg-4">    
                    <div class="login-form-header">
                        <img src="assets/images/icons/padlock.png" alt="login-icon" style="max-width:64px">
                        <div class="login-header">
                            <h4 class="bold color-white">Forgot Password!</h4>
                            <h4><small>Please enter new password to forgot password.</small></h4>
                        </div>
                        <?php
                        if(isset($message)){?>
                            <div id="alert-danger" name="alert-danger" style="color: red;"><?php echo $message;?></div>
                        <?php }
                        ?>
                    </div>
                    <div id="show-error" name="show-error" style="color: red;"></div>
                    <div class="box login">
                        <div class="content-body" style="padding-top:30px">
                            <form class="no-mb no-mt" action="#" method="post">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Password</label>
                                            <div class="controls">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password Here" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password</label>
                                            <div class="controls">
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter confirm password" required>
                                            </div>
                                        </div>
                                        <div class="pull-left">
                                            <input type="submit" name="resetpassword" class="btn btn-primary mt-10 btn-corner" value="submit">
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

<script>

var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>