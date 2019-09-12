var url = $("#url").val();

/**ready method  */
jQuery(document).ready(function ($) {
    $("#loadingBlock").hide();
    // $("#dataTable").dataTable();
    $('#freight_div').hide();
});

/**select box options ********************************************************************
 * step select option 
 * trip select options
 */

$('.trip_step_option').change(function (e) {
    e.preventDefault();
    var requestUrl;
    var slct = $(this).val();
    // alert(slct);
    // var trip_id = $(this).parent().attr('trip_id');
    var step_id = $(this).parent().attr('step_id');
    var data = {
        'step_id': step_id
    }
    switch (slct) {
        case 'step_stop':
            requestUrl = url + 'trip/end_step_form';
            load_url_data(requestUrl, data);
            break;
        case 'step_run':
            requestUrl = url + 'trip/fetch_trip_step';
            load_url_data(requestUrl, data);
            break;
        case 'step_update':
            requestUrl = url + 'trip/update_step_form';
            load_url_data(requestUrl, data);
            break;
    }
});

$('.trip_option').change(function () {
    var slct = $(this).val();
    var trip_id = $(this).parent().attr('trip_id');
    var data = {
        'trip_id': trip_id
    };
    switch (slct) {
        case 'trip_update':
            requestUrl = url + "trip/edit_trip_form";
            load_url_data(requestUrl, data);
            break;
        case 'trip_advance':
            requestUrl = url + "trip/advance_form";
            load_url_data(requestUrl, data);
            break;
        case 'trip_received_payment':
            data = {
                'type': 'Received Payment',
                'trip_id': trip_id
            }
            requestUrl = url + "trip/received_payment_form";
            load_url_data(requestUrl, data);
            break;
        case 'trip_received_incentive':
            data = {
                'type': 'Received Incentive',
                'trip_id': trip_id
            }
            requestUrl = url + "trip/received_payment_form";
            load_url_data(requestUrl, data);
            break;
        case 'run_new_step':
            requestUrl = url + "trip/trip_step_form";
            load_url_data(requestUrl, data);
        case 'trip_stop':
            step_update($trip_id);
            break;
        case 'trip_delete':
            step_update($trip_id);
            break;
    }
});


/**action get form *****************************************************************************
 * add new trip form
 */

$('#add-trip').click(function (e) {
    e.preventDefault();
    $('.modal-content').html("");
    var data = {};
    $.get(url + "trip/add_trip_from", data,
        function (data) {
            $('.modal-content').html(data);
            $('#modal-id').modal({
                backdrop: 'static',
                keyboard: false // to prevent closing with Esc button (if you want this too)
            })
            $("#modal-id").modal("show");

        });
});

/**form action *************************************************************** */
$(document).on("submit", "#update_step", function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: url + "trip/update_step",
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response == 1) {
                alert("step successfully updated");
                location.reload();
            } else {
                alert(response);
            }
        }
    });
});

$(document).on("submit", "#received_payment_form", function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: url + "trip/receive_payment",
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response == 1) {
                alert("payment received");
                location.reload();
            } else {
                alert(response);
            }
        }
    });
});

$(document).on('submit', '#add_route_submit', function (event) {

    event.preventDefault();
    $.ajax({
        url: url + 'route/add_route',
        type: 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            var resp = jQuery.parseJSON(data);
            console.log(data);
            if (resp.code == 1) {
                alert(resp.msg);
                location.reload(true);
                // $("#add_route_submit").trigger("reset");

            } else {
                alert(resp.msg);

            }

            $("#loadingBlock").hide();

        }
    })
});

$(document).on('submit', '#add_consignor_form', function (event) {
    event.preventDefault();
    // alert('clicked');
    $.ajax({
        url: url + 'client/add_consignor',
        type: 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            var resp = jQuery.parseJSON(data);
            console.log(data);
            if (resp.code == 1) {

                $('#modal-id').modal('hide');

            } else {
                alert(resp.msg);

            }
            $("#loadingBlock").hide();

        }
    });
});


/*
    stop main trip submit data
*/
$(document).on('submit', '#stop_trip_step_form', function (event) {
    event.preventDefault();
    $.ajax({
        url: url + 'trip/stop_step',
        type: 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            alert(data);
            location.reload();
        }
    });
});


$(document).on('submit', '#add_consignee_form', function (event) {
    event.preventDefault();
    // alert('clicked');
    $.ajax({
        url: url + 'client/add_consignee',
        type: 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            var resp = jQuery.parseJSON(data);
            console.log(data);
            if (resp.code == 1) {

                $('#modal-id').modal('hide');

            } else {
                alert(resp.msg);

            }
            $("#loadingBlock").hide();

        }
    });
});

$(document).on('submit', '#end_step_form', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: url + "trip/end_step",
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response == 1) {
                alert("trip step stop successfully ");
                location.reload();
            } else {
                alert(response);
            }
        }
    });
});

/** extra action ************************************************************* */
// Add Trip Button Click

$(document).on('change', "#select_consignor", function () {
    var consignor_id = $("#select_consignor").val();
    $.get(url + 'trip/get_consignee?consignor_id=' + consignor_id, function (data) {
        $("#select_consignee").html(data);
    });

    $.get(url + 'trip/get_loads?consignor_id=' + consignor_id, function (data) {
        $("#loads_by_consignor").html(data);
    });

    $.get(url + 'trip/get_routes?consignor_id=' + consignor_id, function (data) {
        $("#select-routes").html(data);
    });

});
$("#add_consignor").click(function () {
    $.ajax({
        url: url + "operations/add_consignor",
        method: "POST",
        success: function (data) {
            $('#modal-id').html(data);
        }
    })
});
$("#add_consignee").click(function () {
    $.ajax({
        url: url + "operations/add_consignee",
        method: "POST",
        success: function (data) {
            $('#modal-id').html(data);
        }
    })
});
$(document).on('change', '#trip_type', function () {
    var trip_type = $('#trip_type').val();
    if (trip_type == 2) {
        $('#freight_div').show();
        $('#load_div').hide();
    } else {
        $('#freight_div').hide();
        $('#load_div').show();
    }

});
//route hide show
$(document).on('change', '#consignment_type', function () {
    var consignment_type = $('#consignment_type').val();
    if (consignment_type == 'market') {
        $('#freight').hide();
        $('#cmvr').hide();
    } else {
        $('#freight').show();
        $('#cmvr').show();
    }

});

$("#add_client").click(function () {
    $.ajax({
        url: url + "operations/add_client",
        method: "POST",
        success: function (data) {
            $('#modal-id').html(data);
        }
    })
});
$("#add_route").click(function () {
    $.ajax({
        url: url + "operations/add_route",
        method: "POST",
        success: function (data) {
            $('#modal-id').html(data);
        }
    })
});
// Stop Trip Button Click


$(document).on('click', "#stop_step_trip", function () {

    var trip_id = $(this).parent().attr('t_id');
    trip_name = $(this).closest("tr").find("td:nth-child(3)").text();
    $.ajax({
        url: url + "trip/fetch_stop_step_trip?trip_id=" + trip_id,
        method: "POST",
        success: function (data) {
            $('#modal-id').html(data);
            $('#modal-id').modal('show');
        }
    })
});

// Saving Add Trip Step Form Data 

$(document).on('submit', "#add_trip_step", function (event) {
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
        url: url + "trip/add_trip_step",
        method: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (data == 1) {
                alert("step added successfully ");
                location.reload();
            } else {
                alert(data);
            }
            $("#loadingBlock").hide();
        }
    })
});

// Saving Add Trip Form Data 

$(document).on('submit', "#add_trip", function (event) {
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
        url: url + "trip/add_trip",
        method: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            var resp = jQuery.parseJSON(data);
            console.log(data);
            if (resp.code == 1) {
                alert(resp.msg);
                $('#modal-id').modal('hide');
                location.reload();
            } else {
                alert(resp.msg);
            }
            $("#loadingBlock").hide();
        }
    })
});

// Saving Update Trip Form Data

$(document).on('submit', "#update_trip_form", function (event) {
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
        url: url + "trip/update_trip",
        method: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (data == 1) {
                alert("trip update successfully");
                location.reload();
            } else {
                alert(data);
            }
            $("#loadingBlock").hide();
        }
    })
});

// Saving Stop Trip Form Data

$(document).on('submit', "#stop_trip_form", function (event) {
    // var trip_id=$("#t_id").val();
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
        url: url + "trip/stop_trip",
        method: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            var resp = jQuery.parseJSON(data);
            console.log(data);
            if (resp.code == 1) {
                alert(resp.msg);
                load_trip_data();
                $('#modal-id').modal('hide');
                $('#modal-id').html("");
                location.reload();
            } else {
                alert(resp.msg);
            }
            $("#loadingBlock").hide();
        }
    })
});



//fetch trip advance form

$(document).on('click', "#fetch_advance", function () {
    var trip_id = $(this).parent().attr('t_id');

    $.ajax({
        url: url + "trip/fetch_advance_form?trip_id=" + trip_id,
        method: "POST",
        success: function (data) {
            $('#modal-id').html(data);
            $('#modal-id').modal('show');
        }
    })
});

//add trip advance 

$(document).on('submit', "#add_advance", function (event) {
    // var trip_id=$("#t_id").val();
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
        url: url + "trip/add_advance",
        method: "post",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            if (data == 1) {
                alert("advance successfully added");
                location.reload();
            } else {
                alert(data);
            }
        }
    })
});

function load_url_data(requestUrl, data) {
    $.get(requestUrl, data, function (response) {
        $('.modal-content').html(response);
        $('#modal-id').modal('show');
    });
}