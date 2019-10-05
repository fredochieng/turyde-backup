<?php 
 session_start();
    if(isset($_SESSION['id']) && $_SESSION['id'] == 1) {
        //session is set
        //header('Location: index.php');
    } else if(!isset($_SESSION['id']) || (isset($_SESION['id']) && $_SESSION['id'] == 0)){
        //session is not set
        header('Location: login.php');
    }
?>
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
        <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>

    </head>
    <body  >
        <div class="fakeloader"></div>
        <div class="wrapper">
            <header>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-2 pt-1">
                            <a href="index.php"><i class="fa fa-home"></i></a>
                        </div>
                        <div class="col-8 text-center"><div class="main-title">Vehicle List</div></div>
                        <div class="col-2 d-flex justify-content-end align-items-center">
                            <a href="logout.php"><i class="fa fa-power-off"></i></a>
                        </div>
                    </div>
                </div>
            </header>
</body>
</html>