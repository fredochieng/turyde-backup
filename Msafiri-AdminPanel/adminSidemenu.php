<!--sidebar :: start -->
<div class="page-sidebar fixedscroll">
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">
        <ul class='wraplist'>
            <li class="<?php if(isset($pageName) && $pageName == 'dashboard'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>index.php">
                    <i class="fa flaticon-dashboard"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'userlist'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>userList.php">
                    <i class="fa flaticon-multiple-users-silhouette"></i>
                    <span class="title">Users</span>
                </a>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'driverlist'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>driverList.php">
                    <i class="fa flaticon-driver"></i>
                    <span class="title">Drivers</span>
                </a>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'mechaniclist'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>mechanicList.php">
                    <i class="fa flaticon-car-with-wrench"></i>
                    <span class="title">Mechanic</span>
                </a>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'company'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>companyList.php">
                    <i class="fa fa-building"></i>
                    <span class="title">Company</span>
                </a>
            </li -->
            <li class="<?php if(isset($pageName) && $pageName == 'location'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>locations.php">
                    <i class="fa flaticon-gps"></i>
                    <span class="title">Locations</span>
                </a>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'trips'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>trips.php">
                    <i class="fa flaticon-gps"></i>
                    <span class="title">Trips</span>
                </a>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'addprice'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>addTrip_price.php">
                    <i class="fa flaticon-gps"></i>
                    <span class="title">Trip Price</span>
                </a>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'reports'){echo "open";}else{}?>"> 
                <a href="javascript:;">
                    <i class="fa flaticon-progress-report"></i>
                    <span class="title">Reports</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu" >
                    <li style="pointer-events: none;">
                        <a class="<?php if(isset($subpageName) && $subpageName == 'payment-report'){echo "active";}else{}?>" href="<?php echo ADMINROOT;?>payment-report.php" >Payment Report</a>
                    </li>
                    <li style="pointer-events: none;">
                        <a class="<?php if(isset($subpageName) && $subpageName == 'driver-payment-report'){echo "active";}else{}?>" href="<?php echo ADMINROOT;?>driver-payment-report.php" >Driver Payment Report</a>
                    </li>
                    <li>
                        <a class="<?php if(isset($subpageName) && $subpageName == 'cancelled-trip'){echo "active";}else{}?>" href="<?php echo ADMINROOT;?>cancelled-trip.php" >Cancelled Trip</a>
                    </li>
                    <li>
                        <a class="<?php if(isset($subpageName) && $subpageName == 'ride-acceptance-report'){echo "active";}else{}?>" href="<?php echo ADMINROOT;?>ride-acceptance-report.php" >Driver Trips Count</a>
                    </li>
                    <li>
                        <a class="<?php if(isset($subpageName) && $subpageName == 'trip-time-variance'){echo "active";}else{}?>" href="<?php echo ADMINROOT;?>trip-time-variance.php" >Trip Time Variance</a>
                    </li>
                    <li>
                        <a class="<?php if(isset($subpageName) && $subpageName == 'driver-log-report'){echo "active";}else{}?>" href="<?php echo ADMINROOT;?>driver-log-report.php" >Driver Log Report</a>
                    </li>
                </ul>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'mechanic-report'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>mechanic-report.php">
                    <i class="fa flaticon-progress-report"></i>
                    <span class="title">Mechanic Report</span>
                </a>
            </li>
            <li class="<?php if(isset($pageName) && $pageName == 'reviews'){echo "open";}else{}?>">
                <a href="<?php echo ADMINROOT;?>reviews.php">
                    <i class="fa flaticon-review"></i>
                    <span class="title">Reviews</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- sidebar :: end