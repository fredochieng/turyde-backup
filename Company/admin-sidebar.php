<div class="page-container row-fluid container-fluid">
<!-- sidebar :: start -->
<div class="page-sidebar fixedscroll">
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">
        <ul class='wraplist'>
            <li class="<?php if (isset($pageName) && $pageName == 'dashboard') { echo 'open';}?>">
                <a href="dashboard.php">
                    <i class="fa flaticon-dashboard"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="<?php if (isset($pageName) && $pageName == 'add-drivers') { echo 'open';}?>">
                <a href="add-drivers.php">
                    <i class="fa flaticon-driver"></i>
                    <span class="title">Add Drivers</span>
                </a>
            </li>
            <li class="<?php if (isset($pageName) && $pageName == 'add-vehicle') { echo 'open';}?>">
                <a href="add-vehicle.php">
                    <i class="fa flaticon-car-steering-wheel"></i>
                    <span class="title">Add Vehicle</span>
                </a>
            </li>
            <li class="<?php if (isset($pageName) && $pageName == 'assign-drivers') { echo 'open';}?>">
                <a href="assign-drivers.php">
                    <i class="fa flaticon-driver"></i>
                    <span class="title">Assign Drivers</span>
                </a>
            </li>
            <li class="<?php if (isset($pageName) && $pageName == 'add-route') { echo 'open';}?>">
                <a href="add-route.php">
                    <i class="fa flaticon-gps"></i>
                    <span class="title">Add Route</span>
                </a>
            </li>
            <li class="<?php if (isset($pageName) && $pageName == 'reports') { echo 'open';}?>"> 
                <a href="javascript:;">
                    <i class="fa flaticon-progress-report"></i>
                    <span class="title">Reports</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" >
                   <!--  <li>
                        <a class="" href="payment-report.php" >Payment Report</a>
                    </li> -->
                    <li>
                        <a class="<?php if(isset($subpageName) && $subpageName == 'driver-payment-report'){echo "active";}else{}?>" href="driver-payment-report.php" >Driver Payment Report</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>