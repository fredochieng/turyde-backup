<?php
$pageName = 'add-drivers';
include 'admin-header.php'; ?>
<!-- main-container :: start -->
<div class="page-container row-fluid container-fluid">
    <?php include 'admin-sidebar.php'; ?>
    <section id="main-content" class=" ">
        <div class="wrapper main-wrapper row" style=''>
            <div class='col-xs-12'>
                <div class="page-title">
                    <div class="pull-left">
                        <h1 class="title">Add Drivers</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <a href="add-new-driver.php" class="btn btn-primary"><i class="fa fa-plus"></i> <span>Add New Driver</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-lg-12">
                <section class="box has-border-left-3">
                    <header class="panel_header">
                        <h2 class="title pull-left">Drivers List</h2>
                    </header>
                    <div class="content-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="table-responsive">
                                    <div id="alert-danger"></div>
                                    <table id="driverDatatables" class="table table-small-font no-mb table-bordered table-striped data_table">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">Sr #</th>
                                                <th class="no-sort">Image</th>
                                                <th class="text-left">Full Name</th>
                                                <th class="text-left">Email Address</th>
                                                <th class="text-left">Mobile Number</th>
                                                <th class="text-left">State</th>
                                                <th class="text-left">City</th>
                                                <th class="text-center no-sort">Status</th>
                                                <th class="text-center no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $manageEvent = "SELECT dd.id as dID,dd.fullname,dd.email,dd.status AS driver_status,dd1.* FROM tbl_driverdata as dd left join tbl_driverdetails as dd1 on dd1.driver_id=dd.id where dd.company_id='" . $_SESSION['adminData']['id'] . "' and dd.type='company' ORDER BY dd.id DESC";
                                            $resultManageEvent    = $db->query($manageEvent);
                                            if ($resultManageEvent->num_rows > 0) {
                                                $count = 1;
                                                while ($dataManageEvent = $resultManageEvent->fetch_assoc()) {
                                                    $sDirPath = DRIVERUPLOADS . $dataManageEvent['dID'] . '/';
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $count++ ?></td>
                                                        <td class="text-center"><?php if ($dataManageEvent['photo'] == "") { ?><img class="img-circle img-user" src="<?php echo NOUSERIMAGE; ?>" alt=""><?php } else { ?><img class="img-circle img-user" src="<?php echo $sDirPath . $dataManageEvent['photo']; ?>" alt="" /><?php } ?></td>
                                                        <td><?php if ($dataManageEvent['fullname'] == "") {
                                                                        echo "-";
                                                                    } else {
                                                                        echo $dataManageEvent['fullname'];
                                                                    } ?></td>
                                                        <td><?php if ($dataManageEvent['email'] == "") {
                                                                        echo "-";
                                                                    } else {
                                                                        echo $dataManageEvent['email'];
                                                                    } ?></td>
                                                        <td><?php if ($dataManageEvent['mobile_number'] == "") {
                                                                        echo "-";
                                                                    } else {
                                                                        echo $dataManageEvent['mobile_number'];
                                                                    } ?></td>
                                                        <td><?php if ($dataManageEvent['state'] == "") {
                                                                        echo "-";
                                                                    } else {
                                                                        echo $dataManageEvent['state'];
                                                                    } ?></td>
                                                        <td><?php if ($dataManageEvent['city'] == "") {
                                                                        echo "-";
                                                                    } else {
                                                                        echo $dataManageEvent['city'];
                                                                    } ?></td>
                                                        <td class="text-center">
                                                            <select style="border: 1px solid #ccc;background-color: white;border-radius: 500px;" class="statusID" id="<?php echo $dataManageEvent['dID']; ?>">
                                                                <option value="active" <?php if ($dataManageEvent['driver_status'] == 'active') {
                                                                                                    echo 'selected';
                                                                                                } ?>>Active</option>
                                                                <option value="deactive" <?php if ($dataManageEvent['driver_status'] == 'deactive') {
                                                                                                        echo 'selected';
                                                                                                    } ?>>Deactive</option>
                                                            </select>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="add-new-driver.php?d-ID=<?php echo base64_encode($dataManageEvent['dID']) ?>" id="<?php echo $dataManageEvent['dID']; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                                            <a href="view-add-drivers.php?d-ID=<?php echo base64_encode($dataManageEvent['dID']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a>
                                                            <a href="#" class="btn btn-danger btn-sm delete" id="<?php echo $dataManageEvent['dID']; ?>"><i class="fa fa-trash"></i></a>
                                                        </td>
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
    </section>
    <!-- content area :: end -->
</div>
<!-- Modal -->
<?php include 'admin-footer.php'; ?>
<script>
    //searchText is a input type text
    $('.statusID').on('change', function(e) {
        var sid = $(this).attr("id");
        var optionSelected = $("option:selected", this);
        var driverStatus = this.value;
        if (confirm("Are you sure you want to change status?")) {
            $.ajax({
                url: "php/changeStatus.php",
                method: "POST",
                data: {
                    driverStatus: driverStatus,
                    sid: sid
                },
                success: function(data) {
                    //alert(data);
                    window.location.replace("<?php echo ADMINROOT; ?>add-drivers.php");
                }
            });
        } else {
            return false;
        }
    });
    $(document).on('click', '.delete', function() {
        var driver_id = $(this).attr("id");
        if (confirm("Are you sure you want to delete this?")) {
            $.ajax({
                url: "php/ajaxDelete.php",
                method: "POST",
                data: {
                    driver_id: driver_id,
                    action: 'driverDelete'
                },
                success: function(data) {
                    //alert(data);
                    window.location.replace("<?php echo ADMINROOT; ?>add-drivers.php");
                }
            });
        } else {
            return false;
        }
    });
</script>