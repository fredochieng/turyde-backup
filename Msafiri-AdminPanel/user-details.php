<?php 
$pageName = 'userlist';
require_once 'adminHeader.php';
$uID = base64_decode($_GET['u-ID']);
$selectUsers = "SELECT * FROM `tbl_userdata` WHERE `id`='".$uID."'";
$resultselectUsers = $db->query($selectUsers);
?>

<?php include 'adminSidemenu.php';
if($resultselectUsers->num_rows > 0){
    $dataselectUser = $resultselectUsers->fetch_assoc();
?><!-- content area :: start -->
<section id="main-content" class=" ">
    <div class="wrapper main-wrapper row" style=''>
        <div class='col-xs-12'>
            <div class="page-title">
                <div class="pull-left">
                    <h1 class="title">User Details</h1>
                </div>
                <div class="pull-right hidden-xs">
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php"><i class="fa flaticon-dashboard"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="userList.php">Users</a>
                        </li>
                        <li class="active">
                            <strong>User Details</strong>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-4">
            <section class="box user-box">
                <div class="content-header">
                    <div class="img-bg">
                        <img class="img-responsive" src="assets/images/bg-profile.jpg" alt=""/>
                    </div>
                    <div class="user-area">
                        <span class="user-image">
                            <?php
                            if($dataselectUser['photo'] == "" || $dataselectUser['photo'] == "no_profile.png"){?>
                                <img class="img-responsive img-circle" src="<?php echo NOUSERIMAGE;?>" alt=""/>

                            <?php }else {?>
                                <img class="img-responsive img-circle" src="<?php echo APIROOT.'user_uploads/'.$dataselectUser['id'].'/'.$dataselectUser['photo'];?>" alt=""/>

                            <?php } ?>
                        </span>
                        <span class="user-name"><?php echo $dataselectUser['fname'].' '.$dataselectUser['lname'];?></span>
                    </div>
                </div>
                <div class="content-body">
                    <div class="user-details">
                        <ul>
                            <li> 
                                <span>FirstName</span>
                                <span><?php echo $dataselectUser['fname'];?></span>
                            </li>
                            <li> 
                                <span>LastName</span>
                                <span><?php echo $dataselectUser['lname'];?></span>
                            </li>
                            <li> 
                                <span>Email Address</span>
                                <span><?php echo $dataselectUser['user_email'];?></span>
                            </li>
                            <li> 
                                <span>Phone Number</span>
                                <span><?php echo $dataselectUser['mobile_number'];?></span>
                            </li>
                            <li> 
                                <span>Total Spent</span>
                                <span>$1,000</span>
                            </li>
                            <!-- <li> 
                                <span>Birthdate</span>
                                <span>18/06/1991</span>
                            </li> -->
                            <li> 
                                <span>Gender</span>
                                <span><?php echo $dataselectUser['gender'];?></span>
                            </li>
                            <!-- <li> 
                                <span>State</span>
                                <span>Nairobi</span>
                            </li>
                            <li> 
                                <span>City</span>
                                <span>Machakos</span>
                            </li>
                            <li> 
                                <span>Address1<br><i class="add-title">Home</i></span>
                                <span>Casuarina Rd, Malindi, Kenya</span>
                            </li>
                            <li> 
                                <span>Address2<br><i class="add-title">Office</i></span>
                                <span>Casuarina Rd, Malindi, Kenya</span>
                            </li> -->
                            <li> 
                                <span>Status</span>
                                <span><i class="status-<?php if($dataselectUser['status'] == 'active'){ echo 'complete';} else{ echo 'cancelled';}?>"><?php echo $dataselectUser['status']; ?></i></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-8">
            <section class="box">
                <header class="panel_header">
                    <h2 class="title pull-left">Ride Activity</h2>
                </header>
                <div class="content-body">    
                    <div class="row">
                        <div class="col-xs-12">
                            <div id="container1" style="min-width: 310px; height: 435px; margin: 0 auto"></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <section class="box ">
                <header class="panel_header">
                    <h2 class="title pull-left">History</h2>
                </header>
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
                                            <th>Vehicle No.</th>
                                            <th>Pickup Location</th>
                                            <th>Destination Location</th>
                                            <th>Travel Time</th>
                                            <th>Payment Mode</th>
                                            <th>Payment</th>
                                            <th>Ratting</th>
                                            <th class="no-sort">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $selectTrip = "SELECT `t1`.*, `t1`.`status` as `user_trip_status`, `t2`.*, `t3`.`fullname`, `t4`.`photo`, `t4`.`vehicle_profile`, `t5`.`vehicle_name`,`t5`.`vehicle_number` FROM `tbl_user_trips` as `t1` JOIN `tbl_driver_setlocation` as `t2` ON `t1`.`trip_id`=`t2`.`id` JOIN `tbl_driverdata` as `t3` ON `t1`.`driver_id`=`t3`.`id` JOIN `tbl_driverdetails` as `t4` ON `t1`.`driver_id`=`t4`.`driver_id` JOIN `tbl_driver_vehicle` as `t5` ON `t1`.`driver_id`=`t5`.`driver_id` WHERE `t1`.`user_id` = '".$uID."'";
                                        $resultselecttrips = $db->query($selectTrip);
                                        if($resultselecttrips->num_rows > 0){
                                            $count = 1;
                                        while ($dataselectTrips = $resultselecttrips->fetch_assoc()) {
                                        $calculateTime = "SELECT SEC_TO_TIME(SUM(UNIX_TIMESTAMP(`end_datetime`) - UNIX_TIMESTAMP(`datetime`))) AS sumtime FROM tbl_driver_setlocation WHERE `id` = '".$dataselectTrips['trip_id']."'";
                                            $resultTime = $db->query($calculateTime);
                                            $dataCaltime = $resultTime->fetch_assoc();
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count++;?></td>
                                            <td>TRIPID0<?php echo $dataselectTrips['trip_id'];?></td>
                                            <td><?php echo $dataselectTrips['fullname'];?></td>
                                            <td><?php echo $dataselectTrips['vehicle_number'];?></td>
                                            <td><?php echo $dataselectTrips['from_title'];?></td>
                                            <td><?php echo $dataselectTrips['to_title'];?></td>
                                            <td><?php echo $dataCaltime['sumtime'];?> Hrs</td>
                                            <td>MPESA</td>
                                            <td class="text-center">$100</td>
                                            <td>
                                                <!-- <div class="star-rating">
                                                    <span class="fa fa-star" data-rating="1"></span>
                                                    <span class="fa fa-star" data-rating="2"></span>
                                                    <span class="fa fa-star-o" data-rating="3"></span>
                                                    <span class="fa fa-star-o" data-rating="4"></span>
                                                    <span class="fa fa-star-o" data-rating="5"></span>
                                                    <input type="hidden" name="whatever1" class="rating-value" value="2">
                                                </div> -->
                                                <?php echo $dataselectTrips['rating'];?>
                                            </td>
                                            <td><span class="status-complete">Paid</span></td>
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
        <div class="clearfix"></div>
    </div>
</section>
<!-- content area :: end -->
</div>
<!-- main-container :: end -->
<?php }else {
    include 'page-not-found.php';
} ?>
<?php include 'adminFooter.php'; ?>
<!--graph js-->
<script src="assets/js/highcharts.js" type="text/javascript"></script>
<script src="assets/js/exporting.js" type="text/javascript"></script>
<script src="assets/js/export-data.js" type="text/javascript"></script>
<script type="text/javascript">
    /*--------------------------------
     Ride Activity :: Start
     --------------------------------*/
    Highcharts.chart('container1', {
        chart: {
            type: 'area'
        },
        colors: ['#2196F3'],
        xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        },
        yAxis: {
            title: {
                text: 'Ride Activity'
            },
            labels: {
                formatter: function () {
                    return this.value;
                }
            }
        },
        plotOptions: {
            area: {
                marker: {
                    enabled: false,
                    symbol: 'circle',
                    radius: 2,
                    states: {
                        hover: {
                            enabled: true
                        }
                    }
                }
            }
        },
        series: [{
                name: 'Ride Activity',
                data: [
                    1, 5, 2, 3, 10, 0, 10, 30, 15, 5, 20, 25
                ]
            }]
    });
    
</script>