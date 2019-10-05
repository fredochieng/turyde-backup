<?php 
$pageName = 'mechaniclist';
require_once 'adminHeader.php';?>
<!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
    <?php include 'adminSidemenu.php';?>
    <!-- content area :: start -->
    <section id="main-content" class=" ">
        <div class="wrapper main-wrapper row" style=''>
            <div class='col-xs-12'>
                <div class="page-title">
                    <div class="pull-left">
                        <h1 class="title">Mechanic Details</h1>
                    </div>
                    <!-- <div class="pull-right">
                        <div class="right-tools">
                            <a href="javascript:void();" class="btn btn-primary"><i class="fa fa-download"></i> Download CSV</a>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <section class="box has-border-left-3">
                    <!-- <header class="panel_header">
                        <h2 class="title pull-left">Reviews List</h2>
                    </header> -->
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-small-font no-mb table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">Sr #</th>
                                                <th class="text-left">Name</th>
                                                <th class="no-sort">Contact</th>
                                                <th class="no-sort">Car</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>View</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $selectUser = "SELECT * FROM `tbl_vehicle` WHERE `mechanic_id`='".base64_decode($_GET['u-ID'])."' ORDER BY `status` ASC";
                                            $resultselectUser = $db->query($selectUser);
                                            if($resultselectUser->num_rows > 0){
                                                $count = 1;
                                            while ($dataselectUser = $resultselectUser->fetch_assoc()) { ?>
                                            <tr>
                                                <th class="text-center"><?php echo $count++;?></th>
                                                <td><?php echo $dataselectUser['driver_name']; ?></td>
                                                <td><?php echo $dataselectUser['contact_no'];?></td>
                                                 <td><?php echo $dataselectUser['car_type']." - ".$dataselectUser['model_name'];?></td>
                                                 <td><?php echo $dataselectUser['created_date'];?></td>
                                                <td class="text-center">
                                                <select style="border: 1px solid #ccc;background-color: white;border-radius: 500px;" class="selectID" id="<?php echo $dataselectUser['id'];?>">
                                                    <option value="Pending" <?php if($dataselectUser['status'] == 'Pending'){ echo 'selected';}?>>Pending</option>
                                                    <option value="Accept" <?php if($dataselectUser['status'] == 'Accept'){ echo 'selected';}?>>Accept</option>
                                                    <option value="Decline" <?php if($dataselectUser['status'] == 'Decline'){ echo 'selected';}?>>Decline</option>
                                                </select></td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-primary btn-sm btn-corner-little"><i class="fa fa-eye"></i> View Repairs</a>
                                                    <a href="#" class="btn btn-primary btn-sm btn-corner-little"><i class="fa fa-eye"></i> View Invoice</a>
                                                </td>
                                            </tr>
                                        <?php } } ?>
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
<?php require_once 'adminFooter.php';?>
<script>
//searchText is a input type text
$('.selectID').on('change', function (e) {
    var sid = $(this).attr("id");
    var optionSelected = $("option:selected", this);
    var mechanicvehicleStatus = this.value;
    if(confirm("Are you sure you want to change status?"))
    {
      $.ajax({
        url:"ajax/changeStatus.php",
        method:"POST",
        data:{mechanicvehicleStatus:mechanicvehicleStatus , sid:sid},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>mechanic-detail-report.php?u-ID=<?php echo $_GET['u-ID'];?>");
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
    } );
} );
</script>