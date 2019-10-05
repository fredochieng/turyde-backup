<?php
$pageName = 'add-vehicle';
include 'admin-header.php';?>
        <!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
<?php include 'admin-sidebar.php';?>
    <section id="main-content" class=" ">
        <div class="wrapper main-wrapper row" style=''>
            <div class='col-xs-12'>
                <div class="page-title">
                    <div class="pull-left">
                        <h1 class="title">Add Vehicle</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <a href="add-new-vehicle.php" class="btn btn-primary"><i class="fa fa-plus"></i> <span>Add New Vehicle</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
			<div id="alert-danger"></div>
            <div class="col-lg-12">
                <section class="box has-border-left-3">
                    <header class="panel_header">
                        <h2 class="title pull-left">Vehicle List</h2>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
								    <table id="vehicleDatatables" class="table table-striped table-bordered data_table">
		                            <thead>
			                            <tr>
										    <th class="no-sort text-center">Sr #</th>
										    <th class="no-sort text-center">Vehicle Image</th>
                                            <th class="text-left">Vehicle Name</th>
										    <th class="text-left">Vehicle Type</th>
										    <th class="text-left">Vehicle Plate Number</th>
										    <th class="no-sorttext-center">Person Capacity</th>
				                            <th class="no-sort text-center">Action</th>
			                            </tr>
		                            </thead>
		    	                        <tbody> 
                                        <?php
                                        $manageEvent = "SELECT * FROM tbl_driver_vehicle where company_id='".$_SESSION['adminData']['id']."' ORDER BY id DESC";
                                        $resultManageEvent    = $db->query($manageEvent);
                                        if($resultManageEvent->num_rows > 0){
                                            $count = 1;
                                        while ($dataManageEvent = $resultManageEvent->fetch_assoc()) {
                                            $sDirPath = COMPANYUPLOADS.$_SESSION['adminData']['id'].'/';

                                        ?>
                                        <tr>
                                        <td class="text-center"><?php echo $count++ ?></td>
                                        <td class="text-center"><?php if($dataManageEvent['vehicle_profile'] == ""){ ?><img class="img-circle img-user" src="<?php echo NOUSERIMAGE;?>" alt=""><?php }else{ ?><img class="img-circle img-user" src="<?php echo $sDirPath.$dataManageEvent['vehicle_profile']; ?>" alt=""/><?php }?></td>
                                        <td class="text-left"><?php if($dataManageEvent['vehicle_name'] == ""){ echo "-";}else{echo $dataManageEvent['vehicle_name'];}?></td>
                                        <td class="text-left"><?php if($dataManageEvent['vehicle_type'] == ""){ echo "-";}else{echo $dataManageEvent['vehicle_type'];}?></td>
                                        <td class="text-left"><?php if($dataManageEvent['vehicle_number'] == ""){ echo "-";}else{echo $dataManageEvent['vehicle_number'];}?></td>
                                        <td class="text-center"><?php if($dataManageEvent['seats'] == ""){ echo "-";}else{echo $dataManageEvent['seats'];}?></td>
                                        <td class="text-center">
                                            <a href="add-new-vehicle.php?v-ID=<?php echo base64_encode($dataManageEvent['id'])?>" id="<?php echo $dataManageEvent['id'];?>" class="btn btn-success btn-sm" ><i class="fa fa-pencil"></i></a>
                                            <a href="#" data-target="#viewModal_<?php echo $dataManageEvent['id'];?>" data-id="<?php echo $dataManageEvent['id'];?>" id ="viewVehicle" data-toggle="modal" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                            <a href="#" class="btn btn-danger btn-sm delete" id="<?php echo $dataManageEvent['id'];?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                        </tr>
                                    <!-- View Vehicle Modal -->
                                    <div class="modal fade view-vehicle-detail" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="viewModal_<?php echo $dataManageEvent['id'];?>">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Vehicle Detail<?php echo $dataManageEvent['id'];?></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                                                </div>
                                                <div class="vehicleview-box">
                                                    <div class="vehicle-img">
                                                       <?php if($dataManageEvent['vehicle_profile'] == ""){ echo "-";}else{ ?><img src="<?php echo $sDirPath.$dataManageEvent['vehicle_profile']; ?>" alt=""/><?php }?>
                                                    </div>
                                                    <div class="vehicleinfo-area">
                                                        <div class="vehicle-info clearfix">
                                                            <div class="vehicle-title">Vehicle Type</div>
                                                            <div class="vehicle-name" id="vehicle_type_view"><?php if($dataManageEvent['vehicle_type'] == ""){ echo "-";}else{echo $dataManageEvent['vehicle_type'];}?></div>
                                                        </div>
                                                        <div class="vehicle-info clearfix">
                                                            <div class="vehicle-title">Vehicle Name</div>
                                                            <div class="vehicle-name" id="vehicle_model_view"><?php if($dataManageEvent['vehicle_name'] == ""){ echo "-";}else{echo $dataManageEvent['vehicle_name'];}?></div>
                                                        </div>
                                                        <div class="vehicle-info clearfix">
                                                            <div class="vehicle-title">Vehicle Plate Number</div>
                                                            <div class="vehicle-name" id="plate_no_view"><?php if($dataManageEvent['vehicle_number'] == ""){ echo "-";}else{echo $dataManageEvent['vehicle_number'];}?></div>
                                                        </div>
                                                        <div class="vehicle-info clearfix">
                                                            <div class="vehicle-title">Person Capacity</div>
                                                            <div class="vehicle-name" id="seats_view"><?php if($dataManageEvent['seats'] == ""){ echo "-";}else{echo $dataManageEvent['seats'];}?></div>
                                                        </div>
                                                        <div class="vehicle-info clearfix">
                                                            <div class="vehicle-title">Document</div>
                                                            <?php
                                                            $manageEvent1 = "SELECT * FROM tbl_vehicledetails where vehicle_id ='".$dataManageEvent['id']."' ORDER BY id DESC";
                                                            $resultManageEvent1    = $db->query($manageEvent1);
                                                            if($resultManageEvent1->num_rows > 0){
                                                                $count1 = 1;
                                                            while ($dataManageEvent1 = $resultManageEvent1->fetch_assoc()) {
                                                            ?>
                                                            <div class="vehicle-name" id="seats_view">
                                                                <a href="<?php echo $sDirPath.$dataManageEvent1['photo']; ?>" download>Download <?php echo $count1++;?></a>
                                                            </div></br>
                                                            <?php }} ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end Vehicle modal -->
                                    <?php }}?>
                                    </tbody>
                                    </table> 
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
    var vehicle_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"php/ajaxDelete.php",
        method:"POST",
        data:{vehicle_id:vehicle_id,action:'vehicleDelete'},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>add-vehicle.php");
        }
      });
    }
    else
    {
      return false; 
    }
});

</script>
