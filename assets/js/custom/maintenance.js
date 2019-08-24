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
	var data = {
		'v_id': v_id,
		'v_name': v_name,
		'action': 'new'
	};
	e.preventDefault();
	$.get(url + "maintenance/get_maintainance_form", data, function (data) {
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
	data = {
		'mnt_id': mnt_id,
		'action': 'edit'
	};
	$.get(url + "maintenance/get_maintainance_form", data, function (data) {
		$(".modal-content").html(data);
		$("#modal-id").modal("show");
	});
});

//edit maintainance form
$(".mnt_info").click(function (e) {
	e.preventDefault();
	mnt_id = $(this).parent().attr("mnt_id");
	data = {
		'mnt_id': mnt_id,
		'action': 'view'
	};
	$.get(url + "maintenance/get_maintainance_form", data, function (data) {
		$(".modal-content").html(data);
		$("#modal-id").modal("show");
	});
});

// delete mainteance records
$(".mnt_delete").click(function (e) {
	e.preventDefault();
	var cnf = confirm("Do you want to delete this maintenance record ?");
	if (cnf) {
		mnt_id = $(this).parent().attr("mnt_id");
		data = {
			'mnt_id': mnt_id,
		};
		$.get(url + "maintenance/delete_mnt_record", data, function (data) {
			if (data == 1) {
				location.reload()
			}
		});
	}
});

// make maintainace as scap expire products
$(".mnt_scrap").click(function (e) {
	e.preventDefault();
	var cnf = confirm("Do you want to scrap this maintenance record ?");
	if (cnf) {
		mnt_id = $(this).parent().attr("mnt_id");
		data = {
			'mnt_id': mnt_id,
		};
		$.get(url + "maintenance/srap_mnt_record", data, function (data) {
			if (data == 1) {
				location.reload()
			}
		});
	}
});

// forward mainteance records
$(".mnt_forward").click(function (e) {
	e.preventDefault();
	mnt_id = $(this).parent().attr("mnt_id");
	data = {
		'mnt_id': mnt_id,
	};
	$.get(url + "maintenance/mnt_forward_form", data, function (data) {
		$(".modal-content").html(data);
		$("#modal-id").modal("show");
	});
});

// mainteance recycled product
$(".mnt_recycled").click(function (e) {
	e.preventDefault();
	mnt_id = $(this).parent().attr("mnt_id");
	// mnt_type = $(this).attr("mnt_type");
	data = {
		'mnt_id': mnt_id,
		'action': 'edit',
		'mnt_recycle':true
	};
	$.get(url + "maintenance/get_maintainance_form", data, function (responce) {
		$(".modal-content").html(responce);
		$("#modal-id").modal("show");
	});
});

$(document).on('submit','#mnt_forward_submit',function(e){
	$.ajax({
		type: "POST",
		url: url+"maintenance/save_forward_mnt",
		data: new FormData(this),
		contentType: false,
		cache: false,
		processData: false,
		success: function (response) {
			if(response == 1){
				alert("vehicle changed");
				location.reload();
			}
		}
	});
});

$(document).on('submit', '#maintainance_form', function (e) {
	e.preventDefault();
	$.ajax({
		url: url + "maintenance/add_maintenance",
		method: "post",
		data: new FormData(this),
		contentType: false,
		cache: false,
		processData: false,
		success: function (data) {
			if (data == 1) {
				alert("new record added");
				location.reload();
			} else if (data == 2) {
				alert("record updated");
				location.reload();
			} else {
				alert(data);
			}
		}

	})
});

// End Binding Tables On Dropdown Change Event //