<script type="text/javascript">
// /* To stop user to get back to login page */
// function noBack(){window.history.forward()}
// noBack();
//window.onload=noBack;
// window.onpageshow=function(evt){if(evt.persisted)noBack()}
// window.onunload=function(){void(0)}
</script>

<!doctype html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Default Description" />
        <meta name="keywords" content="M-Safiri" />
        <meta name="robots" content="M-Safiri" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
         <!-- icon -->
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico" />
        <!-- title -->
        <title>M-Safiri</title>
        <!-- fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" />
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" />

        <!-- css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/fakeLoader.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
		
        <!-- js -->
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
		
        <!--<script src="assets/js/jquery-2.1.4.min.js" type="text/javascript"></script>-->
		<script src="assets/js/source.js" type="text/javascript"></script>
        <script src="assets/js/popper.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/js/fakeLoader.min.js" type="text/javascript"></script>
        <script src="assets/js/custom.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="fakeloader"></div>
        <div class="wrapper">
            <div class="bg-cover"></div>
            <div class="container-fluid">
                <div class="inner-contain">
                    <div class="form-area">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div class="logo-area">
                                    <img src="assets/images/logo.png" alt="M-Safiri"/>
                                </div>
								<div id="alert-danger" name="alert-danger" style="color: red;"></div>
                                <form class="form login-form">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                                            </div>
                                            <input type="email" id ="email" class="form-control" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-lock"></i></div>
                                            </div>
                                            <input type="password" id="pwd" class="form-control" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-block" onclick="checkLogin();">Sign In</a>
                                    </div>
                                </form>
								<div class="form-group">
                                    <div class="pull-left">
                                        <label>Don't have account? <a class="link blue-col" href="register.php"><span>Register Here</span></a></label>
                                    </div>
                                    <div class="pull-right">
                                        <a class="link red-col" href="forgot-password.php">Forgot Password?</a>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
