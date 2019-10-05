<?php
$pageName = 'assign-drivers';
include 'admin-header.php';?>
        <!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
<?php include 'admin-sidebar.php';?>
    <!-- content area :: start -->
    <section id="main-content" class=" ">
        <div class="wrapper main-wrapper row" style=''>
            <div class='col-xs-12'>
                <div class="page-title">
                    <div class="pull-left">
                        <h1 class="title">Assign Drivers</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <a href="add-assign-drivers.php" class="btn btn-primary"><i class="fa fa-plus"></i> <span>Add Assign Drivers</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <section class="box has-border-left-3">
                            
                            <header class="panel_header">
                                <h2 class="title pull-left">Assign Drivers List</h2>
                            </header>
                            <div class="content-body">
                            <div class="row">
                           
                                <?php
                            $manageUser  = "select a.id as assign_driver_id,d.fullname,v.* from tbl_driverdata as d inner join tbl_assign_driver as a ON a.driver_id=d.id inner join tbl_driver_vehicle as v ON a.vehicle_id=v.id ORDER BY a.id DESC";
                            $resultManageUser = $db->query($manageUser);
                            if($resultManageUser->num_rows > 0){
                                $count = 1;
                            while ($dataManageUser = $resultManageUser->fetch_assoc()) {
                                $sDirPath = COMPANYUPLOADS.$_SESSION['adminData']['id'].'/';
                            ?>
                             <div class="col-md-4">
                                <div class="assigndrivers-box">
                                    <div class="assigndrivers-header clearfix">
                                        <div class="assigndrivers-name"><?php if($dataManageUser['fullname'] == ""){ echo "-";}else{echo $dataManageUser['fullname'];}?></div>
                                        <div class="assigndrivers-action">
                                            <a href="#" class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="top" title="Remove Assign Drivers" id="<?php echo $dataManageUser['assign_driver_id'];?>"><i class="fa fa-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="assigndrivers-image">
                                        <img class="img-responsive" src="<?php echo $sDirPath; ?><?php if($dataManageUser['vehicle_profile'] == ""){ ?> <img class="img-circle img-user" src="<?php echo NOUSERIMAGE;?>" alt=""> <?php }else{echo $dataManageUser['vehicle_profile'];}?>" alt="">
                                    </div>
                                    <div class="assigndrivers-details">
                                        <div class="assignvehicle-name"><i class="fa fa-car"></i> <?php if($dataManageUser['vehicle_name'] == ""){ echo "-";}else{echo $dataManageUser['vehicle_name'];}?></div>
                                        <div class="assignvehicle-number"><i class="fa fa-credit-card-alt"></i> <?php if($dataManageUser['vehicle_number'] == ""){ echo "-";}else{echo $dataManageUser['vehicle_number'];}?></div>
                                    </div>
                                </div>
                            </div>
                            <?php } }
                             else{ ?>
                            <div class="content-body">
                                <div class="row">
                                <div class="col-md-12">
                                    <div class="no-data-found"><?php echo "No Data Available";?></div>
                                </div>
                                </div>
                                </div>
                            <?php }?>
                            
                            </div>
                            </div>
                      
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
    <!-- content area :: end -->
</div>
<!-- main-container :: end -->
<?php include 'admin-footer.php';?>
<script>
$(document).on('click', '.delete', function(){
    var assign_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"php/ajaxDelete.php",
        method:"POST",
        data:{assign_id:assign_id,action:'assignDriverDelete'},
        success:function(data)
        {
          window.location.replace("<?php echo ADMINROOT;?>assign-drivers.php");
        }
      });
    }
    else
    {
      return false; 
    }
});
</script>