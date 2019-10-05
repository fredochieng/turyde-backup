<html>
	<body>
		<?php include("layout/header.php");?>
        <?php include("php/connection.php");?>
            <div class="container-fluid pad-0">
                <div class="inner-contain">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <div class="list-area">
                                <div class="box-area">Personal Details</div>
                                <ul id="showVehicleDetail">
                                </ul>
                                <div class="box-area">List of Repairs</div>
									<div id="showRepairs">
									</div>
									<div id="alert-danger" style="color: red;"></div>
									<form enctype="multipart/form-data" id="fupForm" >
										<?php 
                                           $id = base64_decode($_GET['comic']);
                                            $sql = "SELECT * FROM tbl_vehicle where id='$id'";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                            $data = $result->fetch_assoc();
                                          
                                            } ?>
										<div class="form-group">
                                            <div class="box-area">Repair Document</div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                     <input type="hidden" name="fileToUploadOld" id="fileToUploadOld" value="<?php echo $data['filename'];?>">
											         <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" accept="image/jpeg,image/gif,image/png,application/pdf,.doc,.docx,application/msword"/>
                                                </div>
                                                <div class="col-md-4">
                                                    <?php if(isset($data['filename']) && $data['filename'] != ''){?>
                                                    <a href="<?php echo ADMINROOT.'upload/'.$data['filename'];?>" download>Download</a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                           <div class="box-area">Invoice</div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                     <input type="hidden" name="fileToUploadOld1" id="fileToUploadOld1" value="<?php echo $data['filename1'];?>">
											         <input type="file" class="form-control" id="fileToUpload1" name="fileToUpload1" accept="image/jpeg,image/gif,image/png,application/pdf,.doc,.docx,application/msword"/>
                                                </div>
                                                 <div class="col-md-4">
                                                    <?php if(isset($data['filename1']) && $data['filename1'] != ''){?>
                                                    <a href="<?php echo ADMINROOT.'upload1/'.$data['filename1'];?>" download>Download</a>
                                                    <?php } ?> 
                                                </div>
                                            </div>
										</div>
										<input type="submit" name="submit" class="btn btn-danger submitBtn" value="SAVE"/>
									</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php include "layout/footer.php";?>
    </body>
</html>
<script>
$(document).ready(function() {
<?php //$id=$_GET['comic'];?>
	var id = "<?php echo base64_decode($_GET['comic']); ?>";
	var mechanic_id = "<?php echo $_SESSION['id']; ?>";
	console.log(id);
	console.log(mechanic_id);
	getVehicleDetails(id);
	
	$("#fupForm").on('submit', function(e){ 
	var formData = new FormData(this);
	formData.append('vehicle_id', id);
	formData.append('mechanic_id', mechanic_id);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'php/fileUpload.php',
            data:formData,
				
				
			
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(msg){
			 $('#alert-danger').empty();
               $('#alert-danger').append('<p><br/>'+msg+'</p>');
				// setTimeout(function(){
								 // document.getElementById("alert-danger").innerHTML="";
								 // },3000);
								
               window.location ="index.php";
                $('#fupForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            },
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
        },'json');
    });
    
    //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });
	
});
</script>

<!-- File UPLOAD -->



