<?php
$pageName = 'dashboard';
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
                                <h1 class="title">Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="r4_counter db_box has-gradient-to-right-bottom">
                                    <div class="icon-after cc fa fa-users"></div>
                                    <i class="pull-left icon-md icon-white mt-20 fa fa-users"></i>
                                    <div class="stats">
                                        <?php 
                                        $user_sql      = "SELECT * FROM tbl_userdata";
                                        $driver_result  = $db->query($user_sql);
                                        $total_driver   = $driver_result->num_rows;
                                        ?>
                                        <h2 class="color-white mb-5"><?php echo $total_driver;?></h2>
                                        <span>Total Users</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="r4_counter db_box has-gradient-to-right-bottom">
                                    <div class="icon-after cc fa fa-users"></div>
                                    <i class="pull-left icon-md icon-white mt-20 fa fa-users"></i>
                                    <div class="stats">
                                        <?php 
                                        $user_sql1      = "SELECT * FROM tbl_driverdata";
                                        $driver_result1  = $db->query($user_sql1);
                                        $total_driver1   = $driver_result1->num_rows;
                                        ?>
                                        <h2 class="color-white mb-5"><?php echo $total_driver1;?></h2>
                                        <span>Total Driver</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="r4_counter db_box has-gradient-to-right-bottom">
                                    <div class="icon-after cc fa fa-users"></div>
                                    <i class="pull-left icon-md icon-white mt-20 fa fa-users"></i>
                                    <div class="stats">
                                        <?php 
                                        $user_sql11      = "SELECT * FROM tbl_users";
                                        $driver_result11  = $db->query($user_sql11);
                                        $total_driver11   = $driver_result11->num_rows;
                                        ?>
                                        <h2 class="color-white mb-5"><?php echo $total_driver11;?></h2>
                                        <span>Total Mechanic</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="r4_counter db_box has-gradient-to-right-bottom">
                                    <div class="icon-after cc fa fa-users"></div>
                                    <i class="pull-left icon-md icon-white mt-20 fa fa-users"></i>
                                    <div class="stats">
                                        <?php 
                                        $user_sql111      = "SELECT * FROM tbl_company";
                                        $driver_result111  = $db->query($user_sql111);
                                        $total_driver111   = $driver_result111->num_rows;
                                        ?>
                                        <h2 class="color-white mb-5"><?php echo $total_driver111;?></h2>
                                        <span>Total Company</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End .row -->
                        <div class="row">
                            <!-- <div class="col-lg-8 col-md-12">
                                <section class="box has-border-left-3">
                                    <header class="panel_header">
                                        <h2 class="title pull-left">Applications Download</h2>
                                        <div class="actions panel_actions pull-right">

                                        </div>
                                    </header>
                                    <div class="content-body">    
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="container1" style="min-width: 310px; height: 336px; margin: 0 auto"></div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div> -->
                            <div class="col-lg-12 col-md-12">
                                <section class="box has-border-left-3">
                                    <header class="panel_header">
                                        <h2 class="title pull-left">Latest Driver</h2>
                                        <div class="actions panel_actions pull-right">
                                            <a href="driverList.php" class="btn btn-primary btn-corner btn-sm">View All</a>
                                        </div>
                                    </header>
                                    <div class="content-body">    
                                        <div class="row">
                                            <div class="col-md-12">
                                        <?php
                                        $selectDriver = "SELECT t1.*,t2.* FROM tbl_driverdata as t1 INNER JOIN tbl_driverdetails as t2 ON t1.id=t2.driver_id ORDER BY t1.id DESC LIMIT 9";
                                        $resultdriver = $db->query($selectDriver);
                                        if($resultdriver->num_rows > 0){
                                            $count = 1;
                                        while ($dataDriver = $resultdriver->fetch_assoc()) { ?>
                                                <div class="col-lg-4 col-md-3 col-xs-4">
                                                    <a href="driver-details.php?u-ID=<?php echo base64_encode($dataDriver['id'])?>" class="latestuser-area" data-toggle="tooltip" data-placement="top" title="<?php echo $dataDriver['fullname']; ?>">
                                                        <div class="latestuser-img">
                                                        <?php
                                                            if($dataDriver['photo'] == "" || $dataDriver['photo'] == "no_profile.png"){?>
                                                            <img class="img-responsive img-circle" src="<?php echo NOUSERIMAGE;?>" alt=""/>

                                                        <?php }else {?>
                                                            <img class="img-responsive img-circle" src="<?php echo APIROOT.'driver_uploads/'.$dataDriver['id'].'/'.$dataDriver['photo'];?>" alt=""/>

                                                        <?php } ?>
                                                        </div>
                                                        <div class="latestuser-detail">
                                                            <div class="latestuser-name"><?php echo $dataDriver['fullname']; ?></div>
                                                            <div class="latestuser-day"><?php echo date_format(date_create($dataDriver['created_date']),"F d,Y");?></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            <?php } } ?>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- End .row -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <section class="box has-border-left-3">
                                    <header class="panel_header">
                                        <h2 class="title pull-left">Latest Reports</h2>
                                        <div class="actions panel_actions pull-right">
                                            <a href="trips.php" class="btn btn-primary btn-corner btn-sm">View All</a>
                                        </div>
                                    </header>
                                    <div class="content-body">    
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                <table id="example" class="table table-bordered table-striped dataTable no-footer">
                                                    <thead>
                                                        <tr>
                                                            <th>Trip ID</th>
                                                            <th>Driver Name</th>
                                                            <th>Pickup Location</th>
                                                            <th>Destination Location</th>
                                                            <th>Start Trip Time</th>
                                                            <th>End Trip Time</th>
                                                            <th>Travel Time</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $selectTrip = "SELECT `t1`.*, `t1`.`status` as `user_trip_status`, `t2`.*, `t4`.`photo`, `t4`.`vehicle_profile`, `t5`.`vehicle_name`,`t5`.`vehicle_number` FROM `tbl_user_trips` as `t1` JOIN `tbl_driver_setlocation` as `t2` ON `t1`.`trip_id`=`t2`.`id` JOIN `tbl_driverdetails` as `t4` ON `t1`.`driver_id`=`t4`.`driver_id` JOIN `tbl_driver_vehicle` as `t5` ON `t1`.`driver_id`=`t5`.`driver_id` GROUP BY `t1`.`trip_id` ORDER BY `t1`.`id` DESC LIMIT 10";
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
                                                        ?>
                                                        <tr>
                                                            <td>TRIPID0<?php echo $dataselectTrips['trip_id'];?></td>
                                                            <td><?php echo $dataselectUser['fullname'];?></td>
                                                            <td><?php echo $dataselectTrips['from_title'];?></td>
                                                            <td><?php echo $dataselectTrips['to_title'];?></td>
                                                            <td><?php echo $dataselectTrips['datetime'];?></td>
                                                            <td><?php echo $dataselectTrips['end_datetime'];?></td>
                                                            <td><?php echo $dataCaltime['sumtime'];?> Hrs</td>
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
                        <!-- End .row -->
                    </div>
                </div>
            </section>
            <!-- content area :: end -->
        </div>
        <!-- main-container :: end -->
<?php require_once 'adminFooter.php';?>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        
    } );
} );
</script>