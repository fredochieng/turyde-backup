<?php 
$pageName = 'reports';
$subpageName = 'ride-acceptance-report';
require_once 'adminHeader.php';?>
<?php
if(isset($_GET) && !empty($_GET['driver_id']) && empty($_GET['daterange'])){
    $selectUser = "SELECT count(t1.driver_id) as countrequest,t1.*,t2.fullname,(SELECT COUNT(t3.driver_id) FROM tbl_driver_setlocation as t3 WHERE t3.status != 'cancel' AND t1.driver_id=t3.driver_id) AS countaccept ,(SELECT COUNT(t4.driver_id) FROM tbl_driver_setlocation as t4 WHERE t4.status = 'pending' AND t1.driver_id=t4.driver_id) AS countprogress,(SELECT COUNT(t5.driver_id) FROM tbl_driver_setlocation as t5 WHERE t5.status = 'cancel' AND t1.driver_id=t5.driver_id) AS countcancel FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id WHERE t1.driver_id = '".$_GET['driver_id']."' GROUP BY t1.driver_id";
}
elseif(isset($_GET) && !empty($_GET['daterange']) && empty($_GET['driver_id'])){
    $datrangeData = str_replace(' ', '', urldecode($_GET['daterange']));
    $getdate = explode("/",$datrangeData);
    $fromdate = $getdate[0] . " 00:00:00";
    $endDate = $getdate[1]. " 23:59:59";
    $selectUser = "SELECT count(t1.driver_id) as countrequest,t1.*,t2.fullname,(SELECT COUNT(t3.driver_id) FROM tbl_driver_setlocation as t3 WHERE t3.status != 'cancel' AND t1.driver_id=t3.driver_id) AS countaccept ,(SELECT COUNT(t4.driver_id) FROM tbl_driver_setlocation as t4 WHERE t4.status = 'pending' AND t1.driver_id=t4.driver_id) AS countprogress,(SELECT COUNT(t5.driver_id) FROM tbl_driver_setlocation as t5 WHERE t5.status = 'cancel' AND t1.driver_id=t5.driver_id) AS countcancel FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id WHERE (t1.datetime BETWEEN '".$fromdate."' AND '".$endDate."') GROUP BY t1.driver_id";
}
elseif(isset($_GET) && !empty($_GET['driver_id']) && !empty($_GET['daterange'])){
    $datrangeData = str_replace(' ', '', urldecode($_GET['daterange']));
    $getdate = explode("/",$datrangeData);
    $fromdate = $getdate[0] . " 00:00:00";
    $endDate = $getdate[1]. " 23:59:59";
    $selectUser = "SELECT count(t1.driver_id) as countrequest,t1.*,t2.fullname,(SELECT COUNT(t3.driver_id) FROM tbl_driver_setlocation as t3 WHERE t3.status != 'cancel' AND t1.driver_id=t3.driver_id) AS countaccept ,(SELECT COUNT(t4.driver_id) FROM tbl_driver_setlocation as t4 WHERE t4.status = 'pending' AND t1.driver_id=t4.driver_id) AS countprogress,(SELECT COUNT(t5.driver_id) FROM tbl_driver_setlocation as t5 WHERE t5.status = 'cancel' AND t1.driver_id=t5.driver_id) AS countcancel FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id WHERE t1.driver_id = '".$_GET['driver_id']."' AND (t1.datetime BETWEEN '".$fromdate."' AND '".$endDate."') GROUP BY t1.driver_id";
}
else{
    $selectUser = "SELECT count(t1.driver_id) as countrequest,t1.*,t2.fullname,(SELECT COUNT(t3.driver_id) FROM tbl_driver_setlocation as t3 WHERE t3.status != 'cancel' AND t1.driver_id=t3.driver_id) AS countaccept ,(SELECT COUNT(t4.driver_id) FROM tbl_driver_setlocation as t4 WHERE t4.status = 'pending' AND t1.driver_id=t4.driver_id) AS countprogress,(SELECT COUNT(t5.driver_id) FROM tbl_driver_setlocation as t5 WHERE t5.status = 'cancel' AND t1.driver_id=t5.driver_id) AS countcancel FROM tbl_driver_setlocation as t1 INNER JOIN tbl_driverdata as t2 ON t1.driver_id=t2.id GROUP BY t1.driver_id";
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
                    <h1 class="title">Driver Trip Count</h1>
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
                                <div class="col-md-4 padright-0">
                                    <select class="form-control" name="driver_id">
                                        <option value="">Select Driver Name</option>
                                        <?php
                                        $selectDriver = "SELECT * FROM `tbl_driverdata`";
                                        $resultselectDriver = $db->query($selectDriver);
                                        if($resultselectDriver->num_rows > 0){
                                            $count = 1;
                                        while ($dataselectDriver = $resultselectDriver->fetch_assoc()) { ?>
                                        <option value="<?php echo $dataselectDriver['id'];?>" <?php if($dataselectDriver['id'] == $_GET['driver_id']){ echo 'selected';} ?>><?php echo $dataselectDriver['fullname'];?></option>
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
                                    <a href="<?php echo ADMINROOT;?>ride-acceptance-report.php" class="btn btn-primary">Reset</a>
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
                                <table id="example" class="table table-small-font no-mb table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="no-sort">Sr #</th>
                                            <th class="text-center">Driver Name</th>
                                            <th>Total Trip Requests</th>
                                            <th class="text-center">Requests Accepted Trip Requests</th>
                                            <th class="text-center">Requests Declined</th>
                                            <th class="text-center">In Process Requests</th>
                                            <!-- <th class="text-left">Acceptance Percentage</th> -->
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
                                            <td class="text-center"><?php echo $dataselectUser['fullname'];?></td>
                                            <td class="text-center"><?php echo $dataselectUser['countrequest'];?></td>
                                            <td class="text-center"><?php echo $dataselectUser['countaccept'];?></td>
                                            <td class="text-center"><?php echo $dataselectUser['countcancel'];?></td>
                                            <td class="text-center"><?php echo $dataselectUser['countprogress'];?></td>
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
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                     columns: [ 0 ,1 , 2, 3, 4, 5]
                }
            }
        ],
        select: true
    } );
} );
</script>