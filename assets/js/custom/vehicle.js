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
			alert(data);
				location.reload();
			}
	})
})
// End Saving New Vehicle Record //

// Saving Updated Vehicle Record //

$(document).on('submit','#update_form',function(event){
	var url=$('#url').val();

	event.preventDefault();
	$.ajax({
			url:url+"vehicle/update_vehicle",
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			location.reload();
			}
	})
})

// End Saving Updated Vehicle Record //
	

// Deliting Vehicle Record //
	var url=$('#url').val();
	$(document).on('click', '#delete', function(event){
	
	if (confirm('Do You Want To Delete Vehicle Record..?')) 
	{
    	var vehicle_id = $(this).parent().attr('value');
		$.ajax({
				url:url+"vehicle/delete_vehicle?vehicle_id="+vehicle_id,
				method:"POST",
				success:function(data){
				alert(data);
				location.reload();
			}
		})
		
	} 
	else 
	{
    	location.reload();
	}
		
});
// End Fetching Record For Update //
