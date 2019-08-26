var url = $("#url").val();
jQuery(document).ready(function ($) {
    $("#dataTable").dataTable();
    $("#loadingBlock").hide();
});

$("#add_new_route").click(function (e) { 
    e.preventDefault();
    $.get(url+"route/add_route_form",function (data){
        $('.modal-body').html(data);
        $("#modal-id").modal('show');
    });
});

$(document).on('click', "#delete_route_btn", function (event) {
    var conf = confirm("Do you really want to delete this route ??");
    if (conf == true) {
        var route_id = $(this).attr('value');
        $.get(url + 'route/delete_route?route_id=' + route_id, function (data) {
            if (data == "1") {
                location.reload();
            } else {
                alert("failed to delete route");
            }
        });
    }

});

$(document).on('change', '#consignment_type', function (event) {
    var consignment_type = $('#consignment_type').val();
    if (consignment_type == 'market') {
        $('#freight').hide();
        $('#cmvr').hide();
    } else {
        $('#freight').show();
        $('#cmvr').show();
    }

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
$(document).on('submit', '#update_route_submit', function (event) {

    event.preventDefault();
    $.ajax({
        url: url + 'route/update_freight',
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
                alert(resp.msg);
            } else {
                alert(resp.msg);

            }

            $("#loadingBlock").hide();

        }
    })
});