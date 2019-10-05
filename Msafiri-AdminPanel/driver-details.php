<?php 
$pageName = 'driverlist';
require_once 'adminHeader.php';
$uID = base64_decode($_GET['u-ID']);
$selectUsers = "SELECT t1.*,t2.* FROM tbl_driverdata as t1 INNER JOIN tbl_driverdetails as t2 ON t1.id=t2.driver_id WHERE t1.id='".$uID."'";
$resultselectUsers = $db->query($selectUsers);

//1
$selectLic = "SELECT * FROM `tbl_driverdocuments` WHERE `photo_type`='licence' AND `driver_id` = '".$uID."'";
$resultLic = $db->query($selectLic);
$licCount  = $resultLic->num_rows;

//2
$selectVehicle = "SELECT * FROM `tbl_vehicledetails` WHERE `photo_type`='photo' AND `driver_id` = '".$uID."'";
$resultVehicle = $db->query($selectVehicle);
$vehicleCount  = $resultVehicle->num_rows;

//3
$selectplate = "SELECT * FROM `tbl_vehicledetails` WHERE `photo_type`='plate' AND `driver_id` = '".$uID."'";
$resultPlate = $db->query($selectplate);
$platCount   = $resultPlate->num_rows;

//4
 $selectProof = "SELECT * FROM `tbl_driverdocuments` WHERE `driver_id` = '".$uID."' AND (`photo_type`='passportid' OR `photo_type`='nationalid')";
$resultProof = $db->query($selectProof);
$proofCount  = $resultProof->num_rows;
?>
<?php
if($resultselectUsers->num_rows > 0)
{
    $dataselectUser = $resultselectUsers->fetch_assoc();
    if(isset($_POST['approveProfile']))
    {
        if($licCount == "0" || $vehicleCount == "0" || $platCount == "0" || $proofCount == "0")
        {
            $message = "Complete your profile before approve your profile.";

        } 
        else
        { 
        if($_POST['approvestatus'] == "0" || $_POST['approvestatus'] == "no"){
            $approvestatus = "yes";
            // notification code
            $device_token = $dataselectUser['device_token'];
            $url = 'https://fcm.googleapis.com/fcm/send';
            $fields = array();
            $fields1 = array();
            $fields['to'] = $device_token;
            $json = array("message" => "Dear, Driver your profile has been approved.","type" => 'driver_approvel');
            $fields1['message'] = json_encode($json);
            $fields1['title'] = 'TuRyde';
            //$fields['type'] = 'user_reminder';
            $fields['data'] = $fields1; 

            $fields = json_encode ( $fields );
            $headers = array (
                    'Authorization: key=' . "AAAAtGOUWZk:APA91bHmcm1PA38CmzUX_9C9IadlDr9HYIt1KUTkgd6xIVurkK8mFSGkSYn-Q-JE1oL0Nv9TY075JFlPIhwEABDXTWCdRFC_ehKALXrBvNhj-KEqKowCAv8tXtdYKuR-tINwePMAczfk",
                    'Content-Type: application/json'
            );
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $url );
            curl_setopt ( $ch, CURLOPT_POST, true );
            curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
            $result = curl_exec ( $ch );
            curl_close ( $ch );
            $rtn["code"]    = "000";//means result OK
            $rtn["msg"]     = "OK"; 
            $rtn["result"]  = $result;
        }
        else{
            $approvestatus = "no";
        }
        $updateApprovel = "UPDATE `tbl_driverdata` SET `approvel` = '".$approvestatus."' WHERE `tbl_driverdata`.`id` = '".$uID."'";
        $queryApprovel = $db->query($updateApprovel);
        echo "<script>window.location=\"driver-details.php?u-ID=".$_GET['u-ID']."\"</script>";
        }
    }
include 'adminSidemenu.php';
?>
    <!-- content area :: start -->
   
    <section id="main-content" class=" ">
        <div class="wrapper main-wrapper row" style=''>
            <div class="col-xs-12">
                        <div class="page-title">
                            <div class="pull-left">
                                <?php
                                if(isset($message)){?>
                                    <p style="color: red;"><?php echo $message;?></p>
                                <?php }
                                ?>
                                <h1 class="title">Driver Details</h1>
                            </div>
                            <div class="pull-right">
                                <div class="right-tools">
                                    <form method="post">
                                        <input type="hidden" name="approvestatus" value="<?php echo $dataselectUser['approvel']; ?>">
                                        <input type="submit" name="approveProfile" value="<?php if($dataselectUser['approvel'] == '0' || $dataselectUser['approvel'] == 'no'){ echo "Approve";}else{ echo "Unapprove";} ?>" class="btn btn-<?php if($dataselectUser['approvel'] == '0' || $dataselectUser['approvel'] == 'no'){ echo "success";}else{ echo "danger";} ?>">
                                    </form>
                                </div>
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
                                <img class="img-responsive img-circle" src="<?php echo APIROOT.'driver_uploads/'.$dataselectUser['id'].'/'.$dataselectUser['photo'];?>" alt=""/>

                            <?php } ?>
                            </span>
                            <span class="user-name"><?php echo $dataselectUser['fullname']; ?></span>
                        </div>
                    </div>
                    <div class="content-body">
                        <div class="user-details">
                            <ul>
                                <li> 
                                    <span>FullName</span>
                                    <span><?php echo $dataselectUser['fullname']; ?></span>
                                </li>
                                <li> 
                                    <span>Email Address</span>
                                    <span><?php echo $dataselectUser['email']; ?></span>
                                </li>
                                <li> 
                                    <span>Phone Number</span>
                                    <span><?php echo $dataselectUser['mobile_number']; ?></span>
                                </li>
                                <li> 
                                    <span>Birthdate</span>
                                    <span><?php echo $dataselectUser['dob']; ?></span>
                                </li>
                                <li> 
                                    <span>Gender</span>
                                    <span><?php echo $dataselectUser['gender']; ?></span>
                                </li>
                                <li> 
                                    <span>State</span>
                                    <span><?php echo $dataselectUser['state']; ?></span>
                                </li>
                                <li> 
                                    <span>City</span>
                                    <span><?php echo $dataselectUser['city']; ?></span>
                                </li>
                                <li> 
                                    <span>Address1<br><i class="add-title">Home</i></span>
                                    <span><?php echo $dataselectUser['street']; ?></span>
                                </li>
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
                    <div class="proof-area">
                        <ul class="nav nav-tabs transparent">
                            <li class="active"><a href="#licence" data-toggle="tab">Licence</a></li>
                            <li><a href="#vehicle" data-toggle="tab">Vehicle Image</a></li>
                            <li><a href="#address" data-toggle="tab">Address Proof</a></li>
                        </ul>
                        <div class="tab-content transparent clearfix">
                            <div class="tab-pane fade in active" id="licence">
                                <div class="row">
                                    <div class="demo-gallery">
                                        <ul id="lightgallery" class="list-unstyled row">
                                        <?php
                                        $selectLic = "SELECT * FROM `tbl_driverdocuments` WHERE `photo_type`='licence' AND `driver_id` = '".$uID."'";
                                        $resultLic = $db->query($selectLic);
                                        if($resultLic->num_rows > 0){
                                            $count = 1;
                                        while ($dataLic = $resultLic->fetch_assoc()) { 
                                            if($dataLic['photo'] == ""){
                                                continue;} else {?>
                                            <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="assets/images/driving.licence.jpg" data-src="assets/images/driving.licence.jpg" data-sub-html="<h4>Driving Licence</h4><p>Wycliffe Shane</p>">
                                                <img class="img-responsive" src="<?php echo APIROOT.'driver_uploads/'.$dataLic['driver_id'].'/'.$dataLic['photo'];?>">
                                            </li>
                                        <?php } } } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="vehicle">
                                <div class="row">
                                    <div class="demo-gallery">
                                    <?php
                                        $selectVehicle = "SELECT * FROM `tbl_driver_vehicle` WHERE `driver_id` = '".$uID."'";
                                        $resultVehicle = $db->query($selectVehicle);
                                        if($resultVehicle->num_rows > 0){
                                            $count = 1;
                                        while ($dataVehicle = $resultVehicle->fetch_assoc()) {
                                            if($dataVehicle['vehicle_profile'] == ""){
                                                continue;} else { ?>
                                        <div class="col-xs-6 col-sm-4 col-md-3">
                                            <img class="img-responsive" src="<?php echo APIROOT.'company_uploads/'.$dataselectUser['company_id'].'/'.$dataVehicle['vehicle_profile'];?>" alt=""/>
                                        </div>
                                    <?php } } } ?>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="tab-pane fade" id="address">
                                <div class="row">
                                    <?php
                                        $selectProof = "SELECT * FROM `tbl_driverdocuments` WHERE `photo_type`='proof' AND `driver_id` = '".$uID."'";
                                        $resultProof = $db->query($selectProof);
                                        if($resultProof->num_rows > 0){
                                            $count = 1;
                                        while ($dataProof = $resultProof->fetch_assoc()) { 
                                            if($dataProof['photo'] == ""){
                                                continue;} else {?>
                                    <div class="col-md-6">
                                        <img class="img-responsive" src="<?php echo APIROOT.'driver_uploads/'.$dataProof['driver_id'].'/'.$dataProof['photo'];?>" alt=""/>
                                    </div>
                                <?php } } }?>
                                </div>
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
                                                <!-- <th>Payment</th> -->
                                                <th>Review</th>
                                                <th class="no-sort">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $selectTrip = "
                                            SELECT `t2`.`id` as trip_id,`t2`.*, `t4`.`photo`, `t4`.`vehicle_profile`, `t5`.`vehicle_name`, `t5`.`vehicle_number` FROM `tbl_driver_setlocation` AS `t2` JOIN `tbl_driverdetails` AS `t4` ON `t2`.`driver_id` = `t4`.`driver_id` JOIN `tbl_driver_vehicle` AS `t5` ON `t2`.`driver_id` = `t5`.`driver_id` WHERE `t2`.`driver_id` = '".$uID."' GROUP BY `t2`.`id`";
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
                                            <td><?php echo $dataselectUser['fullname'];?></td>
                                            <td><?php echo $dataselectTrips['vehicle_number'];?></td>
                                            <td><?php echo $dataselectTrips['from_title'];?></td>
                                            <td><?php echo $dataselectTrips['to_title'];?></td>
                                            <td><?php echo $dataCaltime['sumtime'];?> Hrs</td>
                                            <td>MPESA</td>
                                            <!-- <td class="text-center"><input type="text" name="trip_price" id="trip_price<?php //echo $dataselectTrips['trip_id'];?>" value="<?php //echo $dataselectTrips['trip_price'];?>"><span class="btn btn-success trip_id" id="<?php //echo $dataselectTrips['trip_id'];?>">Add Price</span></td> -->
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
<script>
//searchText is a input type text
$('.trip_id').on('click', function (e) {
    var trip_id = $(this).attr("id");
    var tripPrice = $("#trip_price"+trip_id).val();
    // alert(trip_id);
    // alert(tripPrice);

    $.ajax({
        url:"ajax/addtripPrice.php",
        method:"POST",
        data:{tripPrice:tripPrice , trip_id:trip_id},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>driver-details.php?u-ID=<?php echo $_GET['u-ID'];?>");
        }
    });

    
});
</script>
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
        <?php 
        $graph = "SELECT count(*) as getcount, datetime, MONTH(datetime) as curmonh FROM tbl_driver_setlocation WHERE driver_id = '".$uID."' AND YEAR(datetime) = YEAR(CURDATE()) GROUP BY YEAR(datetime), MONTH(datetime)";
        $queryGraph = $db->query($graph);
        while ($dataLic = $queryGraph->fetch_assoc()) {
            // if($dataLic['curmonh']==1){
            //     $jj[] = $dataLic['getcount'].',';
            // }
            // else{
            //     $jj[] = '0'.',';
            // }
            // if($dataLic['curmonh']==2){
            //     $ff[] = $dataLic['getcount'].',';
            // }
            // else{
            //     $ff[] = '0'.',';  
            // }
            // if($dataLic['curmonh']==3){
            //     $mm[] = $dataLic['getcount'].',';
            // }
            // else{
            //     $mm []= '0'.',';  
            // }
            // if($dataLic['curmonh']==4){
            //     $ap = $dataLic['getcount'].',';
            // }
            // else{
            //     $ap = '0'.',';  
            // }
            // if($dataLic['curmonh']==5){
            //     $may = $dataLic['getcount'].',';
            // }
            // else{
            //     $may = '0'.',';  
            // }
            // if($dataLic['curmonh']==6){
            //     $jun = $dataLic['getcount'].',';
            // }
            // else{
            //     $jun = '0'.',';  
            // }
            // if($dataLic['curmonh']==7){
            //     $july = $dataLic['getcount'].',';
            // }
            // else{
            //     $july = '0'.',';  
            // }
            // if($dataLic['curmonh']==8){
            //     $aug = $dataLic['getcount'].',';
            // }
            // else{
            //     $aug = '0'.',';  
            // }
            // if($dataLic['curmonh']==9){
            //     $sep = $dataLic['getcount'].',';
            // }
            // else{
            //     $sep = '0'.',';  
            // }
            // if($dataLic['curmonh']==10){
            //     $oct = $dataLic['getcount'].',';
            // }
            // else{
            //     $oct = '0'.',';  
            // }
            // if($dataLic['curmonh']==11){
            //     $nov = $dataLic['getcount'].',';
            // }
            // else{
            //     $nov = '0'.',';  
            // }
            // if($dataLic['curmonh']==12){
            //     $dec = $dataLic['getcount'].',';
            // }
            // else{
            //     $dec = '0'.',';  
            // }
            echo $dataLic['getcount'].',';
        }
        
        ?>
            //8, 5, 2, 3, 10, 0, 10, 30, 15, 5, 20, 25
        ]
    }]
});

</script>
