<?php 
$pageName = 'userlist';
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
                        <h1 class="title">Users List</h1>
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
                                                <th class="no-sort">Image</th>
                                                <th class="text-left">Fullname</th>
                                                <th class="no-sort">Email</th>
                                                <th class="no-sort">Phone</th>
                                                <th>Gender</th>
                                                <th>Joined Date</th>
                                                <th class="text-center" style="display: none;">Status</th>
                                                <th>Status</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $selectUser = "SELECT * FROM `tbl_userdata`";
                                            $resultselectUser = $db->query($selectUser);
                                            if($resultselectUser->num_rows > 0){
                                                $count = 1;
                                            while ($dataselectUser = $resultselectUser->fetch_assoc()) { ?>
                                            <tr>
                                                <th class="text-center"><?php echo $count++;?></th>
                                                <td class="text-center">
                                                <?php
                                                if($dataselectUser['photo'] == "" || $dataselectUser['photo'] == "no_profile.png"){?>
                                                    <img class="img-circle img-user" src="<?php echo NOUSERIMAGE;?>" alt=""/>

                                                <?php }else {?>
                                                    <img class="img-circle img-user" src="<?php echo APIROOT.'user_uploads/'.$dataselectUser['id'].'/'.$dataselectUser['photo'];?>" alt=""/>

                                                <?php } ?>
                                                </td>
                                                <td><?php echo $dataselectUser['fname'].' '.$dataselectUser['lname']; ?></td>
                                                <td><?php echo $dataselectUser['user_email'];?></td>
                                                <td class="text-center" ><?php if($dataselectUser['mobile_number'] == ""){ echo "-";}else{echo $dataselectUser['mobile_number'];}?></td>
                                                <td class="text-center"><?php echo $dataselectUser['gender'];?></td>
                                                <td class="text-center"><?php echo date_format(date_create($dataselectUser['created_date']),"F d,Y");?></td>
                                                <td style="display: none;"><?php echo $dataselectUser['status'];?></td>
                                                <td class="text-center">
                                                <select style="border: 1px solid #ccc;background-color: white;border-radius: 500px;" class="selectID" id="<?php echo $dataselectUser['id'];?>">
                                                    <option value="active" <?php if($dataselectUser['status'] == 'active'){ echo 'selected';}?>>Active</option>
                                                    <option value="deactive" <?php if($dataselectUser['status'] == 'deactive'){ echo 'selected';}?>>Deactive</option>
                                                </select></td>
                                                <td class="text-center">
                                                    <a href="user-details.php?u-ID=<?php echo base64_encode($dataselectUser['id'])?>" class="btn btn-success btn-sm btn-corner-little"><i class="fa fa-eye"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm btn-corner-little delete" id="<?php echo $dataselectUser['id'];?>"><i class="fa fa-trash"></i></a>
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
    $(document).on('click', '.delete', function(){
    var user_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"ajax/ajax_delete.php",
        method:"POST",
        data:{user_id:user_id,action:'userDelete'},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>userList.php");
        }
      });
    }
    else
    {
      return false; 
    }
  });
</script>
<script>
//searchText is a input type text
$('.selectID').on('change', function (e) {
    var sid = $(this).attr("id");
    var optionSelected = $("option:selected", this);
    var userStatus = this.value;
    if(confirm("Are you sure you want to change status?"))
    {
      $.ajax({
        url:"ajax/changeStatus.php",
        method:"POST",
        data:{userStatus:userStatus , sid:sid},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>userList.php");
        }
      });
    }
    else
    {
      return false; 
    }
});
</script>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                     columns: [ 0, 2, 3, 4, 5, 6, 7]
                }
            }
        ],
        select: true
    } );
} );
</script>
<!-- <script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: 'Excel',
                exportOptions: {
                     columns: [ 0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 13]
                }
            }
        ],
        select: true
    } );
} );
</script> -->