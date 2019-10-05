<html>
	<body>
		<?php include("layout/header.php");?>
			
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
        <?php include('layout/footer.php');?>
    </body>
</html>
<script>
/*$(document).ready(function() {
    $('#allVehicleDatatables').DataTable( {
        "ajax": {
            "url": "php/getAllVehicleData.php",
            "dataSrc": ""
        },
        "columns": [
            { "data": "driver_name" },
            { "data": "contact_no" },
            { "data": "car_type" },
            { "data": "model_name" },
            { "data": "plate_no" }
        ]
    } );
	
	$('#allVehicleDatatables').dataTable({
     "bProcessing": true,
     "bServerSide": true,
     "ajax": {
            "url": "php/getAllVehicleData.php",
            "dataSrc": ""
        },
		"columns": [
			
            { "data": "driver_name" },
            { "data": "contact_no" },
            { "data": "car_type" },
            { "data": "model_name" },
            { "data": "plate_no" }
        ],
     "fnRowCallback": function( nRow, data, iDisplayIndex ) {
            $('td:eq(0)', nRow).html('<a href="vehicle-detail.php?comic=' + data.id+ '">' +
                data.id + '</a>');
            return nRow;
        },
	  });
} );*/

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