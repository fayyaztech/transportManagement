//base_url
var url=$('#url').val();

// add vihicle button clicked
$('.add_vehicle').click(function(event) {
	$.get(url+'vehicle/vehicle_form', function(data) {
		$('.modal_containt').html(data);
		$('#modal').modal('show');
	});
});

// update vehicle button
$(document).on('click', '#show_update_vform', function(event){
		var vehicle_id = $(this).parent().attr('value');
		$.get(url+'vehicle/vehicle_form?vehicle_id='+vehicle_id, function(data) {
		$('.modal_containt').html(data);
		$('#modal').modal('show');
	});
});

// show vehicle info
$(document).on('click', '#vehicle_info', function(event){
		var vehicle_id = $(this).parent().attr('value');
		$.get(url+'vehicle/vehicle_form?action=show_info&vehicle_id='+vehicle_id, function(data) {
		$('.modal_containt').html(data);
		$('#modal').modal('show');
	});
});

// onclick delete 
$(document).on('click', '#delete', function(event){
	if (confirm('Do You Want To Delete Vehicle Record..?')) 
	{
    	var vehicle_id = $(this).parent().attr('value');
    	$.get(url+"vehicle/delete_vehicle?vehicle_id="+vehicle_id, function(data) {
    		alert(data);
			location.reload();
    	});
	}
});

// onclick reactive
$(document).on('click', '#reactive', function(event){
	if (confirm('Do You Want To active Vehicle..?')) 
	{
    	var vehicle_id = $(this).parent().attr('value');
    	$.get(url+"vehicle/reactive_vehicle?vehicle_id="+vehicle_id, function(data) {
    		alert(data);
			location.reload();
    	});
	}
});


// Saving New Vehicle Record //

$(document).on('submit','#submit',function(event){
	var url=$('#url').val();

	event.preventDefault();
	$.ajax({
			url:url+"vehicle/add_vehicle",
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			 if (data == 1) {
			 	//when new vehicle added
			 	alert("vehicle added successfully");
			 	location.reload();
			 }else if(data == 2){
			 	// when vehicle updated
			 	alert("vehicle data updated");
			 	location.reload();
			 }else{
			 	// when from got errors
			 	alert($data);
			 }
				
			}
	})
})
// End Saving New Vehicle Record //
