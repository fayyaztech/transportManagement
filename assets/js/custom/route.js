var url = $("#url").val();
jQuery(document).ready(function ($) {
    $("#dataTable").dataTable();
    $("#loadingBlock").hide();
});

$("#add_new_route").click(function (e) { 
    e.preventDefault();
    route_form({});
});


//update route form
$(".update_route_btn").click(function (e) {
    e.preventDefault();
    var route_id = $(this).parent().attr('value');
    var data = {
        'action': 'edit',
        'route_id': route_id
    };
    route_form(data);
});


$(document).on('click', ".delete_route_btn", function (event) {
    var conf = confirm("Do you really want to delete this route ??");
    if (conf == true) {
        var route_id = $(this).parent().attr('value');
        $.get(url + 'route/delete_route?route_id=' + route_id, function (data) {
            if (data == "1") {
                location.reload();
            } else {
                alert("failed to delete route");
            }
        });
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
           if (data == 1) {
                alert("route added !");
                location.reload();
            } else if (data == 2) {
                alert("route Updated !");
                location.reload();
            } else {
                alert(resp.msg);
            }

            $("#loadingBlock").hide();

        }
    })
});


function route_form(data) {
    /**function used for 
     * get to add consignor form
     * edit consignor form
     * view consignor details
     */
    $.get(url+"route/add_route_form",data,function (data){
        $('.modal-body').html(data);
        $("#modal-id").modal('show');
    });
}