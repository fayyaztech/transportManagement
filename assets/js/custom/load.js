var url = $("#url").val();

jQuery(document).ready(function ($) {
    $("#loadingBlock").hide();
    $("#dataTable").dataTable();
});

//add load button
$("#add_load").click(function (e) {
    e.preventDefault();
    var data = {
        'action': 'new',
    };
    load_form(data);
});

$('.edit-load').click(function (e) {
    e.preventDefault();
    var load_id = $(this).parent().attr('load_id');
    var data = {
        'action': 'edit',
        'load_id': load_id
    };
    load_form(data);
});

$('.delete-load').click(function (e) {
    e.preventDefault();
    var cnf = confirm("do you really want to delete ");
    if (cnf) {
        var load_id = $(this).parent().attr('load_id');
        var data = {
            'load_id': load_id
        };
        $.get(url + "load/delete_load", data, function (response) {
            alert(response);
            location.reload();
        });
    }
});

$(document).on('submit', '#add_load_submit', function (event) {
    event.preventDefault();
    $.ajax({
        url: url + 'load/add_load',
        type: 'POST',
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data == 1) {
                alert("load added");
                location.reload(true);
            } else if (data == 2) {
                alert("load_updated");
                location.reload();
            } else {
                alert(data);
            }
            $("#loadingBlock").hide();
        }
    })
});

function load_form(data) {
    $.get(url + "load/get_form", data, function (response) {
        $(".modal-content").html(response);
        $("#modal-id").modal("show");
    });
}