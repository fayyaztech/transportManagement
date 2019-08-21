var url = $('#url').val();
var vehicle_id = $('#vehicle_id').val();
var vehicle_name = $('#vehicle_id option:selected').text();

$(document).ready(function () {
	$("#loadingBlock").hide();
	$("#dataTable").dataTable();
})

//add new maintainance form
$("#add_maintainance").click(function (e) {
	var v_id = $("#selected_vehicle").attr("v_id");
	var v_name = $("#selected_vehicle").attr("v_name");
	var data = {'v_id':v_id,'v_name':v_name,'action':'new'};
	e.preventDefault();
	$.get(url + "maintenance/get_maintainance_form",data,function (data, textStatus, jqXHR) {
			$(".modal-content").html(data);
			$("#modal-id").modal("show");
		});
});

//clear vehicle list if filter changed
$("#filter").change(function (e) { 
	e.preventDefault();
	$("#vehicle_id").html("");
	
});

//edit maintainance form
$(".mnt_edit").click(function (e) {
	e.preventDefault();
	mnt_id = $(this).parent().attr("mnt_id");
	data = {'mnt_id':mnt_id,'action':'edit'};
	$.get(url + "maintenance/get_maintainance_form",data,function (data, textStatus, jqXHR) {
			$(".modal-content").html(data);
			$("#modal-id").modal("show");
		});
});

//edit maintainance form
$(".mnt_info").click(function (e) {
	e.preventDefault();
	mnt_id = $(this).parent().attr("mnt_id");
	data = {'mnt_id':mnt_id,'action':'view'};
	$.get(url + "maintenance/get_maintainance_form",data,function (data, textStatus, jqXHR) {
			$(".modal-content").html(data);
			$("#modal-id").modal("show");
		});
});

$(document).on('submit','#maintainance_form',function(e){
	e.preventDefault();
	$.ajax({
		url: url + "maintenance/add_maintenance",
		method: "post",
		data: new FormData(this),
		contentType: false,
		cache: false,
		processData: false,
		success: function (data) {
			if(data == 1){
				alert("new record added");
				location.reload();
			}else if(data == 2){
				alert("record updated");
				location.reload();
			}else{
				alert(data);
			}
		}

	})
});

// End Binding Tables On Dropdown Change Event //