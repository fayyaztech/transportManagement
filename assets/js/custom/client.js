var url = $("#url").val();
jQuery(document).ready(function($) {
	$("#loadingBlock").hide();
	load_clients();
});


// $(document).on('submit', '#add_client', function(event) {
// 	event.preventDefault();
// 	// alert('clicked');
// 	$.ajax({
// 		url: url+'client/add_client',
// 		 type: 'POST',
//                 data: new FormData(this),
//                 cache:false,
//                 contentType:false,
//                 processData:false,
//                 success:function(data){
//                         var resp = jQuery.parseJSON(data);
//                         console.log(data);
//                         if (resp.code == 1) {
//                            load_clients();
//                            $('#modal-id').modal('hide');

//                         }else{
//                             alert(resp.msg);
                            
//                         }
//                         $("#loadingBlock").hide();

//                 }
//             });
// });

$(document).on('submit', '#add_consignor_form', function(event) {
    event.preventDefault();
    // alert('clicked');
    $.ajax({
        url: url+'client/add_consignor',
         type: 'POST',
                data: new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success:function(data){
                        var resp = jQuery.parseJSON(data);
                        console.log(data);
                        if (resp.code == 1) {
                          
                           location.reload();

                        }else{
                            alert(resp.msg);
                            
                        }
                        $("#loadingBlock").hide();

                }
            });
});

$(document).on('submit', '#add_consignee_form', function(event) {
    event.preventDefault();
    // alert('clicked');
    $.ajax({
        url: url+'client/add_consignee',
         type: 'POST',
                data: new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success:function(data){
                        var resp = jQuery.parseJSON(data);
                        console.log(data);
                        if (resp.code == 1) {
                          
                           location.reload();

                        }else{
                            alert(resp.msg);
                            
                        }
                        $("#loadingBlock").hide();

                }
            });
});

$(document).on('submit', '#update_client', function(event) {
    event.preventDefault();
    var client_id=$('#client_id').val();
    $.ajax({
        url: url+'client/update_client?client_id='+client_id,
        type: 'POST',
        data: new FormData(this),
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
                        var resp = jQuery.parseJSON(data);
                        console.log(data);
                        if (resp.code == 1) {
                           load_clients();
                           $('#modal-id').modal('hide');
                        }else{
                            alert(resp.msg);
                            
                        }
                        $("#loadingBlock").hide();
                }
            });
});
$("#add_client").click(function(event) {
    $.ajax({
        url: url + "operations/add_client",
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
        }
    })
});

$(document).on('click', '#update_con',function(event) {
    var client_id=$(this).parent().attr('value');
    //fetch_client(client_id);
    $.ajax({
        url: url + "client/fetch_client?client_id="+client_id,
        method: "POST",
        success: function(data) {
            //alert(data);
            $('#modal-id').html(data);
        }
    })
});


function load_clients() {
	$("#loadingBlock").show();
	$.get(url+'client/', function(data) {
		$("#client_table").html(data);
	});
	$("#loadingBlock").hide();
}