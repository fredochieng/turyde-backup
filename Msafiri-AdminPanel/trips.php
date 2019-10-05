<?php 
$pageName = 'trips';
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
                        <h1 class="title">Trips History</h1>
                    </div>
                    <!-- <div class="pull-right">
                        <div class="right-tools">
                            <a href="javascript:void();" class="btn btn-primary"><i class="fa fa-download"></i> Download CSV</a>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <section class="box ">
                    <!-- <header class="panel_header">
                        <h2 class="title pull-left">History</h2>
                    </header> -->
                    <div class="content-body">    
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="table-1" class="table table-small-font no-mb table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Sr#</th>
                                                <th>Trip ID</th>
                                                <th>Driver Name</th>
                                                <th>Pickup Location</th>
                                                <th>Destination Location</th>
                                                <th>Start Trip Time</th>
                                                <th>End Trip Time</th>
                                                <th>Travel Time</th>
                                                <th>Payment</th>
                                                <th>View Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $selectTrip = "SELECT `t1`.*, `t1`.`status` as `user_trip_status`, `t2`.*, `t4`.`photo`, `t4`.`vehicle_profile`, `t5`.`vehicle_name`,`t5`.`vehicle_number` FROM `tbl_user_trips` as `t1` JOIN `tbl_driver_setlocation` as `t2` ON `t1`.`trip_id`=`t2`.`id` JOIN `tbl_driverdetails` as `t4` ON `t1`.`driver_id`=`t4`.`driver_id` JOIN `tbl_driver_vehicle` as `t5` ON `t1`.`driver_id`=`t5`.`driver_id` GROUP BY `t1`.`trip_id`";
                                        $resultselecttrips = $db->query($selectTrip);
                                        if($resultselecttrips->num_rows > 0){
                                            $count = 1;
                                        while ($dataselectTrips = $resultselecttrips->fetch_assoc()) {
                                            $calculateTime = "SELECT SEC_TO_TIME(SUM(UNIX_TIMESTAMP(`end_datetime`) - UNIX_TIMESTAMP(`datetime`))) AS sumtime FROM tbl_driver_setlocation WHERE `id` = '".$dataselectTrips['trip_id']."'";
                                            $resultTime = $db->query($calculateTime);
                                            $dataCaltime = $resultTime->fetch_assoc();
                                            // driver name
                                            $selectUsers = "SELECT * FROM tbl_driverdata WHERE id='".$dataselectTrips['driver_id']."'";
                                            $resultselectUsers = $db->query($selectUsers);
                                            $dataselectUser = $resultselectUsers->fetch_assoc();
                                            // payment
                                            $selectPass = "SELECT COUNT(`passanger_id`) as getcount FROM `tbl_trip_passanger` WHERE `trip_id`='".$dataselectTrips['trip_id']."' AND `status` = 'completed'";
                                            $resultselectPass = $db->query($selectPass);
                                            $dataPass = $resultselectPass->fetch_assoc();

                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count++;?></td>
                                            <td>TRIPID0<?php echo $dataselectTrips['trip_id'];?></td>
                                            <td><?php echo $dataselectUser['fullname'];?></td>
                                            <td><?php echo $dataselectTrips['from_title'];?></td>
                                            <td><?php echo $dataselectTrips['to_title'];?></td>
                                            <td><?php echo $dataselectTrips['datetime'];?></td>
                                            <td><?php echo $dataselectTrips['end_datetime'];?></td>
                                            <td><?php echo $dataCaltime['sumtime'];?> Hrs</td>
                                            <td class="text-center">
                                                <?php echo $dataselectTrips['trip_price']*$dataPass['getcount'];?>
                                            </td>
                                            <td class="text-center">
                                                <a href="invoice.php?tripID=<?php echo base64_encode($dataselectTrips['trip_id']);?>" class="btn btn-primary btn-sm btn-corner-little"><i class="fa fa-eye"></i> View Invoice</a>
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