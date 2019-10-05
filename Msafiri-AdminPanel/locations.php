<?php 
$pageName = 'location';
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
                        <h1 class="title">Locations</h1>
                    </div>
                    <div class="pull-right">
                        <div class="right-tools">
                            <button type="button" class="btn btn-primary" data-toggle='modal' data-target='#myModalNew'>New Location</button>
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
                                                <th class="no-sort">Address</th>
                                                <th class="no-sort">Latitude</th>
                                                <th class="no-sort">Longitude</th>
                                                <th>Status</th>
                                                <th class="no-sort">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $selectUser = "SELECT * FROM `tbl_location`";
                                            $resultselectUser = $db->query($selectUser);
                                            if($resultselectUser->num_rows > 0){
                                                $count = 1;
                                            while ($dataselectUser = $resultselectUser->fetch_assoc()) { ?>
                                            <tr>
                                                <th class="text-center"><?php echo $count++;?></th>
                                                <td><?php echo $dataselectUser['address']; ?></td>
                                                <td><?php echo $dataselectUser['latitude'];?></td>
                                                <td class="text-center"><?php echo $dataselectUser['longitude'];?></td>
                                                <td class="text-center">
                                                <select style="border: 1px solid #ccc;background-color: white;border-radius: 500px;" class="selectID" id="<?php echo $dataselectUser['id'];?>">
                                                    <option value="active" <?php if($dataselectUser['status'] == 'active'){ echo 'selected';}?>>Active</option>
                                                    <option value="deactive" <?php if($dataselectUser['status'] == 'deactive'){ echo 'selected';}?>>Deactive</option>
                                                </select></td>
                                                <td class="text-center">
                                                    <!-- <a href="driver-details.php?u-ID=<?php echo base64_encode($dataselectUser['id'])?>" class="btn btn-success btn-sm btn-corner-little"><i class="fa fa-eye"></i></a> -->
                                                    <a href="#" class="btn btn-danger btn-sm btn-corner-little"><i class="fa fa-trash " onclick='deleteLocation(<?php echo $dataselectUser['id'];?>);'></i></a>
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
              <!-- <label for="userid">Address:</label> -->
              <input type="text" class="form-control" id="address" placeholder="Enter Address" >
            </div>
             
            </table>     
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="save" onclick='geoCode();'>Save</button>
        </div>
      </div>
      
    </div>
  </div>
<!-- main-container :: end -->
<?php require_once 'adminFooter.php';?>
<script>
    $(document).on('click', '.delete', function(){
    var driver_id = $(this).attr("id");
    if(confirm("Are you sure you want to delete this?"))
    {
      $.ajax({
        url:"ajax/ajax_delete.php",
        method:"POST",
        data:{driver_id:driver_id,action:'driverDelete'},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>driverList.php");
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
    var locationStatus = this.value;
    if(confirm("Are you sure you want to change status?"))
    {
      $.ajax({
        url:"ajax/changeStatus.php",
        method:"POST",
        data:{locationStatus:locationStatus , sid:sid},
        success:function(data)
        {
          //alert(data);
          window.location.replace("<?php echo ADMINROOT;?>locations.php");
        }
      });
    }
    else
    {
      return false; 
    }
});
</script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAF9GH9ZPJeI5rtJGUaEUV7Dyfbtdjc2NI&libraries=places&language=en-AU"></script>
<script>
    var autocomplete = new google.maps.places.Autocomplete($("#address")[0], {});

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();
        console.log(place.address_components);
    });
</script>
<script>
function geoCode(){
var location = $("#address").val(); 
var param = {address: location, key: 'AIzaSyAF9GH9ZPJeI5rtJGUaEUV7Dyfbtdjc2NI '};
$.ajax({
  url: 'https://maps.googleapis.com/maps/api/geocode/json',
   data:param, 
  success: function(response) {
    console.log(response);
    var address = response.results[0].formatted_address; 
    var lat = response.results[0].geometry.location.lat;
    var lng = response.results[0].geometry.location.lng;
    console.log(lat);
    /* Ajax call to insert data into database */
                $.ajax({
                            url: "ajax/insertGeometry.php",
                            method: 'get',
                            data: {
                            address: address,
                            lat: lat,
                            lng: lng
                      },
                    success: function(data){
                    if(data == 'exist'){
                        alert('Location already exist.');
                    } 
                    else{
                        alert('Location added successfully.');
                    }
                     // What to do if we succeed
                    window.location='locations.php';
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                            alert(textStatus);// What to do if we fail
                                console.log(textStatus);
                                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });
  },
                    error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
                                console.log(textStatus);
                                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
});
}
function deleteLocation(id){
    if(confirm("Are you sure you want to delete?"))
    {
        $.ajax({
                url: "ajax/deleteLocation.php",
                method: 'post',
                data: {
                id:id
            },
            success: function(data){ // What to do if we succeed    
            window.location='locations.php';                  },
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