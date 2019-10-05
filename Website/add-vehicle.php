<html>
	<body>
		<?php include("layout/header.php");?>
            <div class="container-fluid">
                <div class="inner-contain">
                    <div class="form-area">
                        <form class="vehicle-form" id="add_repairs">
                            <div class="row">
							<div id="alert-danger" name="alert-danger" style="color: red;"></div>
                                <div class="col-md-6 offset-md-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id= "driver_name" placeholder="Driver Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="contact_no" placeholder="Contact No.">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="car_type" placeholder="Car Type">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="model_no" placeholder="Model No.">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="plate_no" placeholder="Plate No.">
                                    </div>
									<div >
										<div id="dynamic_field" class="col-md-12 row">
                                            Add Repairs
										</div>
										<div>
										<button type="button" name="add" id="add" class="btn-success">Add</button>
										</div>
									</div>
                                    <div class="form-group text-center">
                                        <a href="#" class="btn btn-primary" onclick='addVehicle("<?php echo $_SESSION['id'] ?>");'>Submit</a>
                                        <a href="#" class="btn btn-danger" onclick="CancelAddVehicle();">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include "layout/footer.php";?>
    </body>
</html>
<script>
/* Dynamically Adding Textbox */
$(document).ready(function() {	
		var i=1;
        $('#add').click(function () {
          i++; 
		  $('#dynamic_field').append('<div id="row'+i+'"  class=" form-group col-md-12 row"><div class="col-md-10"><input type="text" name="repairs[]" id="repairs" class="form-control  full-left " placeholder="Add Repair"/></div><div class="col-md-2"><buttion id="'+i+'" name="remove" class=" form-control btn btn-danger btn_remove">X</button></div></div>');
        });
		
		$(document).on('click','.btn_remove',function(){
			var button_id =$(this).attr("id");
			$("#row"+button_id+"").remove();
		});
       
});
</script>