<?php include("php/connection.php");?>
<?php
if(isset($_POST['email']) && !empty($_POST['email']))
{
    $email = $_POST['email'];
    $manageUsers        = "SELECT * FROM tbl_users WHERE email_id='".$email."'";
    $resultManageUsers = $conn->query($manageUsers);
   // $resultManageUsers  = $db->query($manageUsers);
    if($resultManageUsers->num_rows > 0)
    {
        $dataManageUser     = $resultManageUsers->fetch_assoc();
        $code               = rand( 10000 , 99999 );
        $statement = "UPDATE tbl_users SET email_code='$code' WHERE email_id='".$email."'";
        $result = $conn->query($statement);
        require 'PHPMailer-master/PHPMailerAutoload.php';
        $mail = new PHPMailer;

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'mail.itechgaints.com';                       // Specify main and backup server
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'prabhat@itechgaints.com';                   // SMTP username
        $mail->Password = 'prabhat@123';               // SMTP password
                    // Enable encryption, 'ssl' also accepted
        $mail->Port = 25;                                    //Set the SMTP port number - 587 for authenticated TLS
        $mail->setFrom('prabhat@itechgaints.com', 'TuRyde');     //Set who the message is to be sent from
        $mail->addAddress($_POST['email'], 'info@eleganzit.com');  // Add a recipient
        $mail->WordWrap = 50;                                 // Set word wrap to 50 characters
        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = 'Forgot Password TuRyde';
        $mail->Body    = 'Please enter this code for forgot password<b>code : '.$code.'<br><a href="'.ADMINROOT.'email-code.php?email_id='.$_POST['email'].'">Click Here</a></b>';
        if(!$mail->send()) {
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        $message = 'Send verification code on your mail id please check it';
    }
    else
    {
        $message = 'Email id is not exist';
    }
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
                                <div class="form-group text-center">
                                    <label class="link blue-col">Enter Email Address below to reset your password.</label>
                                </div>
                                <?php
                                    if(isset($message)){?>
                                        <div id="alert-danger" name="alert-danger" style="color: red;"><?php echo $message;?></div>
                                    <?php }
                                    ?>
                                <form class="form forgot-form" method="post">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa fa-envelope-o"></i></div>
                                            </div>
                                            <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" name="sendmailbtn" class="btn btn-primary btn-block">Submit</button>
                                    </div>
                                </form>
                                <div class="form-group text-center">
                                    <label>Already member? <a class="link blue-col" href="login.php"><span>Sign In Here</span></a></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

