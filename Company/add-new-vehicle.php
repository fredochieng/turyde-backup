<?php 
$pageName = 'add-vehicle'; 
include 'admin-header.php';?>
        <!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
<?php
if(isset($_GET['v-ID']) && $_GET['v-ID'] != '')
{
    $vehicleId    = base64_decode($_GET['v-ID']);
    $statement    = "SELECT * from tbl_driver_vehicle where id='".$vehicleId."'";
    $result       = $db->query($statement);
    $row          = $result->fetch_assoc();
}
?>
<?php include 'admin-sidebar.php';?>
<section id="main-content" class=" ">
    <div class="wrapper main-wrapper row" style=''>
        <div class='col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title">Add New Vehicle</h1>
                </div>
                <div class="pull-right">
                    <div class="right-tools">
                        <a href="add-vehicle.php" class="btn btn-primary"><i class="fa fa-chevron-left"></i> <span>Back</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
		<div id="alert-danger"></div>
        <div class="col-lg-12">
            <form enctype="multipart/form-data" id="addVehicle">
                <ul class="nav nav-tabs primary">
                    <li class="active">
                        <a href="#personal-info" data-toggle="tab">
                            <i class="fa fa-user"></i> Vehicle Information
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
                                        <label class="form-label">Vehicle Type</label>
                                        <div class="controls">
                                            <input type="text" id="vehicle_type" class="form-control" name="vehicle_type" placeholder="Enter Vehicle Type" required="" value="<?php if(isset($row['vehicle_type']) && $row['vehicle_type'] != '') { echo $row['vehicle_type'];} ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 no-pr">
                                     <div class="form-group">
                                        <label class="form-label">Vehicle Image</label>
                                        <div class="controls">
                                            <input type="file" class="form-control" id="vehicle_profile" name="vehicle_profile" accept="image/jpeg,image/gif,image/png"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 no-pl">
                                     <div class="form-group">
                                        <label class="form-label">Vehicle Model</label>
                                        <div class="controls">
                                            <input type="text" id="vehicle_name" name="vehicle_name" class="form-control" placeholder="Enter Vehicle Model" required="" value="<?php if(isset($row['vehicle_name']) && $row['vehicle_name'] != '') { echo $row['vehicle_name'];} ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 no-pr">
                                    <div class="form-group">
                                        <label class="form-label">Vehicle Plate Number</label>
                                        <div class="controls">
                                            <input type="text" id="vehicle_number" name="vehicle_number" class="form-control"  placeholder="Enter Vehicle Plate Number" required="" value="<?php if(isset($row['vehicle_number']) && $row['vehicle_number'] != '') { echo $row['vehicle_number'];} ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 no-pl">
                                    <div class="form-group">
                                        <label class="form-label">Available Seats/Person capacity</label>
                                        <div class="controls">
                                            <input type="text" id="seats" name="seats" class="form-control" placeholder="Enter Available Seats/Person capacity" required="" value="<?php if(isset($row['seats']) && $row['seats'] != '') { echo $row['seats'];} ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="document">
                        <div class="document-gallery">
                            <div class="row">
                                 <div class="col-md-6">
                                     <label class="form-label">Upload Vehicle Number Document Image</label>
                                    <input type="file" class="form-control" id="fileToUploadVehicle" name="fileToUploadVehicle[]" accept="image/jpeg,image/gif,image/png" multiple <?php if($_GET['v-ID'] == ''){ ?>required="" <?php } ?>/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php if(isset($row['id']) && $row['id'] != '') { echo $row['id'];} ?>"/>
                    <input type="hidden" name="operation" id="operation" value="<?php if(isset($_GET['v-ID']) && $_GET['v-ID'] != ''){echo "Edit";}else{ echo "Add";}?>"/>
                    <input type="hidden" name="vehicle_profile_edit" id="vehicle_profile_edit" value="<?php if(isset($row['vehicle_profile']) && $row['vehicle_profile'] != '') { echo $row['vehicle_profile'];} ?>"/>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary main-btn"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </div>       
            </form>
        </div>
    </div>
</section>
<!-- content area :: end -->
</div>
<!-- main-container :: end -->
<?php include 'admin-footer.php';?>        
<script>
$(document).ready(function(){
    $(document).on('submit', '#addVehicle', function(event){
    event.preventDefault();
       // $('#operation').val("Add");
      $.ajax({
        url:"php/insert_vehicle.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          alert(data);
          $('#addVehicle')[0].reset();
          window.location.replace("add-vehicle.php");
        }
      });
    });
});
</script>