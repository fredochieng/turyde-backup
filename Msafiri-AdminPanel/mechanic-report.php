<?php 
$pageName = 'mechanic-report';
require_once 'adminHeader.php';?>
<?php
if(isset($_GET) && !empty($_GET['mechanic_id']) && empty($_GET['daterange'])){
    $selectUser = "SELECT t1.*,t2.full_name FROM tbl_vehicle as t1 INNER JOIN tbl_users as t2 ON t1.mechanic_id = t2.mechanic_id WHERE t2.status = 'active' AND t1.mechanic_id = '".$_GET['mechanic_id']."'";
}
elseif(isset($_GET) && !empty($_GET['daterange']) && empty($_GET['mechanic_id'])){
    $datrangeData = str_replace(' ', '', urldecode($_GET['daterange']));
    $getdate = explode("/",$datrangeData);
    $fromdate = $getdate[0];// . " 00:00:00";
    $endDate = $getdate[1];//. " 59:00:00";
    $selectUser = "SELECT t1.*,t2.full_name FROM tbl_vehicle as t1 INNER JOIN tbl_users as t2 ON t1.mechanic_id = t2.mechanic_id WHERE t2.status = 'active' AND (t1.created_date BETWEEN '".$fromdate."' AND '".$endDate."')";
}
elseif(isset($_GET) && !empty($_GET['mechanic_id']) && !empty($_GET['daterange'])){
    $datrangeData = str_replace(' ', '', urldecode($_GET['daterange']));
    $getdate = explode("/",$datrangeData);
    $fromdate = $getdate[0];// . " 00:00:00";
    $endDate = $getdate[1];//. " 59:00:00";
    $selectUser = "SELECT t1.*,t2.full_name FROM tbl_vehicle as t1 INNER JOIN tbl_users as t2 ON t1.mechanic_id = t2.mechanic_id WHERE t2.status = 'active' AND t1.mechanic_id = '".$_GET['mechanic_id']."' AND (t1.created_date BETWEEN '".$fromdate."' AND '".$endDate."')";
}
else{
    $selectUser = "SELECT t1.*,t2.full_name FROM tbl_vehicle as t1 INNER JOIN tbl_users as t2 ON t1.mechanic_id = t2.mechanic_id WHERE t2.status = 'active'";
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
                        <h1 class="title">Mechanic Report</h1>
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
                    <section class="search-box">
                        <form class="search-form" method="get">
                            <div class="row">
                                <!-- <div class="col-md-3 padright-0">
                                    <input type="text" class="form-control" placeholder="Enter Licence No.">
                                </div> -->
                                <div class="col-md-4 padright-0">
                                    <select class="form-control" name="mechanic_id">
                                        <option value="">Select Mechanic Name</option>
                                        <?php
                                        $selectDriver = "SELECT * FROM `tbl_users` WHERE `status` = 'active'";
                                        $resultselectDriver = $db->query($selectDriver);
                                        if($resultselectDriver->num_rows > 0){
                                            $count = 1;
                                        while ($dataselectDriver = $resultselectDriver->fetch_assoc()) { ?>
                                        <option value="<?php echo $dataselectDriver['mechanic_id'];?>" <?php if($dataselectDriver['mechanic_id'] == $_GET['mechanic_id']){ echo 'selected';} ?>><?php echo $dataselectDriver['full_name'];?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                                <div class="col-md-4 padright-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="daterange" placeholder="Select Date" value="<?php echo $_GET['daterange']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 padright-0">
                                    <input type="text" class="form-control" placeholder="Select Trip Number">
                                </div> -->
                                <div class="col-md-3">
                                    <input type="submit" class="btn btn-primary" placeholder="Search">
                                    <input type="reset" class="btn btn-primary" placeholder="Reset">
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
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
                                                <th class="text-center">Sr#</th>
                                                <th class="text-left">Mechanic Name</th>
                                                <th class="text-center">Driver Name</th>
                                                <th class="text-center">Vehicle Type</th>
                                                <th class="text-center">Plate No.</th>
                                                <th class="text-center">Date</th>
                                                <th class="text-center" style="display: none;">Status</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">View Report</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $resultselectUser = $db->query($selectUser);
                                            if($resultselectUser->num_rows > 0){
                                                $count = 1;
                                            while ($dataselectUser = $resultselectUser->fetch_assoc()) { ?>
                                            <tr>
                                                <th class="text-center"><?php echo $count++;?></th>
                                                <td><?php echo $dataselectUser['full_name']; ?></td>
                                                <td><?php echo $dataselectUser['driver_name'];?></td>
                                                <td class="text-center" ><?php echo $dataselectUser['car_type'];?></td>
                                                <td class="text-center"><?php echo $dataselectUser['plate_no'];?></td>
                                                <td class="text-center"><?php echo date_format(date_create($dataselectUser['created_date']),"F d,Y");?></td>
                                                <td style="display: none;"><?php echo $dataselectUser['status'];?></td>
                                                <td class="text-center">
                                                <select style="border: 1px solid #ccc;background-color: white;border-radius: 500px;" class="selectID" id="<?php echo $dataselectUser['id'];?>">
                                                    <option value="Pending" <?php if($dataselectUser['status'] == 'Pending'){ echo 'selected';}?>>Pending</option>
                                                    <option value="Accept" <?php if($dataselectUser['status'] == 'Accept'){ echo 'selected';}?>>Accept</option>
                                                    <option value="Decline" <?php if($dataselectUser['status'] == 'Decline'){ echo 'selected';}?>>Decline</option>
                                                </select></td>
                                                <td class="text-center">
                                                    <a href="#" class="btn btn-primary btn-sm btn-corner-little"><i class="fa fa-eye"></i> View Report</a>
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
    $(document).on('click', '.delete', function(){
    var mechanic_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"ajax/ajax_delete.php",
        method:"POST",
        data:{mechanic_id:mechanic_id,action:'mechanicDelete'},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>mechanicList.php");
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
          window.location.replace("<?php echo ADMINROOT;?>mechanic-report.php");
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
                     columns: [ 0 ,1 , 2, 3, 4, 5, 6]
                }
            }
        ],
        select: true
    } );
} );
</script>