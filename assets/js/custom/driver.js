var url = $("#url").val();
jQuery(document).ready(function($) {
    $("#loadingBlock").hide();
    $('#dataTable').DataTable();
    // load_driver_data()
});

// add && update driver info
$("#add_driver").click(function(event) {
    $.get(url + "driver/driver_form", function(data) {
        $("#drive_form_modal").modal('show');
        $('#add_driver_info').html(data);
    });
});

// driver form submit add or Update
$(document).on('click', "#driver_update", function(event) {
    var driver_id = $(this).parent().attr('value');
    $.get(url + "driver/driver_form?driver_id=" + driver_id, function(data) {
        $("#drive_form_modal").modal('show');
        $('#add_driver_info').html(data);
    });
});

$(document).on('click', "#driver_profile", function(event) {
    var driver_id = $(this).parent().attr('value');
    $.get(url + "driver/driver_form?action=view&driver_id=" + driver_id, function(data) {
        $("#drive_form_modal").modal('show');
        $('#add_driver_info').html(data);
    });
});

$(document).on('click', '#reactive_driver', function(event) {

    if (confirm('Do You Want To reactive driver..?')) {
        var driver_id = $(this).parent().attr('value');
        $.get(url + "driver/reactive_driver?driver_id=" + driver_id, function(data) {
            if (data == 1) {
                alert("Drivet profile enabled");
                location.reload();
            } else {
                alert("driver profile failed to enable");
            }
        });
    }

});

$(document).on('click', '#delete', function(event) {

    if (confirm('Do You Want To Delete Driver Record..?')) {
        var driver_id = $(this).parent().attr('value');
        $.get(url + "driver/delete_driver?driver_id=" + driver_id, function(data) {
            if (data == 1) {
                alert("Drivet profile removed");
                location.reload();
            } else {
                alert("driver profile failed to remove");
            }
        });
    }

});


$(document).on('submit', "#driver_form", function(event) {
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
        url: url + "driver/add_driver_info",
        method: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            if (data == 1) {
                alert("driver added successfully");
                location.reload();
            } else if (data == 2) {
                alert("driver profile updated");
                location.reload();
            } else {
                alert(data);
            }
        }
    })
});