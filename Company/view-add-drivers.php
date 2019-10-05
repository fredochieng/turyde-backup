<?php
$pageName = 'add-drivers';
include 'admin-header.php';?>
        <!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
<?php include 'admin-sidebar.php';?>
 <!-- sidebar :: end -->
            <!-- content area :: start -->
            <?php
            $driverId = base64_decode($_GET['d-ID']);
            $manageUser                = "select dd.fullname,dd.email,dd.status,d.* from tbl_driverdetails as d left join tbl_driverdata as dd ON dd.id=d.driver_id where dd.id = '".$driverId."'";
            $resultManageUser           = $db->query($manageUser);
            if($resultManageUser->num_rows > 0){
                $count = 1;
                $dataManageUser = $resultManageUser->fetch_assoc();
                $sDirPath = DRIVERUPLOADS.$driverId.'/';
                $sDirPath1 = COMPANYUPLOADS.$_SESSION['adminData']['id'].'/';
            }
            ?>
           
            <section id="main-content" class=" ">
                <div class="wrapper main-wrapper row" style=''>
                    <div class='col-xs-12'>
                        <div class="page-title">
                            <div class="pull-left">
                                <h1 class="title">Driver Details</h1>
                            </div>
                            <div class="pull-right">
                                <div class="right-tools">
                                    <a href="add-drivers.php" class="btn btn-primary"><i class="fa fa-chevron-left"></i> <span>Back</span></a>
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
                                <div class="user-area" id="user-area">
                                    <span class="user-image">
                                        <img class="img-responsive img-circle" src="<?php echo $sDirPath.$dataManageUser['photo']; ?>" alt=""/>
                                    </span>
                                </div>
                            </div>
                            <div class="content-body">
                                <div class="user-details" id="user-details">
                                    <ul>
                                        <li> 
                                            <span>FullName</span>
                                            <span><div id="fullName"><?php echo $dataManageUser['fullname'];?></div></span>
                                        </li>
                                        <li> 
                                            <span>Email Address</span>
                                            <span><div id="email"><?php echo $dataManageUser['email'];?></div></span>
                                        </li>
                                        <li> 
                                            <span>Phone Number</span>
                                            <span><div id="phone"><?php echo $dataManageUser['mobile_number'];?></div></span>
                                        </li>
                                        <li> 
                                            <span>Birthdate</span>
                                            <span><div id="dob"><?php echo $dataManageUser['dob'];?></div></span>
                                        </li>
                                        <li> 
                                            <span>Gender</span>
                                            <span><div id="gender"><?php echo $dataManageUser['gender'];?></div></span>
                                        </li>
                                        <li> 
                                            <span>State</span>
                                            <span><div id="state"><?php echo $dataManageUser['state'];?></div></span>
                                        </li>
                                        <li> 
                                            <span>City</span>
                                            <span><div id="city"><?php echo $dataManageUser['city'];?></div></span>
                                        </li>
                                        <li> 
                                            <span>Address1<br><i class="add-title">Home</i></span>
                                            <span><div id="street"><?php echo $dataManageUser['street'];?></div></span>
                                        </li>
                                        <li> 
                                            <span>Status</span>

                                            <span><div id="status"><?php echo $dataManageUser['status'];?></div></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-8">
                        <section class="box">
                            <div class="proof-area">
                                <ul class="nav nav-tabs primary">
                                    <li class="active"><a href="#vehicle" data-toggle="tab">Vehicle Image</a></li>
                                    <li><a href="#address" data-toggle="tab">Licence & Address Proof</a></li>
                                </ul>
                                <div class="tab-content transparent clearfix">
                                    <div class="tab-pane fade in active" id="vehicle">
                                        <div class="row">
                                            <div class="demo-gallery">
                                            <?php
                                            $manageUser1            = "select * from tbl_driver_vehicle where driver_id='".$driverId."'";
                                            $resultManageUser1      = $db->query($manageUser1);
                                            if($resultManageUser1->num_rows > 0){
                                                $count = 1;
                                            while ($dataManageUser1 = $resultManageUser1->fetch_assoc()) {
                                                ?>
                                                    <div class="col-xs-6 col-sm-4 col-md-3">
                                                        <img class="img-responsive" src="<?php echo $sDirPath1.$dataManageUser1['vehicle_profile']; ?>" alt=""/>
                                                    </div>
                                                <?php }} ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="address">
                                        <div class="row">
                                            <div class="demo-gallery proof-area">
                                    <?php
                                    $manageUser11            = "select * from tbl_driverdocuments where driver_id='".$driverId."' and photo_type = 'proof'";
                                    $resultManageUser11      = $db->query($manageUser11);
                                    if($resultManageUser11->num_rows > 0){
                                        $count = 1;
                                    while ($dataManageUser11 = $resultManageUser11->fetch_assoc()) {
                                        ?>
                                                <div class="col-xs-6 col-sm-4 col-md-3">
                                                    <img class="img-responsive" src="<?php echo $sDirPath.$dataManageUser11['photo']; ?>" alt=""/>
                                                    <a href="<?php echo $sDirPath.$dataManageUser11['photo']; ?>">Download Proof <?php echo $count++?></a>
                                                </div>
                                        
                                        <?php }} ?>
                                        
                                        <?php
                                        $manageUser11            = "select * from tbl_driverdocuments where driver_id='".$driverId."' and photo_type = 'licence'";
                                        $resultManageUser11      = $db->query($manageUser11);
                                        if($resultManageUser11->num_rows > 0){
                                            $count = 1;
                                        while ($dataManageUser11 = $resultManageUser11->fetch_assoc()) {
                                            ?>
                                          
                                                <div class="col-xs-6 col-sm-4 col-md-3">
                                                     <img class="img-responsive" src="<?php echo $sDirPath.$dataManageUser11['photo']; ?>" alt=""/>
                                                      <a href="<?php echo $sDirPath.$dataManageUser11['photo']; ?>">Download License<?php echo $count++?></a>
                                                </div>
                                           
                                            <?php }} ?>
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
                                                <th>Vehicle No.</th>
                                                <th>Vehicle Name.</th>
                                                <th>Pickup Location</th>
                                                <th>Destination Location</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th class="no-sort">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                       $selectTrip = "SELECT `t2`.*, `t4`.`photo`, `t4`.`vehicle_profile`, `t5`.`vehicle_name`, `t5`.`vehicle_number` FROM `tbl_driver_setlocation` AS `t2` JOIN `tbl_driverdetails` AS `t4` ON `t2`.`driver_id` = `t4`.`driver_id` JOIN `tbl_driver_vehicle` AS `t5` ON `t2`.`driver_id` = `t5`.`driver_id` WHERE `t2`.`driver_id` = '".$driverId."' GROUP BY `t2`.`id`";
                                        $resultselecttrips = $db->query($selectTrip);
                                        if($resultselecttrips->num_rows > 0){
                                            $count = 1;
                                        while ($dataselectTrips = $resultselecttrips->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $count++;?></td>
                                            <td>TRIPID0<?php echo $dataselectTrips['id'];?></td>
                                             <td><?php echo $dataselectTrips['vehicle_number'];?></td>
                                            <td><?php echo $dataselectTrips['vehicle_name'];?></td>
                                            <td><?php echo $dataselectTrips['from_address'];?></td>
                                            <td><?php echo $dataselectTrips['to_address'];?></td>
                                            <td><?php echo $dataselectTrips['datetime'];?></td>
                                            <td><?php echo $dataselectTrips['end_datetime'];?></td>
                                            <td><?php echo $dataselectTrips['status'];?></td>
                                        </tr>
                                    <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <!-- content area :: end -->
        </div>
        <!-- main-container :: end -->
        <!-- js -->
<?php include 'admin-footer.php';?>