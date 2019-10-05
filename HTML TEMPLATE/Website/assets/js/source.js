/* Forgot Password Sent Email */
function sentLink(){
alert("Hello");
							var email = $('#email').val();
							$.ajax({
							url: "php/sent_link.php",
							method: 'post',
							data: {
							email:email
							
						},
						success: function(data){ // What to do if we succeed
							//$('#tbd').empty();
							//getData(email);
							$('#alert-danger').append('<p><br/>'+data+'</p>');	
							// setTimeout(function(){
								 // document.getElementById("alert-danger").innerHTML="";
								 // },3000);							
							$.each(data.errors, function(key, value){
							$('#alert-danger').append('<p><br/>'+data+'</p>');
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});
}
/* Get Country */
function getDataRegister(){
						$.ajax({
							url: "php/selectCountry.php",
							method: 'post',
							
						success: function(data){ // What to do if we succeed
							//$('#tbd').empty();
							//getData(email);
							//console.log(data);
							var obj = JSON.parse(data);
							$.each(obj, function (index, value) {
								// APPEND OR INSERT DATA TO SELECT ELEMENT.
								$('#country').append('<option value="' + value.id + '">' + value.country + '</option>');
							});	
							$("#country").change(function() {
							 // alert( "Handler for .change() called." );
							  
							  var country = this.options[this.selectedIndex].text;
							 // alert(country);
							  /*select state */
										  $.ajax({
										url: "php/selectState.php",
										method: 'post',
										data: {
										country:country,
										
									},
									success: function(data){ // What to do if we succeed
										//$('#tbd').empty();
										//$('#alert-danger').append('<p><br/>'+data+'</p>');
										var obj = JSON.parse(data); 
										//alert(obj);
										$.each(obj, function (index, value) {
											// APPEND OR INSERT DATA TO SELECT ELEMENT. 
											//console.log(value.state_id); console.log(value.state);
											$('#state').append('<option value="' + value.state_id + '">' + value.state + '</option>');
										});								
										$.each(data.errors, function(key, value){
											$('.alert-danger').show();
											$('.alert-danger').append('<p>'+value+'</p>');
										});
									},
									error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
											console.log(textStatus);
											console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
									}
								});
								
							  
							});
														
							$.each(data.errors, function(key, value){
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});
}

/* Get Individual Vehicle details */
function getVehicleDetails(id){
//alert(id);
					$.ajax({
							url: "php/getVehicleDetail.php",
							method: 'get',
							data: {
							id:id
						},
						success: function(data){ // What to do if we succeed
							
							
							//var part1 = data.slice(0, 1);
							var obj = JSON.parse(data); 
							
							var part1 = obj.slice(0, 1);
							
							//$('#alert-danger').append('<p><br/>'+part1+'</p>');
							
							if(obj.length > 1){
						 $.each(part1,function(index,item){
								
								 var data1 ="<ul>";
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Driver Name</span>";
                                 data1 = data1 + "<span class='car-number'>"+item[0].driver_name+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Contact No.</span>";
                                 data1 = data1 + "<span class='car-number'>"+item[0].contact_no+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Car Type</span>";
                                 data1 = data1 + "<span class='car-number'>"+item[0].car_type+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Model Name</span>";
                                 data1 = data1 + "<span class='car-number'>"+item[0].model_name+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Plate No.</span>";
                                 data1 = data1 + "<span class='car-number'>"+item[0].plate_no+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 $('#showVehicleDetail').append(data1);
						   });
						   }
						   else{
							$.each(obj,function(index,item){
								
								 var data1 ="<ul>";
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Driver Name</span>";
                                 data1 = data1 + "<span class='car-number'>"+item.driver_name+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Contact No.</span>";
                                 data1 = data1 + "<span class='car-number'>"+item.contact_no+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Car Type</span>";
                                 data1 = data1 + "<span class='car-number'>"+item.car_type+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Model Name</span>";
                                 data1 = data1 + "<span class='car-number'>"+item.model_name+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";
                                 data1 = data1 + "<span class='drivername'>Plate No.</span>";
                                 data1 = data1 + "<span class='car-number'>"+item.plate_no+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								 $('#showVehicleDetail').append(data1);
								 $('#showRepairs').append("No Data to Display");
						   });
						   }
						   

							/* For repairs */
						   
						   var part = obj.slice(1,2);
						  
						   
						   for(var i=0;i<=part[0].length;i++)
						   {
								//console.log(part[0][i]);
								var data1 ="<ul>";
								 data1 = data1 + "<li class='box-list'>";
                                 data1 = data1 + "<div class='car-detail-box'>";                                
                                 data1 = data1 + "<span >"+part[0][i].repair_comment+"</span>";
                                 data1 = data1 + "</div>";
                                 data1 = data1 + "</li>"; 
								 data1 = data1 + "</ul>";
								
								 $('#showRepairs').append(data1);
						   } 
														
							$.each(data.errors, function(key, value){
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});	
}

/* Registration */
function register(){

	var full_name = $('#fullname').val();
	var phone_no = $('#phone_no').val();
	var email = $('#email').val();
	var pwd = $('#pwd').val();
	var cpwd = $('#cpwd').val();
	var street = $('#street').val();
	var city = $('#city').val();
	var state = $('#state').val(); console.log("Arpi"+state);
	var country = $('#country').val(); console.log("Arpi"+country);
	
	/* Validation */
	if(full_name == ""){
	document.getElementById("alert-danger").innerHTML = "Full Name is required";
	 setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
	if(phone_no == ""){
	document.getElementById("alert-danger").innerHTML = "Phone No. is required";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
	var pattern = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
	if( !pattern.test( email ) ){
	document.getElementById("alert-danger").innerHTML = "Email ID is not valid one";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
	if(pwd == ""){
	document.getElementById("alert-danger").innerHTML = "Password is required";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
	if(cpwd == ""){
	document.getElementById("alert-danger").innerHTML = "Confirmation Password is required";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
	if(pwd != cpwd){
	document.getElementById("alert-danger").innerHTML = "Password and Confirmation Password dosen't match";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
	if(street == ""){
	document.getElementById("alert-danger").innerHTML = "Street is required";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
	if(city == ""){
	document.getElementById("alert-danger").innerHTML = "City is required";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
	if (state == 'Select State') {
	document.getElementById("alert-danger").innerHTML = "State is required";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	 }
	if (country == 'Select Country') {
	document.getElementById("alert-danger").innerHTML = "Country is required";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	 }
	 //alert($('input[name="checkbox3"]:checked').length);
	if($('input[name="checkbox3"]:checked').length == 0){
	document.getElementById("alert-danger").innerHTML = "Please agree to terms and conditons!";
	setTimeout(function(){
         document.getElementById("alert-danger").innerHTML="";
         },5000);
	return false;
	}
						
	
	
						$.ajax({
							url: "php/registration.php",
							method: 'post',
							data: {
							full_name:full_name,
							phone_no:phone_no,
							email:email,
							pwd:pwd,
							cpwd:cpwd,
							street:street,
							city:city,
							state:state,
							country:country
						},
						success: function(data){ // What to do if we succeed
							//$('#tbd').empty();
							//getData(email);
							$('#alert-danger').append('<p><br/>'+data+'</p>');		
							$.each(data.errors, function(key, value){
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});
}


/* Login Validation */
function checkLogin(){
	
	var email = $('#email').val();
	var pwd = $('#pwd').val();
	//alert(pwd);
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!regex.test(email)){
		$('#alert-danger').append('Incorrect email id');;
		return false;
	}
	
				$.ajax({
							url: "php/checkLogin.php",
							method: 'post',
							data: {
							email:email,
							pwd:pwd
						},
						success: function(data){ // What to do if we succeed
							//$('#tbd').empty();
							//getData(email);
							$('#alert-danger').append('<p><br/>'+data+'</p>');	
							setTimeout(function(){
								 document.getElementById("alert-danger").innerHTML="";
								 },3000);							
							$.each(data.errors, function(key, value){
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});
		
}

/* Load data on index page */

function getData(id){

				$.ajax({
							url: "php/getAllData.php",
							
							method: 'get',
							data:{
							id:id
							},
						success: function(data){

						console.log(id);
						   
						  var obj = JSON.parse(data);
						  $.each(obj,function(index,item){
								var td = "<tr>";
								td = td + "<td>" + item.id + "</td>";
								td = td + "<td>" + item.driver_name + "</td>";
								td = td + "<td>" + item.car_type + "</td>";
								td = td + "<td>" + item.model_name + "</td>";
								td = td + "<td>" + item.plate_no + "</td>";
								//td = td + "<td><input type='button' value='Edit'  data-toggle='modal' data-target='#myModal' onclick='editdata("+ JSON.stringify(item) +");'/></td>";
								td = td + "<td><input type='button' class='btn btn-danger' value='Delete' onclick='deletedata(\"" + item.id + "\",\"" + id + "\");'/></td>";
								td = td + "</tr>";
								//alert(td);
								$('#showVehicle').append(td);
						   });		
							$.each(data.errors, function(key, value){
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});
	
}
/* To Update Data*/
function editdata(obj)
	{
		//alert(obj.id);
		//alert("Hello");
		/*$('#editDetails').show();*/
		$('#VehicleId').val(obj.id);
		$('#driver_name_new').val(obj.driver_name);
		$('#contact_no_new').val(obj.contact_no);
		$('#car_type_new').val(obj.car_type);
		$('#model_no_new').val(obj.model_name);
		$('#plate_no_new').val(obj.plate_no);
	}

/* To update Data */	
function updateVehicle()
{
	var driver_name= $('#driver_name_new').val();
	var contact_no = $('#contact_no_new').val();
	var car_type = $('#car_type_new').val();
	var model_no = $('#model_no_new').val();
	var plate_no = $('#plate_no_new').val();
	var id= $('#VehicleId').val();
	alert(id);
	
						$.ajax({
							url: "php/updateVehicleData.php",
							method: 'post',
							data: {
							id:id,
							driver_name:driver_name,
							contact_no:contact_no,
							car_type:car_type,
							model_no:model_no,
							plate_no:plate_no
						},
						success: function(data){ // What to do if we succeed
							$('#showVehicle').empty();
							getData();
							$('#alert-danger').append('<p><br/>'+data+'</p>');		
							$.each(data.errors, function(key, value){
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});	
}


/* To Delete Data */


function deletedata(id,mechanic_id){
	//alert(id);
					//var result = confirm("Want to delete?");
					ConfirmDialog('Data will be deleted permanently! Are you sure you want to delete?');
					$(".ui-dialog-titlebar").hide();
					function ConfirmDialog(message) {
							$('<div></div>').appendTo('body')
							.html('<div><h6>'+message+'?</h6></div>')
							
							.dialog({
								modal: true, title: 'Delete Record', zIndex: 10000, autoOpen: true,
								width: 'auto', resizable: true,
								buttons: {
									Yes: function () {
										
										$.ajax({
											url: "php/deleteVehicleData.php",
											method: 'post',
											data: {
											id:id
										},
										success: function(data){ 
										console.log(data.id);// What to do if we succeed
											$('#showVehicle').empty();
											getData(mechanic_id);
											 $('#alert-danger').append('<p><br/>'+data+'</p>');
												setTimeout(function(){
													 document.getElementById("alert-danger").innerHTML="";
													 },3000);
												
											$.each(data.errors, function(key, value){
												$('.alert-danger').show();
												$('.alert-danger').append('<p>'+value+'</p>');
											});
										},
										error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
												console.log(textStatus);
												console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
										}
									});	
										
										


										$(this).dialog("close");
									},
									No: function () {                                                                 
										//$('body').append('<h1>Confirm Dialog Result: <i>No</i></h1>');

										$(this).dialog("close");
									}
								},
								close: function (event, ui) {
									$(this).remove();
								}
							});
					};


}

/* To Insert Data */

function addVehicle(id)
{
//alert(id);
			var repairs =$('#add_repairs').serialize();
			// var strenc = urlencode($repairs);
//console.log(repairs);
			var driver_name = $("#driver_name").val();
			var contact_no = $("#contact_no").val();
			var car_type = $("#car_type").val();
			var model_no = $("#model_no").val();
			var plate_no = $("#plate_no").val(); //alert(id);
			
				$.ajax({
							url: "php/insertVehicleData.php",
							method: 'post',
							data: {
							driver_name:driver_name,
							contact_no:contact_no,
							car_type:car_type,
							model_no: model_no,
							plate_no: plate_no,
							id:id,
							repairs:repairs
						},
						success: function(data){ // What to do if we succeed
						//location.reload();
							$('#alert-danger').append('<p><br/>'+data+'</p><br/>');
							setTimeout(function(){
								 document.getElementById("alert-danger").innerHTML="";
								 },3000);
							$.each(data.errors, function(key, value){
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});	//alert("Hello");
}

function CancelAddVehicle(){
 window.location = "index.php";
}
function CancelVehicleDetail(){
 window.location = "vehicle-list.php";
}

/* To Display All Data */
/*function getallVehicleData(){
			 
	$.ajax({
							url: "php/getAllVehicleData.php",
							
							method: 'get',
						success: function(data){

						console.log(data);
						   
						  var obj = JSON.parse(data);
						  $.each(obj,function(index,item){
								var td = "<tr>";
								td = td + "<td>" + item.driver_name + "</td>";
								td = td + "<td>" + item.contact_no + "</td>";
								td = td + "<td>" + item.car_type + "</td>";
								td = td + "<td>" + item.model_name + "</td>";
								td = td + "<td>" + item.plate_no + "</td>";
								//td = td + "<td><input type='button' value='Edit'  data-toggle='modal' data-target='#myModal' onclick='editdata("+ JSON.stringify(item) +");'/></td>";
								//td = td + "<td><input type='button' value='Delete' onclick='deletedata("+ item.id +");'/></td>";
								td = td + "</tr>";
								//alert(td);
								$('#showAllVehicle').append(td);
								//$('#allVehicleDatatables').DataTable)();
						   });		
							$.each(data.errors, function(key, value){
								$('.alert-danger').show();
								$('.alert-danger').append('<p>'+value+'</p>');
							});
						},
						error: function(jqXHR, textStatus, errorThrown) {  // What to do if we fail
								console.log(textStatus);
								console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
						}
					});
}*/