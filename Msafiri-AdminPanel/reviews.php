<?php 
$pageName = 'reviews';
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
                        <h1 class="title">Reviews</h1>
                    </div>
                    <!-- <div class="pull-right">
                        <div class="right-tools">
                            <a href="javascript:void();" class="btn btn-primary"><i class="fa fa-download"></i> Download CSV</a>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <section class="box has-border-left-3">
                    <!-- <header class="panel_header">
                        <h2 class="title pull-left">Reviews List</h2>
                    </header> -->
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-small-font no-mb table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">Sr #</th>
                                                <th class="text-left">Ride Id</th>
                                                <th class="text-left">Driver Name</th>
                                                <th class="text-left">Rider Name</th>
                                                <th class="no-sort">Rate</th>
                                                <th>Date</th>
                                                <th class="no-sort">Comment</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $selectUser = "SELECT t1.*,t2.fname,t2.lname,t3.fullname from tbl_user_trips as t1 INNER JOIN tbl_userdata as t2 ON t1.user_id=t2.id INNER JOIN tbl_driverdata as t3 ON t1.driver_id=t3.id WHERE t1.status = 'completed'";
                                            $resultselectUser = $db->query($selectUser);
                                            if($resultselectUser->num_rows > 0){
                                                $count = 1;
                                            while ($dataselectUser = $resultselectUser->fetch_assoc()) { ?>
                                            <tr>
                                                <th class="text-center"><?php echo $count++;?></th>
                                                <td>RIDE00<?php echo $dataselectUser['trip_id']; ?></td>
                                                <td><?php echo $dataselectUser['fullname'];?></td>
                                                <td class="text-center" ><?php echo $dataselectUser['fname']." ".$dataselectUser['lname'];?></td>
                                                <td class="text-center"><?php echo $dataselectUser['rating'];?></td>
                                                <td class="text-center"><?php echo date_format(date_create($dataselectUser['created_date']),"F d,Y");?></td>
                                                <td class="text-center"><?php echo $dataselectUser['comments'];?>
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
                     columns: [ 0 ,1 , 2, 3, 4, 5, 6]
                }
            }
        ],
        select: true
    } );
} );
</script>