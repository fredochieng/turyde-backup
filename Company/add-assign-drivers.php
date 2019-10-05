<?php
$pageName = 'assign-drivers';
include 'admin-header.php';?>
        <!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
<?php include 'admin-sidebar.php';?>
<section id="main-content" class=" ">
    <div class="wrapper main-wrapper row" style=''>
            <div class='col-xs-12'>
                <div class="page-title">
                    <div class="pull-left">
                        <h1 class="title">Add Assign Drivers</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <a href="assign-drivers.php" class="btn btn-primary"><i class="fa fa-chevron-left"></i> <span>Back</span></a>
                        </div>
                    </div>
                </div>
            </div>
        <div class="clearfix"></div>
        <section class="box has-border-left-3">
            <header class="panel_header">
                <h2 class="title pull-left">Add Assign Driver<?php echo $_SESSION['id'];?></h2>
            </header>
            <div class="content-body">
                <form id="assign-drivers" method="post">
                    <input type="hidden" id="company_id" name="company_id" value="<?php echo $_SESSION['adminData']['id'];?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-lg-6 no-pl">
                                <div class="form-group">
                                    <label class="form-label">Select Driver Name</label>
                                    <div class="controls">
                                        <select class="form-control" name="driver_id" id="driver_id" required="">
                                            <option id="0" value="">Select Driver Name</option>
                                            <?php
                                            $manageCat = "SELECT * FROM tbl_driverdata as dd WHERE NOT EXISTS(SELECT * FROM   tbl_assign_driver as ad WHERE ad.driver_id = dd.id) and dd.type='company'";
                                            $resultManageCat    = $db->query($manageCat);
                                            if($resultManageCat->num_rows > 0){
                                                $count = 1;
                                            while ($event = $resultManageCat->fetch_assoc()) {
                                                        ?>
                                                <option id="<?php echo $event["id"];?>" value="<?php echo $event["id"];?>"><?php echo $event["fullname"];?></option>
                                            <?php
                                                } }
                                            ?>   
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 no-pr">
                                <div class="form-group">
                                    <label class="form-label">Vehicle Name</label>
                                    <div class="controls">
                                        <select class="form-control" name="vehicle_id" id="vehicle_id" required="">
                                            <option value="">Select Vehicle Name</option>
                                              <?php
                                               $manageCat = "SELECT * FROM tbl_driver_vehicle as dv WHERE NOT EXISTS(SELECT * FROM   tbl_assign_driver as ad WHERE ad.vehicle_id = dv.id) and dv.company_id='".$_SESSION['adminData']['id']."'";
                                                $resultManageCat    = $db->query($manageCat);
                                                if($resultManageCat->num_rows > 0){
                                                    $count = 1;
                                                while ($event = $resultManageCat->fetch_assoc()) {
                                                            ?>
                                                    <option id="<?php echo $event["id"];?>" value="<?php echo $event["id"];?>"><?php echo $event["vehicle_name"];?></option>
                                                <?php
                                                    } }
                                                ?>   
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="operation" id="operation"/>
                            <button type="submit" class="btn btn-primary main-btn"><i class="fa fa-check"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</section>
</div>
<?php include 'admin-footer.php';?>
<script>
$(document).ready(function(){
    $(document).on('submit', '#assign-drivers', function(event){
    event.preventDefault();
        $('#operation').val("Add");
      $.ajax({
        url:"php/assign_drivers.php",
        method:'POST',
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data)
        {
          alert(data);
          $('#assign-drivers')[0].reset();
          window.location.replace("assign-drivers.php");
        }
      });
    });
});
</script>
