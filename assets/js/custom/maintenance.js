
var url=$('#url').val();
var vehicle_id=$('#vehicle_id').val();
var vehicle_name=$('#vehicle_id option:selected').text();
$(document).ready(function(){
	$("#loadingBlock").hide();
		var vehicle_id=$('#vehicle_id').val();
		var vehicle_name=$('#vehicle_id option:selected').text();
		load_data(vehicle_id,vehicle_name)
})

// Saving Tyre Maintenance Record //

$(document).on('submit','#add_tyre_form',function(event){
	var vehicle_id=$('#vehicle_id').val();
	$("#loadingBlock").show();
	event.preventDefault();
	$.ajax({
			url:url+"maintenance/add_tyre_maintenance?vehicle_id="+vehicle_id,
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$("#add_tyre_model").modal('hide');
			load_data(vehicle_id,vehicle_name)
			$("#loadingBlock").hide();
			}

	})
})

$(document).on('click','#assingTyreVehicle',function(e){
	// assign stepny model btn
	var vehicle_id=$('#vehicle_id').val();
	var vehicle_name=$('#vehicle_id option:selected').text();
	var p_id = $(this).parent().attr('p_id');
	var v_id = $(this).parent().attr('v_id');
	$('#p_id').val(p_id);
	$('#v_id').val(v_id);
	$('#vehicle_name').text(vehicle_name);
})

$(document).on('submit','#assign_tyre',function(e){
	e.preventdefault();
	$.ajax({
			url:url+"maintenance/assign_tyre_to_vehicle",
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$("#Assign_to_vehicle").modal('hide');
			load_data(vehicle_id,vehicle_name)
			$("#loadingBlock").hide();
			}
		})
})

// on click on remould tyre button 
$(document).on('click',"#remould_btn",function(e){
	var p_id = $(this).parent().attr('p_id');
	var s_id = $(this).parent().attr('serial');
	$('#pp_id').val(p_id);
	$('#pp_serial_no').val(s_id);
})

$(document).on('submit','#remould_tyre_form',function(e){
	e.preventDefault();
	var vehicle_id=$('#vehicle_id').val();
	$.ajax({
			url:url+"maintenance/add_tyre_maintenance?vehicle_id="+vehicle_id,
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$("#remold_tyre").modal('hide');
			load_data(vehicle_id,vehicle_name)
			$("#loadingBlock").hide();
			}

	})
})
// End Saving Tyre Maintenance Record //


//   Saving Engine Oil Maintenance Record   //

$(document).on('submit','#add_oil_form',function(event){
	var vehicle_id=$('#vehicle_id').val();
	$("#loadingBlock").show();
	if(vehicle_id!="0" && vehicle_id!=null && vehicle_id!="")
	{
		event.preventDefault();
		$.ajax({
			url:url+"maintenance/add_oil_maintenance?vehicle_id="+vehicle_id,
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$("#Add_refill").modal('hide');
			load_data(vehicle_id,vehicle_name)
			$("#loadingBlock").hide();
			}
		})
	}
	else
	{
		alert("Please Select Vehicle For Refill..");
		$("#loadingBlock").hide();
	}
})

// End Saving Engine Oil Maintenance Record //




//   Saving Battery Maintenance Record   //

$(document).on('submit','#add_battery_form',function(event){
	$("#loadingBlock").show();
	var vehicle_id=$('#vehicle_id').val();

	if(vehicle_id!="0" && vehicle_id!=null && vehicle_id!="")
	{
		event.preventDefault();
		$.ajax({
			url:url+"maintenance/add_battery_maintenance?vehicle_id="+vehicle_id,
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$("#Add_battery").modal('hide');
			load_data(vehicle_id,vehicle_name)
			$("#loadingBlock").hide();
			}
		})
	}
	else
	{
		alert("Please Select Vehicle For Battery.");
		location.reload();
	}
})

// End Saving Battery Maintenance Record //

// Fetch Modal Data For Update Battery //

$(document).on('click','#update123',function(event){
	var vm_id=$(this).attr('value');
	var vehicle_name=$('#vehicle_id option:selected').text();
	// /alert(vm_id);
	$.ajax({
			url:url+"maintenance/fetch_update_battery_info?vm_id="+vm_id+"&v_name="+vehicle_name,
			method:"post",
			success: function(data){
			//alert(data);
			$('#update_battery_modal').html(data);	
			}
		})
})

// End Fetch Modal Data For Update Battery //

//  Saving Update Battery Detals  //

$(document).on('submit','#update_battery_form',function(event){
	var vehicle_id=$('#vehicle_id').val();
		event.preventDefault();
		$.ajax({
			url:url+"maintenance/update_battery_maintenance",
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$('#update_battery_modal').modal('hide');
			}
		})
	})

//End Saving Update Battery Detals //

// Saving Recharge Battery Maintenance Record   //
$(document).on('click','#recharge',function(event){
	var vm_name=$(this).closest("tr").find("td:nth-child(2)").text();
	$('#name').val(vm_name);
})



$(document).on('submit','#recharge_battery',function(event){
	var vehicle_id=$('#vehicle_id').val();
	event.preventDefault();
	if(vehicle_id!=null && vehicle_id!="" && vehicle_id!="0")
	{
			$.ajax({
			url:url+"maintenance/add_recharge_battery?vehicle_id="+vehicle_id,
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$('#update_battery_modal').modal('hide');

			}
		})
	}
	else
	{
		alert("Please Select Vehicle..?");
		location.reload();
	}
})

// End Saving Recharge Battery Maintenance Record //

$(document).on('click','#assign_bat',function(event){
	var vehicle_name=$('#vehicle_id option:selected').text();
	//alert(vehicle_name);
	$('#assign_name').val(vehicle_name);
})

$(document).on('submit','#assign_battery',function(event){
	var old_id=$('#vehicle_id').val();
	$("#loadingBlock").show();
	event.preventDefault();
	if(old_id!=null && old_id!="" && old_id!="0")
	{
			$.ajax({
			url:url+"maintenance/assign_battery?old_id="+old_id,
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$('#battery_assign').modal('hide');
			load_data(vehicle_id,vehicle_name)
			$("#loadingBlock").hide();
			}
		})
	}
	else
	{
		alert("Please Select Vehicle..?");
		location.reload();
	}
})
//   Saving Misc Maintenance Record   //

$(document).on('submit','#add_misc_form',function(event){
	$("#loadingBlock").show();
	var vehicle_id=$('#vehicle_id').val();
	event.preventDefault();
	if(vehicle_id!=null && vehicle_id!="" && vehicle_id!="0")
	{
			$.ajax({
			url:url+"maintenance/add_misc_maintenance?vehicle_id="+vehicle_id,
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$("#Add_expenses").modal('hide');
			load_data(vehicle_id,vehicle_name)
			$("#loadingBlock").hide();
			}
		})
	}
	else
	{
		alert("Please Select Vehicle..?");
		
	}
})

// End Saving Misc Maintenance Record //

// Saving Permit & Clearance Maintenance Record   //

$(document).on('submit','#add_permit_form',function(event){
	var vehicle_id=$('#vehicle_id').val();
	event.preventDefault();
	if(vehicle_id!=null && vehicle_id!="" && vehicle_id!="0")
	{
			$.ajax({
			url:url+"maintenance/add_permit_maintenance?vehicle_id="+vehicle_id,
			method:"post",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			success: function(data){
			alert(data);
			$("#modal-id").modal('hide');
			load_data(vehicle_id,vehicle_name)
			$("#loadingBlock").hide();
			}
		})
	}
	else
	{
		alert("Please Select Vehicle..?");
		$("#loadingBlock").hide();
	}
})

// End Saving Permit & Clearance Maintenance Record //

// Binding All Tables On Dropdown Change Event //

$(document).on('change','#vehicle_id',function(event){
	  var vehicle_id=$('#vehicle_id').val();
		var vehicle_name=$('#vehicle_id option:selected').text();
		load_data(vehicle_id,vehicle_name)
	})

function load_data(vehicle_id,vehicle_name){
	$("#tyre_table").text("");
	$("#oil_table").text("");
	$("#battery_table").text("");
	$("#misc_table").text("");
	$("#permit_table").text("");
	$('#vehicle').val(vehicle_name);
	$('#vehicle1').val(vehicle_name);
	$('#vehicle2').val(vehicle_name);
	$('#m_vehicle').val(vehicle_name);
		$.ajax({
			url:url+"maintenance/get_vehicle_details?vehicle_id="+vehicle_id,
			method:"get",
			
			success: function(data){
				console.log(data);
				var j = jQuery.parseJSON(data);
				$("#tyre_table").each(function(index, el) {
					$(this).append(j.tyre);
				});
				$("#oil_table").each(function(index, el) {
					$(this).append(j.oil);
				});
				
				$("#battery_table").each(function(index, el) {
					$(this).append(j.battery);
				});

				$("#misc_table").each(function(index, el) {
					$(this).append(j.misc);
				});

				$("#permit_table").each(function(index, el) {
					$(this).append(j.permit);
				});
			}
		})
}

// End Binding Tables On Dropdown Change Event //
