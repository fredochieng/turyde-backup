<?php 
$pageName       = 'reports';
$subpageName    = 'driver-payment-report';
require_once 'admin-header.php';
include 'admin-sidebar.php';
?>
<?php
if(isset($_GET) && !empty($_GET['driver_id']) && empty($_GET['daterange']) && empty($_GET['addressPickup']) && empty($_GET['addressDestination'])){

   $selectUser = "SELECT dd.id as driverId,dd.fullname,ds.from_address,ds.to_address,ds.trip_price,count(tp.trip_id) as passanger from tbl_driverdata as dd left join tbl_driver_setlocation as ds ON ds.driver_id=dd.id left join tbl_trip_passanger as tp ON tp.trip_id=ds.id where dd.company_id='".$_SESSION['adminData']['id']."' and dd.id='".$_GET['driver_id']."' and tp.status='completed' GROUP BY dd.id";
}
elseif(isset($_GET) && !empty($_GET['daterange']) && empty($_GET['addressPickup']) && empty($_GET['addressDestination']) && empty($_GET['driver_id'])){
    $datrangeData   = str_replace(' ', '', urldecode($_GET['daterange']));
    $getdate        = explode("/",$datrangeData);
    $fromdate       = $getdate[0] . " 00:00:00";
    $endDate        = $getdate[1]. " 23:59:59";
    $selectUser     = "SELECT dd.id as driverId,dd.fullname,ds.from_address,ds.to_address,ds.trip_price,ds.created_date,count(tp.trip_id) as passanger from tbl_driverdata as dd left join tbl_driver_setlocation as ds ON ds.driver_id=dd.id left join tbl_trip_passanger as tp ON tp.trip_id=ds.id where dd.company_id='".$_SESSION['adminData']['id']."' AND (ds.created_date BETWEEN '".$fromdate."' AND '".$endDate."') and tp.status='completed' GROUP BY dd.id";
}
elseif(isset($_GET) && empty($_GET['driver_id']) && empty($_GET['daterange']) && !empty($_GET['addressPickup']) && !empty($_GET['addressDestination'])){
    $selectUser = "SELECT dd.id as driverId,dd.fullname,ds.from_address,ds.to_address,ds.trip_price,ds.created_date,count(tp.trip_id) as passanger from tbl_driverdata as dd left join tbl_driver_setlocation as ds ON ds.driver_id=dd.id left join tbl_trip_passanger as tp ON tp.trip_id=ds.id where dd.company_id='".$_SESSION['adminData']['id']."' AND ds.from_address='".$_GET['addressPickup']."' AND ds.to_address='".$_GET['addressDestination']."' and tp.status='completed' GROUP BY dd.id";
}
elseif(isset($_GET) && !empty($_GET['driver_id']) && !empty($_GET['daterange']) && !empty($_GET['addressPickup']) && !empty($_GET['addressDestination'])){
    $datrangeData = str_replace(' ', '', urldecode($_GET['daterange']));
    $getdate    = explode("/",$datrangeData);
    $fromdate   = $getdate[0] . " 00:00:00";
    $endDate    = $getdate[1]. " 23:59:59";
    $selectUser = "SELECT dd.id as driverId,dd.fullname,ds.from_address,ds.to_address,ds.trip_price,ds.created_date,count(tp.trip_id) as passanger from tbl_driverdata as dd left join tbl_driver_setlocation as ds ON ds.driver_id=dd.id left join tbl_trip_passanger as tp ON tp.trip_id=ds.id where dd.company_id='".$_SESSION['adminData']['id']."' AND (ds.created_date BETWEEN '".$fromdate."' AND '".$endDate."') AND ds.from_address='".$_GET['addressPickup']."' AND ds.to_address='".$_GET['addressDestination']."' and dd.id='".$_GET['driver_id']."' and tp.status='completed' GROUP BY dd.id";
}
else{
   echo $selectUser = "SELECT dd.id as driverId,dd.fullname,ds.from_address,ds.to_address,ds.trip_price,count(tp.trip_id) as passanger from tbl_driverdata as dd left join tbl_driver_setlocation as ds ON ds.driver_id=dd.id left join tbl_trip_passanger as tp ON tp.trip_id=ds.id where dd.company_id='".$_SESSION['adminData']['id']."' and tp.status='completed' GROUP BY dd.id";
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
                    <h1 class="title">Driver Payment</h1>
                </div>
                <!-- <div class="pull-right">
                    <div class="right-tools">
                        <a href="javascript:void();" class="btn btn-primary"><i class="fa fa-download"></i> Download CSV</a>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="clearfix"></div>
                <div class="col-lg-12">
                    <section class="search-box">
                        <form class="search-form" method="get">
                            <div class="row">
                                <div class="col-md-4 padright-0 paddingBottom0">
                                    <select class="form-control" name="driver_id">
                                        <option value="">Select Driver Name</option>
                                        <?php
                                        $selectDriver = "SELECT * FROM `tbl_driverdata` where company_id='".$_SESSION['adminData']['id']."'";
                                        $resultselectDriver = $db->query($selectDriver);
                                        if($resultselectDriver->num_rows > 0){
                                            $count = 1;
                                        while ($dataselectDriver = $resultselectDriver->fetch_assoc()) { ?>
                                        <option value="<?php echo $dataselectDriver['id'];?>" <?php if($dataselectDriver['id'] == $_GET['driver_id']){ echo 'selected';} ?>><?php echo $dataselectDriver['fullname'];?></option>
                                        <?php } }?>
                                    </select>
                                </div>
                                <div class="col-md-4 padright-0 paddingBottom0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="daterange" placeholder="Select Date" value="<?php echo $_GET['daterange']; ?>">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-3 padright-0">
                                    <input type="text" class="form-control" placeholder="Select Trip Number">
                                </div> -->
                              
                            </div>

                             <div class="row">
                                <div class="col-md-4 padright-0">
                                    <select class="form-control" name="addressPickup" id="addressPickup">
                                        <option value="">Select Pickup Location</option>
                                        <?php
                                        $manageCat = "SELECT * from tbl_location";
                                        $resultManageCat    = $db->query($manageCat);
                                        if($resultManageCat->num_rows > 0){
                                            $count = 1;
                                        while ($event = $resultManageCat->fetch_assoc()) {
                                                    ?>
                                            <option id="<?php echo $event["address"];?>" value="<?php echo $event["address"];?>" <?php if(isset($row['from_address']) && $row['from_address'] != '' && $row['from_address'] == $event["address"]) { echo "selected";} ?>><?php echo $event["address"];?></option>
                                        <?php
                                            } }
                                        ?>   
                                    </select>
                                </div>
                                <div class="col-md-4 padright-0">
                                     <select class="form-control" id="addressDestination" name="addressDestination">
                                    <option id="0" value="">Select Destination Location</option>
                                    <?php
                                    $manageCat = "SELECT * from tbl_location";
                                    $resultManageCat    = $db->query($manageCat);
                                    if($resultManageCat->num_rows > 0){
                                        $count = 1;
                                    while ($event = $resultManageCat->fetch_assoc()) {
                                                ?>
                                        <option id="<?php echo $event["address"];?>" value="<?php echo $event["address"];?>" <?php if(isset($row['to_address']) && $row['to_address'] != '' && $row['to_address'] == $event["address"]) { echo "selected";} ?>><?php echo $event["address"];?></option>
                                    <?php
                                        } }
                                    ?>   
                                </select>
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
                    <h2 class="title pull-left">Driver Trip Count List</h2>
                </header> -->
                <div class="content-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive">
                                <table id="driver-payment-table" class="table table-small-font no-mb table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="no-sort">Sr #</th>
                                            <th class="text-center">Driver Name</th>
                                            <th>Pickup Location</th>
                                            <th>Destination Location</th>
                                            <th>Total Passanger</th>
                                            <th>Total Trip Price</th>
                                            <th>Action</th>
                                            <!-- <th class="text-left">Acceptance Percentage</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $resultselectUser = $db->query($selectUser);
                                        if($resultselectUser->num_rows > 0){
                                            $count = 1;
                                        while ($dataselectUser = $resultselectUser->fetch_assoc()) { 
                                            $totalPrice += $dataselectUser['passanger'] * $dataselectUser['trip_price'];
                                        ?>
                                        <tr>
                                            <th class="text-center"><?php echo $count++;?></th>
                                            <td class="text-center"><?php echo $dataselectUser['fullname'];?></td>
                                            <td class="text-center"><?php echo $dataselectUser['from_address'];?></td>
                                            <td class="text-center"><?php echo $dataselectUser['to_address'];?></td>
                                            <td class="text-center"><?php echo $dataselectUser['passanger'];?></td>
                                            <td class="text-center"><?php echo $total = $dataselectUser['passanger'] * $dataselectUser['trip_price'];?></td>
                                            <td><a href="view-add-drivers.php?d-ID=<?php echo base64_encode($dataselectUser['driverId']);?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a></td>
                                        </tr>
                                       
                                    <?php } } ?>
                                     <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $totalPrice; ?></td>
                                        <td></td>
                                    </tr>
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
<?php require_once 'admin-footer.php';?>
