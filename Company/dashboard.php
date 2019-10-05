<?php
$pageName = 'dashboard';
include 'admin-header.php'; ?>
<!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
    <?php include 'admin-sidebar.php'; ?>
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
                    <div class="col-lg-3 col-sm-6 col-xs-6">
                        <div class="r4_counter db_box has-gradient-to-right-bottom">
                            <div class="icon-after cc fa fa-users"></div>
                            <i class="pull-left icon-md icon-white mt-20 fa fa-users"></i>
                            <div class="stats">
                                <?php
                                $user_sql      = "SELECT * FROM tbl_driverdata where type='company' and company_id='" . $_SESSION['adminData']['id'] . "'";
                                $driver_result  = $db->query($user_sql);
                                $total_driver   = $driver_result->num_rows;
                                ?>
                                <h2 class="color-white mb-5"><?php echo $total_driver ?></h2>
                                <span>Total Driver</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-6">
                        <div class="r4_counter db_box has-gradient-to-right-bottom">
                            <div class="icon-after cc fa fa-car"></div>
                            <i class="pull-left icon-md icon-white mt-20 fa fa-car"></i>
                            <div class="stats">
                                <?php
                                $user_sql1      = "SELECT * FROM tbl_driver_vehicle where company_id='" . $_SESSION['adminData']['id'] . "'";
                                $driver_result1  = $db->query($user_sql1);
                                $total_driver1   = $driver_result1->num_rows;
                                ?>
                                <h2 class="color-white mb-5"><?php echo $total_driver1; ?></h2>
                                <span>Total Vehicle</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-6">
                        <div class="r4_counter db_box has-gradient-to-right-bottom">
                            <div class="icon-after cc fa fa-file-text-o"></div>
                            <i class="pull-left icon-md icon-white mt-20 fa fa-file-text-o"></i>
                            <div class="stats">
                                <?php
                                $user_sql11      = "SELECT * FROM tbl_assign_driver where company_id='" . $_SESSION['adminData']['id'] . "'";
                                $driver_result11  = $db->query($user_sql11);
                                $total_driver11   = $driver_result11->num_rows;
                                ?>
                                <h2 class="color-white mb-5"><?php echo $total_driver11; ?></h2>
                                <span>Assign Driver</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-6">
                        <div class="r4_counter db_box has-gradient-to-right-bottom">
                            <div class="icon-after cc fa fa-file-text-o"></div>
                            <i class="pull-left icon-md icon-white mt-20 fa fa-file-text-o"></i>
                            <div class="stats">
                                <h2 class="color-white mb-5"><?php echo $total_driver1 - $total_driver11; ?></h2>
                                <span>Unassign Driver</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <section class="box has-border-left-3">
                            <header class="panel_header">
                                <h2 class="title pull-left">Latest Drivers</h2>
                                <div class="actions panel_actions pull-right">
                                    <a href="add-drivers.php" class="btn btn-primary btn-corner btn-sm">View All</a>
                                </div>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable no-footer">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Sr #</th>
                                                        <th class="text-center">Image</th>
                                                        <th class="text-center">Full Name</th>
                                                        <!--<th class="text-center">Email Address</th>-->
                                                        <th class="text-center">State</th>
                                                        <th class="text-center">City</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $manageEvent = "SELECT dd.id as dID,dd.fullname,dd.email,dd.status AS driver_status,dd1.* FROM tbl_driverdata as dd left join tbl_driverdetails as dd1 on dd1.driver_id=dd.id where dd.company_id='" . $_SESSION['adminData']['id'] . "' and dd.type='company' ORDER BY dd.id DESC LIMIT 10";
                                                    $resultManageEvent    = $db->query($manageEvent);
                                                    if ($resultManageEvent->num_rows > 0) {
                                                        $count = 1;
                                                        while ($dataManageEvent = $resultManageEvent->fetch_assoc()) {
                                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $count++ ?></td>
                                                        <td class="text-center">
                                                            <?php if ($dataManageEvent['photo'] == "") { ?><img
                                                                class="img-circle img-user"
                                                                src="<?php echo NOUSERIMAGE; ?>"
                                                                alt=""><?php } else { ?><img class="img-circle img-user"
                                                                src="<?php echo ADMINROOT . 'uploadDriverImage/' . $dataManageEvent['photo']; ?>"
                                                                alt="" /><?php } ?></td>
                                                        <td class="text-center"><?php if ($dataManageEvent['fullname'] == "") {
                                                                                                    echo "-";
                                                                                                } else {
                                                                                                    echo $dataManageEvent['fullname'];
                                                                                                } ?></td>
                                                        <!--<td class="text-center"><?php if ($dataManageEvent['email'] == "") {
                                                                                                        echo "-";
                                                                                                    } else {
                                                                                                        echo $dataManageEvent['email'];
                                                                                                    } ?></td>-->
                                                        <td class="text-center"><?php if ($dataManageEvent['state'] == "") {
                                                                                                    echo "-";
                                                                                                } else {
                                                                                                    echo $dataManageEvent['state'];
                                                                                                } ?></td>
                                                        <td class="text-center"><?php if ($dataManageEvent['city'] == "") {
                                                                                                    echo "-";
                                                                                                } else {
                                                                                                    echo $dataManageEvent['city'];
                                                                                                } ?></td>
                                                    </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <section class="box has-border-left-3">
                            <header class="panel_header">
                                <h2 class="title pull-left">Latest Vehicle</h2>
                                <div class="actions panel_actions pull-right">
                                    <a href="add-vehicle.php" class="btn btn-primary btn-corner btn-sm">View All</a>
                                </div>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped dataTable no-footer">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Sr #</th>
                                                        <th class="text-center">Image</th>
                                                        <th class="text-center">Vehicle Name</th>
                                                        <th class="text-center">Vehicle Type</th>
                                                        <th class="text-center">Capacity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $manageEvent = "SELECT * FROM tbl_driver_vehicle where company_id='" . $_SESSION['adminData']['id'] . "' ORDER BY id DESC LIMIT 10";
                                                    $resultManageEvent    = $db->query($manageEvent);
                                                    if ($resultManageEvent->num_rows > 0) {
                                                        $count = 1;
                                                        while ($dataManageEvent = $resultManageEvent->fetch_assoc()) {
                                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $count++ ?></td>
                                                        <td class="text-center">
                                                            <?php if ($dataManageEvent['vehicle_profile'] == "") { ?><img
                                                                class="img-circle img-user"
                                                                src="<?php echo NOUSERIMAGE; ?>"
                                                                alt=""><?php } else { ?><img class="img-circle img-user"
                                                                src="<?php echo ADMINROOT . 'uploadVehicle/' . $dataManageEvent['vehicle_profile']; ?>"
                                                                alt="" /><?php } ?></td>
                                                        <td class="text-center"><?php if ($dataManageEvent['vehicle_name'] == "") {
                                                                                                    echo "-";
                                                                                                } else {
                                                                                                    echo $dataManageEvent['vehicle_name'];
                                                                                                } ?></td>
                                                        <td class="text-center"><?php if ($dataManageEvent['vehicle_type'] == "") {
                                                                                                    echo "-";
                                                                                                } else {
                                                                                                    echo $dataManageEvent['vehicle_type'];
                                                                                                } ?></td>
                                                        <td class="text-center"><?php if ($dataManageEvent['seats'] == "") {
                                                                                                    echo "-";
                                                                                                } else {
                                                                                                    echo $dataManageEvent['seats'];
                                                                                                } ?></td>
                                                    </tr>
                                                    <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- content area :: end -->
</div>
<!-- main-container :: end -->
<!-- js -->
<?php include 'admin-footer.php'; ?>