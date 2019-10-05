<?php 
$pageName = 'add-route'; 
include 'admin-header.php';?>
        <!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
<?php include 'admin-sidebar.php';?>
<?php
    if(isset($_GET['route_id']) && $_GET['route_id'] != '')
    {
        $routeId        = base64_decode($_GET['route_id']);
        $manageUser     = "SELECT ds.*,dd.fullname FROM tbl_driver_setlocation as ds left join tbl_driverdata as dd ON dd.id=ds.driver_id where ds.id='".$routeId."'";
        $resultManageUser = $db->query($manageUser);
        $row = $resultManageUser->fetch_assoc();   
    }
?>
<section id="main-content" class=" ">
    <div class="wrapper main-wrapper row" style=''>
        <div class='col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title">Add New Route</h1>
                </div>
                <div class="pull-right">
                    <div class="right-tools">
                        <a href="add-route.php" class="btn btn-primary"><i class="fa fa-chevron-left"></i> <span>Back</span></a>
                    </div>
                </div>
            </div>
        </div>
		<div id="show-error"></div>
        <div class="clearfix"></div>
        <section class="box has-border-left-3">
            <header class="panel_header">
                <h2 class="title pull-left">Route</h2>
            </header>
            <div class="content-body">
                <form method="post" id="addRoute">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="form-label">Add Pickup Location</label>
                                <div class="controls input-group transparent">
                                    <span class="input-group-addon cust-pad"><i class="fa fa-map-marker green"></i></span>
                                    <select class="form-control" name="addressPickup" id="addressPickup" required="">
                                        <option id="0" value="">Select Pickup Address</option>
                                        <?php
                                        $manageCat = "SELECT * from tbl_location";
                                        $resultManageCat    = $db->query($manageCat);
                                        if($resultManageCat->num_rows > 0){
                                            $count = 1;
                                        while ($event = $resultManageCat->fetch_assoc()) {
                                                    ?>
                                            <option id="<?php echo $event["address"];?>" value="<?php echo $event["address"];?>" <?php if(isset($row['from_address']) && $row['from_address'] != '' && $row['from_address'] == $event["address"]) { echo "selected";} ?>><?php echo $event["address"];?></option>
                                        <?php
                                            } }
                                        ?>   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Pickup DateTime</label>
                                <div class="controls input-group date" id="datetime1">
                                    <input type="text" class="form-control" id="date_pickup" placeholder="Pickup DateTime" name="date_pickup" required="" value="<?php if(isset($row['datetime']) && $row['datetime'] != '') { echo $row['datetime'];} ?>" autocomplete="off">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Add Destination Location</label>
                                <div class="controls input-group transparent">
                                <span class="input-group-addon cust-pad"><i class="fa fa-map-marker red"></i></span>
                                 <select class="form-control" id="addressDestination" name="addressDestination" required="">
                                    <option id="0" value="">Select Destination Address</option>
                                    <?php
                                    $manageCat = "SELECT * from tbl_location";
                                    $resultManageCat    = $db->query($manageCat);
                                    if($resultManageCat->num_rows > 0){
                                        $count = 1;
                                    while ($event = $resultManageCat->fetch_assoc()) {
                                                ?>
                                        <option id="<?php echo $event["address"];?>" value="<?php echo $event["address"];?>" <?php if(isset($row['to_address']) && $row['to_address'] != '' && $row['to_address'] == $event["address"]) { echo "selected";} ?>><?php echo $event["address"];?></option>
                                    <?php
                                        } }
                                    ?>   
                                </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Destination DateTime</label>
                                <div class="controls input-group date" id="datetime2">
                                    <input type="text" class="form-control" id="date_dest" placeholder="Destination DateTime" name="date_dest" required="" value="<?php if(isset($row['end_datetime']) && $row['end_datetime'] != '') { echo $row['end_datetime'];} ?>">
                                    <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Select Driver</label>
                                    <select class="form-control" name="driver_id" id="driverId" required="">
                                        <option id="0" value="">Select Driver Name</option>
                                        <?php
                                        $manageCat = "SELECT dd.id,dd.fullname FROM `tbl_driverdata` as dd inner join tbl_assign_driver as ad on dd.id=ad.driver_id where  dd.`type` = 'company' AND dd.`company_id` = '".$_SESSION['adminData']['id']."'";
                                        $resultManageCat    = $db->query($manageCat);
                                        if($resultManageCat->num_rows > 0){
                                            $count = 1;
                                        while ($event = $resultManageCat->fetch_assoc()) {
                                                    ?>
                                            <option id="<?php echo $event["id"];?>" value="<?php echo $event["id"];?>" <?php if(isset($row['fullname']) && $row['fullname'] != '' && $row['fullname'] == $event["fullname"]) { echo "selected";} ?>><?php echo $event["fullname"];?></option>
                                        <?php
                                            } }
                                        ?>   
                                    </select>
                            </div>
                            <div class="form-group">
                                 <input type="hidden" name="route_id" id="route_id" value="<?php if(isset($row['id']) && $row['id'] != '') { echo $row['id'];} ?>"/>
                                <input type="hidden" name="operation" id="operation" value="<?php if(isset($_GET['route_id']) && $_GET['route_id'] != ''){echo "Edit";}else{ echo "Add";}?>">
                                <input type="submit" class="btn btn-primary main-btn" value="Submit" name="addroute">
                               <!--  <button type="button" class="btn btn-primary main-btn" onclick="add_geoLocation();"><i class="fa fa-check"></i> Submit</button> -->
                               <!--   <button type="submit" class="btn btn-primary main-btn"><i class="fa fa-check"></i> Submit</button> -->
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="map-area">
                                <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29374.82985549621!2d72.52208875!3d23.02914215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1538744497991" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</section>
<!-- content area :: end -->
</div>
<?php include 'admin-footer.php';?>
<script>
$(document).ready(function(){
    $(document).on('submit', '#addRoute', function(event){
    event.preventDefault();
       // $('#operation').val("Add");
      $.ajax({
        url:"php/insert_route.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          alert(data);
          $('#addRoute')[0].reset();
          window.location.replace("add-route.php");
        }
      });
    });
});
</script>
