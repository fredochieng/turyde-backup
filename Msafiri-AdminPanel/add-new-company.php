<?php 
$pageName = 'company';
require_once 'adminHeader.php';
if(isset($_POST['submit'])){
    $selectUser = "SELECT * FROM tbl_company WHERE email = '".$_POST['email']."'";
    $resultselectUser = $db->query($selectUser);
    if($resultselectUser->num_rows > 0){
        echo "<script>alert('Company already registered.')</script>";
    }
    else{
        $addUser = "INSERT INTO `tbl_company`(`fullname`, `email`, `password`, `zipcode`, `photo`, `contact`, `address`) VALUES ('".$_POST['fullname']."','".$_POST['email']."','".md5('123456')."','".$_POST['zipcode']."','','".$_POST['contact']."','".$_POST['address']."')";
        $resultaddUser = $db->query($addUser);
        require '../PHPMailer-master/PHPMailerAutoload.php';
        $company_id     = mysqli_insert_id($db);
        $sDirPath       = COMPANYUPLOADS.$company_id.'/';
        if (!is_dir($sDirPath))
        {
            mkdir($sDirPath,0777,true);
        }
        //$code = substr(str_shuffle("0123456789"), 0, 4);;
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

        $mail->Subject = 'TuRyde Company register details';
        $mail->Body    = 'Welcome to TuRyde!!<br><br>Here are your credentials to login and get going!<br><b>Email : '.$_POST['email'].'<br>Password : 123456</b><br><br>Use this link : <a href="http://itechgaints.com/M-Safiri/Company/login.php">CLick For Login</a>';

        if(!$mail->send()) {
           echo 'Message could not be sent.';
           echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        echo "<script>alert('Company Added successfully.')</script>";
        echo "<script>window.location=\"companyList.php\"</script>";
    }
    
}
if(isset($_GET['cID']) && !empty($_GET['cID'])){
    $selectUser = "SELECT * FROM tbl_company where id = '".$_GET['cID']."'";
    $resultselectUser = $db->query($selectUser);
    $dataselectUser = $resultselectUser->fetch_assoc();
    if(isset($_POST['update'])){
        $updateUser = "UPDATE `tbl_company` SET `fullname`='".$_POST['fullname']."',`email`='".$_POST['email']."',`zipcode`='".$_POST['zipcode']."',`photo`='',`contact`='".$_POST['contact']."',`address`='".$_POST['address']."' WHERE `id`= '".$_GET['cID']."'";
        $resultupdateUser = $db->query($updateUser);
        echo "<script>alert('Company Updated successfully.')</script>";
        echo "<script>window.location=\"companyList.php\"</script>";
    }
}
?>
        <!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
    <?php include 'adminSidemenu.php';?>
    <!-- content area :: start -->
    <section id="main-content" class=" ">
        <div class="wrapper main-wrapper row" style=''>
            <div class='col-xs-12'>
                <div class="page-title">
                    <div class="pull-left">
                        <h1 class="title">Add New Company</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <a href="companyList.php" class="btn btn-primary"><i class="fa fa-chevron-left"></i> <span>Back</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <form method="post">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="personal-info">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="col-sm-12 avatar-img ">
                                        <div class="avatar-image-wrapper">
                                            <div class="img-picker"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="col-lg-12 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Fullname</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname" required="" value="<?php echo $dataselectUser['fullname']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <div class="controls">
                                                <input type="email" class="form-control" name="email" placeholder="Enter Email Address" required="" value="<?php echo $dataselectUser['email']; ?>" <?php if(isset($_GET['cID'])){ echo 'readonly';} ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pr">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="contact" placeholder="Enter Phone Number" required="" value="<?php echo $dataselectUser['contact']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Zipcode</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="zipcode" placeholder="Enter Zipcode" required="" value="<?php echo $dataselectUser['zipcode']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <div class="controls">
                                                <textarea class="form-control" rows="5" name="address" placeholder="Enter Address"><?php echo $dataselectUser['address']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                if(isset($_GET['cID']) && !empty($_GET['cID'])){?>
                                <input type="submit" name="update" class="btn btn-primary main-btn" value="Update">
                                <?php } else {?>
                                <input type="submit" name="submit" class="btn btn-primary main-btn" value="Submit">
                                <?php } ?>
                            </div>
                        </div>  
                    </div>
                         
                </form>
            </div>
        </div>
    </section>
    <!-- content area :: end -->
</div>
        <!-- main-container :: end -->
<?php require_once 'adminFooter.php';?>
<script>
    $(document).on('click', '.delete', function(){
    var driver_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"ajax/ajax_delete.php",
        method:"POST",
        data:{driver_id:driver_id,action:'driverDelete'},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>driverList.php");
        }
      });
    }
    else
    {
      return false; 
    }
  });
</script>
<script>
//searchText is a input type text
$('.selectID').on('change', function (e) {
    var sid = $(this).attr("id");
    var optionSelected = $("option:selected", this);
    var driverStatus = this.value;
    if(confirm("Are you sure you want to change status?"))
    {
      $.ajax({
        url:"ajax/changeStatus.php",
        method:"POST",
        data:{driverStatus:driverStatus , sid:sid},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>driverList.php");
        }
      });
    }
    else
    {
      return false; 
    }
});
</script>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                     columns: [ 0, 2, 3, 4, 5, 7]
                }
            }
        ],
        select: true
    } );
} );
</script>