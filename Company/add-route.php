<?php
$pageName = 'add-route';
include 'admin-header.php';?>
<!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
<?php include 'admin-sidebar.php';?>
    <section id="main-content" class=" ">
        <div class="wrapper main-wrapper row" style=''>
            <div class='col-xs-12'>
                <div class="page-title">
                    <div class="pull-left">
                        <h1 class="title">View Route</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <a href="add-new-route.php" class="btn btn-primary"><i class="fa fa-plus"></i> <span>Add New Route</span></a>
                        </div>
                    </div>
                </div>
            </div>
			<div id="show-error"></div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <section class="box has-border-left-3">
                    <header class="panel_header">
                        <h2 class="title pull-left">Route List</h2>
                    </header>
                    <div class="content-body">
                    <div class="row" id="displayRoute"> 
                    
                         <?php
                            $companyId  = $_SESSION['adminData']['id'];
                            $manageUser = "SELECT r.* FROM tbl_driver_setlocation as r left join tbl_driverdata as d ON d.id=r.driver_id where d.company_id='".$companyId."' ORDER BY d.id";
                            $resultManageUser = $db->query($manageUser);
                            if($resultManageUser->num_rows > 0){
                                $count = 1;
                                while ($dataManageEvent = $resultManageUser->fetch_assoc()) {
                        ?>
                        <div class="col-md-6">
                        <div class='routedetails-box'>
                            <div class='route-header clearfix'>
                                <div class='route-title'>Route <?php echo $count++;?></div>
                                    <div class='route-action'>
                                       <a href='add-new-route.php?route_id=<?php echo base64_encode($dataManageEvent['id']);?>' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Edit Route'><i class='fa fa-pencil'></i></a>
                                        <a href='#' class='btn btn-danger btn-xs delete' data-toggle='tooltip' data-placement='top' title='Remove Route' id="<?php echo $dataManageEvent['id'];?>"><i class='fa fa-close'></i></a>
                                    </div>
                                </div>
                                <div class='route-area'>
                                    <iframe class='route-map' src='https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d17742.983877611223!2d-84.35425946458327!3d33.743117762998345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1538975337859' frameborder='0' style='border:0' allowfullscreen></iframe>
                                </div>
                                <div class='route-details'>
                                    <div class='pickup-route'>
                                        <span class='pr-title'><?php if($dataManageEvent['from_address'] == ""){ echo "-";}else{echo $dataManageEvent['from_address'];}?></span>
                                        <span class='pr-time'><?php if($dataManageEvent['datetime'] == ""){ echo "-";}else{echo $dataManageEvent['datetime'];}?></span>
                                    </div>
                                    <div class='destination-route'>
                                            <span class='pr-title'><?php if($dataManageEvent['to_address'] == ""){ echo "-";}else{echo $dataManageEvent['to_address'];}?></span>
                                            <span class='pr-time'><?php if($dataManageEvent['end_datetime'] == ""){ echo "-";}else{echo $dataManageEvent['end_datetime'];}?></span>
                                    </div>
                            </div>
                        </div>
                        </div>
                        <?php }}
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
                </section>
            </div>
        </div>
    </section>
    <!-- content area :: end -->
</div>

<?php include 'admin-footer.php';?>
<!-- main-container :: end -->
<!-- js -->

<script>
$(document).on('click', '.delete', function(){
    var route_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"php/ajaxDelete.php",
        method:"POST",
        data:{route_id:route_id,action:'routeDelete'},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>add-route.php");
        }
      });
    }
    else
    {
      return false; 
    }
});
</script>