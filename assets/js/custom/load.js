var url = $("#url").val();



    jQuery(document).ready(function($) {
        $("#loadingBlock").hide();
        $("#dataTable").dataTable();
    });

    function fetch_load_data()
    {
	 	$("#loadingBlock").show();
            $.get(url+'load/', function(data) {
        $("#load_info").html(data);
        $("#loadingBlock").hide();
    	});
	}


	$(document).on('submit', '#add_load_submit', function(event) {
	
            event.preventDefault();
            $.ajax({
                url: url+'load/add_load',
                type: 'POST',
                data: new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success:function(data){
                        var resp = jQuery.parseJSON(data);
                        console.log(data);
                        if (resp.code == 1) {
                           alert(resp.msg);
                           location.reload(true);
                           // $("#add_route_submit").trigger("reset");

                        }else{
                            alert(resp.msg);
                            
                        }

                        $("#loadingBlock").hide();

                }
            })
        });