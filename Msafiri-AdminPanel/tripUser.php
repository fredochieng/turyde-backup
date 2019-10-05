<?php 
$pageName = 'trips';
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
                        <h1 class="title">Trip Users List</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <a href="javascript:history.go(-1)" class="btn btn-primary"> Back</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <section class="box has-border-left-3">
                    <header class="panel_header">
                        <h2 class="title pull-left">User List</h2>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="table-1" class="table table-small-font no-mb table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">Sr #</th>
                                                <th class="text-left">Trip Id</th>
                                                <th class="text-left">Rider Name</th>
                                                <th class="text-left">Rider Email</th>
                                                <th class="no-sort">Contact</th>
                                                <th>Ratting</th>
                                                <th class="no-sort">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $selectUser = "SELECT t1.*,t2.fname,t2.lname,t2.user_email,t2.mobile_number FROM tbl_user_trips as t1 INNER JOIN tbl_userdata as t2 ON t1.user_id=t2.id WHERE t1.trip_id = '".$_GET['trip_id']."'";
                                            $resultselectUser = $db->query($selectUser);
                                            if($resultselectUser->num_rows > 0){
                                                $count = 1;
                                            while ($dataselectUser = $resultselectUser->fetch_assoc()) { ?>
                                            <tr>
                                                <th class="text-center"><?php echo $count++;?></th>
                                                <td>TRIPID0<?php echo $dataselectUser['trip_id']; ?></td>
                                                <td class="text-center" ><?php echo $dataselectUser['fname']." ".$dataselectUser['lname'];?></td>
                                                <td class="text-center"><?php echo $dataselectUser['user_email'];?></td>
                                                <td class="text-center"><?php echo $dataselectUser['mobile_number'];?></td>
                                                <td class="text-center"><?php echo $dataselectUser['rating'];?></td>
                                                <td class="text-center"><?php echo date_format(date_create($dataselectUser['datetime']),"F d,Y");?></td>
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
