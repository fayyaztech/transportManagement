var url = $("#url").val();
jQuery(document).ready(function ($) {
    $("#loadingBlock").hide();
    $("#dataTable").dataTable();
});

//add consignor form
$("#add_consignor_btn").click(function (e) {
    e.preventDefault();
    consignor_form({});
});
//update consignor form
$(".update_consignor").click(function (e) {
    e.preventDefault();
    var consignor_id = $(this).parent().attr('value');
    var data = {
        'action': 'edit',
        'consignor_id': consignor_id
    };
    consignor_form(data)
});

//view consignor data in form
$(".view_consignor").click(function (e) {
    e.preventDefault();
    var consignor_id = $(this).parent().attr('value');
    var data = {
        'action': 'edit',
        'consignor_id': consignor_id,
        'view': true
    };
    consignor_form(data)
});

$('.delete_consignor').click(function (e) {
    e.preventDefault();
    var con = confirm("do you realy want delete consignor ! all consinees deleted releted to this consignor!");
    if (con) {
        var consignor_id = $(this).parent().attr('value');
        data = {
            'consignor_id': consignor_id
        };
        $.get(url + "client/delete_consignor", data, function (responce) {
            if (responce == 1) {
                alert("consignor deleted successfully");
                location.reload();
            }
        });

    }
});

//delete consignee
$(document).on('click', '.delete_consignee', function (e) {
    e.preventDefault();
    var con = confirm("do you realy want delete consignee !");
    if (con) {
        var consignee_id = $(this).parent().attr('consignee_id');
        data = {
            'consignee_id': consignee_id
        };
        $.get(url + "client/delete_consignee", data, function (responce) {
            if (responce == 1) {
                alert("consignor deleted successfully");
                location.reload();
            }
        });
    }
});

// view consignees based on consignor id
$(".view_consignee").click(function (e) {
    e.preventDefault();
    var consignor_id = $(this).parent().attr('value');
    data = {
        'consignor_id': consignor_id
    };
    $.get(url + "client/consinee_list", data, function (responce) {
        $('.modal-body').html(responce);
        $("#modal-id").modal("show");
    }, );
});

//add consignee from 
$("#add_consignee_btn").click(function (event) {
    event.preventDefault();
    $.get(url + "client/add_consignee_form", function (responce) {
        $('.modal-body').html(responce);
        $("#modal-id").modal("show");
    });
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
            if (data == 1) {
                alert("consignor added !");
                location.reload();
            } else if (data == 2) {
                alert("consignor Updated !");
                location.reload();
            } else {
                alert(resp.msg);
            }
            $("#loadingBlock").hide();
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
                alert("consignee added !");
                location.reload();
            } else {
                alert(resp.msg);

            }
            $("#loadingBlock").hide();
        }
    });
});

function load_clients() {
    alert("om");
    $("#loadingBlock").show();
    $.get(url + 'client/', function (data) {
        $("#client_table").html(data);
    });
    $("#loadingBlock").hide();
}

function consignor_form(data) {
    /**function used for 
     * get to add consignor form
     * edit consignor form
     * view consignor details
     */
    $.get(url + "client/add_consignor_form", data, function (responce) {
        $('.modal-body').html(responce);
        $("#modal-id").modal("show");
    }, );
}