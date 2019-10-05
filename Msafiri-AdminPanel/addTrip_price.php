<?php 
$pageName = 'addprice';
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
                        <h1 class="title">Locations based Price list</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <button type="button" class="btn btn-primary" data-toggle='modal' data-target='#myModalNew'>New Location Price</button>
                        </div>
                    </div>
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
                                    <table id="table-1" class="table table-small-font no-mb table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="no-sort">Sr #</th>
                                                <th>Price Type</th>
                                                <th class="no-sort">From Title</th>
                                                <th class="no-sort">To Title</th>
                                                <th>Price</th>
                                                <!-- <th>Status</th> -->
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $selectUser = "SELECT * FROM `tbl_new_trip_price`  ORDER BY `price_id` DESC";
                                            $resultselectUser = $db->query($selectUser);
                                            if($resultselectUser->num_rows > 0){
                                                $count = 1;
                                            while ($dataselectUser = $resultselectUser->fetch_assoc()) { ?>
                                            <tr>
                                                <th class="text-center"><?php echo $count++;?></th>
                                                <td><?php echo ucfirst($dataselectUser['type']); ?></td>
                                                <td><?php echo $dataselectUser['from_address']; ?></td>
                                                <td><?php echo $dataselectUser['to_address'];?></td>
                                                <td><strong><?php echo $dataselectUser['price'];?></strong></td>
                                                <!-- <td class="text-center">
                                                <select style="border: 1px solid #ccc;background-color: white;border-radius: 500px;" class="selectID" id="<?php echo $dataselectUser['id'];?>">
                                                    <option value="active" <?php if($dataselectUser['status'] == 'active'){ echo 'selected';}?>>Active</option>
                                                    <option value="deactive" <?php if($dataselectUser['status'] == 'deactive'){ echo 'selected';}?>>Deactive</option>
                                                </select></td> -->
                                                <td class="text-center">
                                                    <!-- <a href="driver-details.php?u-ID=<?php echo base64_encode($dataselectUser['id'])?>" class="btn btn-success btn-sm btn-corner-little"><i class="fa fa-eye"></i></a> -->
                                                    <a href="#" class="btn btn-danger btn-sm btn-corner-little"><i class="fa fa-trash " onclick='deleteLocation(<?php echo $dataselectUser['price_id'];?>);'></i></a>
                                                    <!-- <input type='button' value='Delete' /> -->
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
<div class="modal fade" id="myModalNew" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" id="editDetails">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Location</h4>
        </div>
        <div class="modal-body">
            <table >
            <div class="form-group">
              <select class="form-control" name="type" id="type">
                <option value="">Select Price Type</option>
                  <option value="fixed">Fixed</option>
                  <option value="per_distance">Price / kilometer</option>
              </select>
            </div>
            <div class="form-group">
              <!-- <label for="userid">Address:</label> -->
              <select class="form-control" id="from_address">
                  <option value="">Select From Location</option>
                  <?php
                $selectlocation1 = "SELECT * FROM `tbl_location` WHERE `status` = 'active'";
                $resultLocation1 = $db->query($selectlocation1);
                if($resultLocation1->num_rows > 0){
                    $count = 1;
                while ($dataLocation1 = $resultLocation1->fetch_assoc()) { ?>
                  <option value="<?php echo $dataLocation1['address'];?>"><?php echo $dataLocation1['address'];?></option>
              <?php } } ?>
              </select>
              
            </div>
            <div class="form-group">
              <!-- <label for="userid">Address:</label> -->
              <select class="form-control" id="to_address">
                <option value="">Select To Location</option>
                <?php
                $selectlocation2 = "SELECT * FROM `tbl_location` WHERE `status` = 'active'";
                $resultLocation2 = $db->query($selectlocation2);
                if($resultLocation2->num_rows > 0){
                    $count = 1;
                while ($dataLocation2 = $resultLocation2->fetch_assoc()) { ?>
                  <option value="<?php echo $dataLocation2['address'];?>"><?php echo $dataLocation2['address'];?></option>
              <?php } } ?>
              </select>
            </div>
            <div class="form-group">
              <!-- <label for="userid">Address:</label> -->
              <input type="text" class="form-control" id="add_price" placeholder="Add price" autocomplete="no">
            </div>
            
            </table>     
        </div>
        <div class="modal-footer">
          <span class="btn btn-primary" id="save">Save</span>
        </div>
      </div>
      
    </div>
  </div>
<!-- main-container :: end -->
<?php require_once 'adminFooter.php';?>
<script>
$('#save').on('click', function (e) {
    var from_address = $("#from_address").val();
    var to_address = $("#to_address").val();
    var add_price = $("#add_price").val();
    var type = $("#type").val();

    if(from_address=="" || to_address=="" || add_price=="" || type == ""){
        alert('All fields are required');
        return false;
    }else{
        /* Ajax call to insert data into database */
        $.ajax({
                url: "ajax/insertTrip_price.php",
                method: 'post',
                data: {
                type:type,
                from_address: from_address,
                to_address: to_address,
                add_price: add_price
            },
            success: function(data){
            if(data == 'exist'){
                alert('Data already exist.');
            } 
            else{
                alert('Record added successfully.');
            }
            // What to do if we succeed
            window.location='addTrip_price.php';
            },
            error: function(jqXHR, textStatus, errorThrown) {
                    alert(textStatus);// What to do if we fail
                        console.log(textStatus);
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
        //                 console.log(textStatus);
        //                 console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
        //     }
        // });
    }
});
</script>
<script>
function deleteLocation(id){
    if(confirm("Are you sure you want to delete?"))
    {
        $.ajax({
                url: "ajax/deleteTrip_price.php",
                method: 'post',
                data: {
                id:id
            },
            success: function(data){ // What to do if we succeed
                alert(data);
                window.location='addTrip_price.php';                  },
            error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
                    console.log(textStatus);
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        }); 
    }
    else
    {
      return false; 
    }
}
</script>
