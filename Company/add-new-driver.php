<?php
$pageName = 'add-drivers';
include 'admin-header.php';?>
        <!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
<?php
if(isset($_GET['d-ID']) && $_GET['d-ID'] != '')
{
    $driverId     = base64_decode($_GET['d-ID']);
    $statement    = "SELECT dd.id as dID,dd.fullname,dd.email,dd.status AS driver_status,dd.password,dd1.* FROM tbl_driverdata as dd left join tbl_driverdetails as dd1 on dd1.driver_id=dd.id where dd.id='".$driverId."'";
    $result       = $db->query($statement);
    $row          = $result->fetch_assoc();

    $statement1   = "SELECT *  from tbl_driverdocuments where driver_id='".$driverId."' and photo_type='licence'";
    $result1      = $db->query($statement1);
    $row1         = $result1->fetch_assoc();

}
?>
<?php include 'admin-sidebar.php';?>
    <section id="main-content" class=" ">
        <div class="wrapper main-wrapper row" style=''>
            <div class='col-xs-12'>
                <div class="page-title">
                    <div class="pull-left">
                        <h1 class="title">Add New Driver</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <a href="add-drivers.php" class="btn btn-primary"><i class="fa fa-chevron-left"></i> <span>Back</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
			<div id="alert-danger" style="color: red;"></div>
                <form enctype="multipart/form-data" id="addDriver" method="post">
                    <ul class="nav nav-tabs primary">
                        <li class="active">
                            <a href="#personal-info" data-toggle="tab">
                                <i class="fa fa-user"></i> Personal Information
                            </a>
                        </li>
                        <li>
                            <a href="#document" data-toggle="tab">
                                <i class="fa fa-file"></i> Document
                            </a>
                        </li>
                    </ul>
					
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="personal-info">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Full Name</label>
                                            <div class="controls">
                                                <input type="text" id ="fullname" name="fullname" class="form-control" placeholder="Enter Full Name" required="" value="<?php if(isset($row['fullname']) && $row['fullname'] != '') { echo $row['fullname'];} ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 no-pr">
                                        <div class="form-group">
                                            <label class="form-label">Upload Image</label>
                                            <div class="controls">
                                                 <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg,image/png" <?php if($_GET['d-ID'] == ''){ ?>required="" <?php } ?>/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <div class="controls">
                                                <input type="email" id="email_id" name="email" class="form-control"  placeholder="Enter Email Address" required="" value="<?php if(isset($row['email']) && $row['email'] != '') { echo $row['email'];} ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pr">
                                        <div class="form-group">
                                            <label class="form-label">Phone Number</label>
                                            <div class="controls">
                                                <input type="text" id="mobile_number" name="mobile_number" class="form-control"  placeholder="Enter Phone Number" required="" value="<?php if(isset($row['mobile_number']) && $row['mobile_number'] != '') { echo $row['mobile_number'];} ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Birthdate</label>
                                            <div class="controls input-group date" id="datetimepicker1">
                                                <input type="text" id="dob" name="dob" class="form-control" placeholder="DOB" value="<?php if(isset($row['dob']) && $row['dob'] != '') { echo $row['dob'];} ?>" required>
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="dob_edit" id="dob_edit" value="<?php if(isset($row['dob']) && $row['dob'] != '') { echo $row['dob'];} ?>">
                                    <div class="col-lg-6 no-pr">
                                        <div class="form-group">
                                            <label class="form-label">Gender</label>
                                            <div class="controls">
                                                <select class="form-control" id="gender" name="gender" required="">
                                                    <option id="0">Select Gender</option>
                                                    <option id="1" <?php if(isset($row['gender']) && $row['gender'] != '' && $row['gender'] == 'Male') { echo "selected";} ?>>Male</option>
                                                    <option id="2" <?php if(isset($row['gender']) && $row['gender'] != '' && $row['gender'] == 'Female') { echo "selected";} ?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Address</label>
                                            <div class="controls">                      
											<textarea id="street" rows="2" name="street" class="form-control"  placeholder="Enter Street Address" required="" value="<?php if(isset($row['street']) && $row['street'] != '') { echo $row['street'];} ?>"><?php if(isset($row['street']) && $row['street'] != '') { echo $row['street'];} ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">Country</label>
                                            <div class="controls">
                                                <select class="form-control" id="country" name="country" required="">
                                                    <option id="0">Select Country</option>
                                                    <?php
                                                  $manageCat = "SELECT * FROM tbl_country where id='38'";
                                                $resultManageCat      = $db->query($manageCat);
                                                if($resultManageCat->num_rows > 0){
                                                    $count = 1;
                                                while ($event = $resultManageCat->fetch_assoc()) {
                                                            ?>
                                                <option id="<?php echo $event["country"];?>" value="<?php echo $event["country"];?>" <?php if(isset($row['country']) && $row['country'] != '' && $row['country'] == $event["country"]) { echo "selected";} ?>><?php echo $event["country"];?></option>
                                                <?php
                                                    } }
                                                ?>  
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pr">
                                        <div class="form-group">
                                            <label class="form-label">State</label>
                                            <div class="controls">
                                                <select class="form-control" id="state" name="state" required="">
                                                    <option id="0">Select State</option>
                                                    <?php
                                                  $manageCat = "SELECT * FROM tbl_state as s left join tbl_country as c ON c.id=s.country_id where s.country_id='38'";
                                                $resultManageCat      = $db->query($manageCat);
                                                if($resultManageCat->num_rows > 0){
                                                    $count = 1;
                                                while ($event = $resultManageCat->fetch_assoc()) {
                                                            ?>
                                                <option id="<?php echo $event["state"];?>" value="<?php echo $event["state"];?>" <?php if(isset($row['state']) && $row['state'] != '' && $row['state'] == $event["state"]) { echo "selected";} ?>><?php echo $event["state"];?></option>
                                                <?php
                                                    } }
                                                ?>  
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pl">
                                        <div class="form-group">
                                            <label class="form-label">City</label>
                                            <div class="controls">
                                                <input type="text" id="city" class="form-control" name="city" placeholder="Enter City" required="" value="<?php if(isset($row['city']) && $row['city'] != '') { echo $row['city'];} ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 no-pr">
                                        <div class="form-group">
                                            <label class="form-label">Zipcode</label>
                                            <div class="controls">
                                                <input type="text" id="postal_code" name="postal_code" class="form-control" placeholder="Enter Zipcode" required="" value="<?php if(isset($row['postal_code']) && $row['postal_code'] != '') { echo $row['postal_code'];} ?>">
                                            </div>
                                        </div>
                                    </div>                         
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="document">
                            <div class="document-gallery">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Upload Driver Licence</label>
                                            <div class="controls">
                                                 <input type="file" class="form-control" id="licence" name="licence" accept="image/jpeg,image/gif,image/png,application/pdf,.doc,.docx,application/msword"<?php if($_GET['d-ID'] == ''){ ?>required="" <?php } ?>/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-label">Upload Address Proof</label>
                                            <div class="controls">
                                                 <input type="file" class="form-control" id="proof" name="document[]" accept="image/jpeg,image/gif,image/png,application/pdf,.doc,.docx,application/msword" multiple <?php if($_GET['d-ID'] == ''){ ?>required="" <?php } ?>/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="row">
                            <input type="hidden" name="driver_id" id="driver_id" value="<?php if(isset($row['dID']) && $row['dID'] != '') { echo $row['dID'];} ?>"/>
                            <input type="hidden" name="operation" id="operation" value="<?php if(isset($_GET['d-ID']) && $_GET['d-ID'] != ''){echo "Edit";}else{ echo "Add";}?>"/>
                            <input type="hidden" name="photo_edit" id="photo_edit" value="<?php if(isset($row['photo']) && $row['photo'] != '') { echo $row['photo'];} ?>"/>
                             <input type="hidden" name="licence_edit" id="licence_edit" value="<?php if(isset($row1['photo']) && $row1['photo'] != '') { echo $row1['photo'];} ?>"/>
                            <div class="col-md-12">
                                <button type="submit" name="submit" class="btn btn-primary main-btn"><i class="fa fa-check"></i> Submit</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- content area :: end -->
</div>
<!-- main-container :: end -->
<!-- js -->
<?php include 'admin-footer.php';?>
<script>
<?php //if($_GET['d-ID'] == ''){ ?>
//  var password = document.getElementById("password")
//   , confirm_password = document.getElementById("confirm_password");

// function validatePassword(){
//   if(password.value != confirm_password.value) {
//     confirm_password.setCustomValidity("Passwords Don't Match");
//   } else {
//     confirm_password.setCustomValidity('');
//   }
// }

// password.onchange = validatePassword;
// confirm_password.onkeyup = validatePassword;
<?php //} ?>
$('#photo').filestyle({
    buttonName: 'btn-primary'
});
$('#licence').filestyle({
    //input: false,
    buttonName: 'btn-primary'
});
$('#document').filestyle({
    buttonName : 'btn-primary'
});
$(document).ready(function() {

    $(document).on('submit', '#addDriver', function(event){
     //$('#operation').val("Edit");
        event.preventDefault();
          $.ajax({
            url:"php/insert_driver.php",
            method:'POST',
            data:new FormData(this),
            contentType:false,
            processData:false,
            success:function(data)
            {
             alert(data);
              console.log(data);
              $('#addDriver')[0].reset();
              window.location.replace("add-drivers.php");
            }
          });
    });

});

</script>