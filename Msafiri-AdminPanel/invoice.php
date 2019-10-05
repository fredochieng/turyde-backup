<?php 
$pageName = 'trips';
require_once 'adminHeader.php';
$uID = base64_decode($_GET['tripID']);
$selectUsers = "SELECT * FROM `tbl_driver_setlocation` WHERE `id`='".$uID."'";
$resultselectTrip = $db->query($selectUsers);
// distance time
$calculateTime = "SELECT SEC_TO_TIME(SUM(UNIX_TIMESTAMP(`end_datetime`) - UNIX_TIMESTAMP(`datetime`))) AS sumtime FROM tbl_driver_setlocation WHERE `id` = '".$uID."'";
$resultTime = $db->query($calculateTime);
$dataCaltime = $resultTime->fetch_assoc();
?>
<?php include 'adminSidemenu.php';
if($resultselectTrip->num_rows > 0){
$dataselectTrip = $resultselectTrip->fetch_assoc();
// distance
$distance = $newobj->calDistance($dataselectTrip['from_lat'],$dataselectTrip['from_lng'],$dataselectTrip['to_lat'],$dataselectTrip['to_lng'],'K');
// GET PRICE BASED ON LOCATION
echo $getLocation = "SELECT * FROM `tbl_new_trip_price` WHERE `from_address` = '".$dataselectTrip['from_address']."' AND `to_address` = '".$dataselectTrip['to_address']."'";
$resultLocation = $db->query($getLocation);
$dataLocation = $resultLocation->fetch_assoc();

?>
            <!-- content area :: start -->
            <section id="main-content" class=" ">
                <div class="wrapper main-wrapper row" style=''>
                    <div class='col-xs-12'>
                        <div class="page-title">
                            <div class="pull-left">
                                <h1 class="title">Invoice</h1>
                            </div>
                            <div class="pull-right">
                                <div class="right-tools">
                                    <a href="trips.php" class="btn btn-primary"><i class="fa fa-chevron-left"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12">
                        <section class="box has-border-left-3">
                            <header class="panel_header">
                                <h2 class="title pull-left"><b>Trip Timing</b> <?php echo date_format(date_create($dataselectTrip['datetime']),"h:i A");?> on <?php echo date_format(date_create($dataselectTrip['datetime']),"d F Y");?></h2>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-sm-6 rider-invoice-new-left">
                                        <div class="invoice-map">
                                            <?php
                                            if($dataselectTrip['photo'] == "" || $dataselectTrip['photo'] == "no_profile.png"){?>
                                                <img class="map-area" src="<?php echo NOMAPIMAGE;?>" alt=""/>

                                            <?php }else {?>
                                                <img class="map-area" src="<?php echo APIROOT.'driver_uploads/'.$dataselectTrip['driver_id'].'/'.$dataselectTrip['photo'];?>" alt=""/>

                                            <?php } ?>
                                            <!-- <iframe class="map-area" src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29603890.159023073!2d66.55288131383058!3d25.07625373505963!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1530086561569" height="300" frameborder="0" style="border:0" allowfullscreen></iframe> -->
                                        </div>
                                        <div class="invoice-location clearfix">
                                            <div class="location-fromto">
                                                <div class="location-icon">
                                                    <i class="fa fa-map-marker green"></i>
                                                </div>
                                                <div class="location-address">
                                                    <b><?php echo date_format(date_create($dataselectTrip['datetime']),"h:i A");?></b>
                                                    <p><?php echo $dataselectTrip['from_address'];?></p>
                                                </div>
                                            </div>
                                            <div class="location-fromto">
                                                <div class="location-icon">
                                                    <i class="fa fa-map-marker red"></i>
                                                </div>
                                                <div class="location-address">
                                                    <b><?php echo date_format(date_create($dataselectTrip['end_datetime']),"h:i A");?></b>
                                                    <p><?php echo $dataselectTrip['to_address'];?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rider-invoice-middle clearfix">
                                            <?php
                                            $selectCar = "SELECT `vehicle_name` FROM `tbl_driver_vehicle` WHERE `driver_id`='".$dataselectTrip['driver_id']."'";
                                            $resultselectCar = $db->query($selectCar);
                                            $dataselectCar = $resultselectCar->fetch_assoc();
                                            ?>
                                            <div class="col-sm-4">
                                                <div class="ride-invoice-box">
                                                    <p>Car</p>
                                                    <p><?php echo $dataselectCar['vehicle_name'];?></p>
                                                </div>	
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="ride-invoice-box">
                                                    <p>Distance</p>
                                                    <p><?php echo number_format($distance,2);?> km</p>
                                                </div>	
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="ride-invoice-box">
                                                    <p>Trip  Time</p>
                                                    <p><?php echo $dataCaltime['sumtime'];?> Hrs.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="rider-invoice-bottom clearfix">
                                            <div class="col-sm-6">
                                                <div class="trip-details-box">
                                                    <div class="drive-img">
                                                        <img src="assets/images/driver.png" alt=""/>
                                                    </div>
                                                    <?php
                                                    $selectUsers = "SELECT t1.*,t2.* FROM tbl_driverdata as t1 INNER JOIN tbl_driverdetails as t2 ON t1.id=t2.driver_id WHERE t1.id='".$dataselectTrip['driver_id']."'";
                                                    $resultselectUsers = $db->query($selectUsers);
                                                    $dataselectUser = $resultselectUsers->fetch_assoc();
                                                    ?>
                                                    <div class="drive-details">
                                                        <div class="trip-details-title">Driver</div>
                                                        <ul class="trip-detail-list">
                                                            <li><?php echo $dataselectUser['fullname'];?></li>
                                                            <li><?php echo $dataselectUser['email'];?></li>
                                                            <li><?php echo $dataselectUser['mobile_number'];?></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="trip-details-box">
                                                    <div class="drive-img">
                                                        <img src="assets/images/taxi_passanger.png" alt=""/>
                                                    </div>
                                                    <div class="drive-details">
                                                        <div class="pull-right">
                                                        <div class="right-tools">
                                                            <a href="<?php echo ADMINROOT;?>tripUser.php?trip_id=<?php echo $uID;?>" class="btn btn-primary"><i class="fa fa-download"></i> View All Users</a>
                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 rider-invoice-new-right">
                                        <h4 class="inner-title">Fare Breakdown For TRIP NO :TRIPID0<?php echo $uID;?></h4>
                                        <table class="table ride-invoice-table">
                                            <tbody>
                                                <tr>
                                                    <td>Price Type</td>
                                                    <td align="right"><?php echo ucfirst($dataLocation['type']);?></td>
                                                </tr>
                                                <tr>
                                                    <td>Distance (<?php echo number_format($distance,2);?> km)</td>
                                                    <td align="right">$<?php echo $dataLocation['price'];?></td>
                                                </tr>
                                                <tr>
                                                    <td>Time </td>
                                                    <td align="right"><?php echo $dataCaltime['sumtime'];?> Hrs.</td>
                                                </tr>
                                                <!-- <tr>
                                                    <td>Commision</td>
                                                    <td align="right">-$0.34</td>
                                                </tr> -->
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><b>Total Fare (Via Cash)</b></td>
                                                    <td align="right">
                                                        <b>$<?php echo $dataLocation['price'];?></b>															</b>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
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
<?php }else {
    include 'page-not-found.php';
} ?>
<?php include 'adminFooter.php'; ?>