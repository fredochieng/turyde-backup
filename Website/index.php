
<style>
   .ui-widget-header,.ui-state-default, ui-button {
    <!--background:#b9cd6d;-->
     border: 1px solid #b9cd6d;
      color: #FFFFFF;
      font-weight: bold;
    }
</style>
<html>
	<body>
		<?php include("layout/header.php");?>
			
            <div class="container-fluid">
                <div class="inner-contain">
                    <div class="row">
                        <div class="col-md-12">
						<div id="alert-danger" name="alert-danger" style="color: red;"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-area">
                                        <a href="add-vehicle.php" class="card-title">
                                            <span>Add Vehicle</span>
                                            <i class="fa fa-car"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-area">
                                        <a href="vehicle-list.php" class="card-title">
                                            <span>Vehicle List</span>
                                            <i class="fa fa-list"></i>    
                                        </a>
                                    </div>
									
                                </div>
                            </div>
							<div id="welcome"></div>
                            <div class="container-fluid">
                                <div class="inner-contain">
                                    <div class="card card-box">
                                        <div class="card-head">
                                            <div class="box-header">Vehicle List</div>
                                            <div class="tools">
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="list-area">
                                               <table id="allVehicleDatatables" class="table table-striped table-bordered example1_wrapper" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Driver Name</th>
                                                        <th>Contact No.</th>
                                                        <th>Car Type</th>
                                                        <th>Model Name</th>
                                                        <th>Plate No.</th>
                                                        <th> Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>                  
                                                </tbody>
                                                </table>                      
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <div class="col-md-6 offset-md-3">
									<div class="form-group">
                                        <input type="text" class="form-control" id= "VehicleId">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id= "driver_name_new" placeholder="Driver Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="contact_no_new" placeholder="Contact No.">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="car_type_new" placeholder="Car Type">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="model_no_new" placeholder="Model No.">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="plate_no_new" placeholder="Plate No.">
                                    </div>
                                    <div class="form-group text-center">
                                        <a href="#" class="btn btn-primary" onclick='updateVehicle();'>Submit</a>
                                        <a href="#" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<?php include('layout/footer.php');?>
<script>
    $(document).ready(function() {
var id = "<?php echo $_SESSION['id']; ?>";
    $('#allVehicleDatatables').DataTable( {
        "ajax": {
            "url": "php/getAllVehicleData.php",
            "data": function ( d ) {
                d.id = id;
                // d.custom = $('#myInput').val();
                // etc
            },
            "dataSrc": ""
        },
        "columns": [
            { "data": "driver_name" },
            { "data": "contact_no" },
            { "data": "car_type" },
            { "data": "model_name" },
            { "data": "plate_no" },
            {                      
                "render": function (data, type, row, meta) {
                var id = row.id;
                var val = encodeURIComponent('comic='+id+'');
                console.log(val);

                //console.log(uri_dec);
                return '<a class="btn btn-primary" href="vehicle-detail.php?comic='+id+'">View</a>';
                //return '<a href="vehicle-detail.php?'+val+'">View</a>';
                    }
                }
        ],
  });
} );
</script>
</body>
</html>



	