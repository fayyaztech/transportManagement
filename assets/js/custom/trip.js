var url = $("#url").val();

jQuery(document).ready(function($) {
        $("#loadingBlock").hide();
        $('#freight_div').hide();
        load_trip_data();
    });

// Add Trip Button Click

$("#add_consignor").click(function(event) {
    $.ajax({
        url: url + "operations/add_consignor",
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
        }
    })
});
$("#add_consignee").click(function(event) {
    $.ajax({
        url: url + "operations/add_consignee",
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
        }
    })
});
$(document).on('change','#trip_type',function(event){
      var trip_type = $('#trip_type').val();
        if(trip_type == 2){
            $('#freight_div').show();
            $('#load_div').hide();
        }else{
            $('#freight_div').hide();
            $('#load_div').show();
        }
        
    });
//route hide show
$(document).on('change','#consignment_type',function(event){
      var consignment_type = $('#consignment_type').val();
       if(consignment_type == 'market'){
            $('#freight').hide();
            $('#cmvr').hide();
        }else{
            $('#freight').show();
            $('#cmvr').show();
        }
        
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
$("#add_route").click(function(event) {
    $.ajax({
        url: url + "operations/add_route",
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
        }
    })
});
// Stop Trip Button Click
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
                          
                            $('#modal-id').modal('hide'); 

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
                          
                            $('#modal-id').modal('hide'); 

                        }else{
                            alert(resp.msg);
                            
                        }
                        $("#loadingBlock").hide();

                }
            });
});

$(document).on('click',"#stop_trip",function(event) {
    $("#loadingBlock").show();
    var trip_id=$(this).parent().attr('t_id');
    var v_id = $(this).parent().attr('v_id');
    var t_run = $(this).parent().attr('t_id');
    var trip_name =$(this).closest("tr").find("td:nth-child(3)").text();
    $.ajax({
        url: url + "operations/complete_trip?trip_id="+trip_id+"&name="+trip_name+"&vehicle_id="+v_id+"&t_run="+t_run,
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
            $("#t_id").val(trip_id);
            $('#modal-id').modal('show');            
        }
    })
});

// Update Trip Button Click

$(document).on('click',"#update_trip",function(event) {
    var trip_id=$(this).parent().attr('t_id');
    trip_name=$(this).closest("tr").find("td:nth-child(3)").text();
    $.ajax({
        url: url + "trip/fetch_trip_info?trip_id="+trip_id,
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
             $('#modal-id').modal('show');
        }
    })
});

// Update Trip Button Click



$(document).on('click',"#step_trip",function(event) {
    
    var trip_id=$(this).parent().attr('t_id');
    trip_name=$(this).closest("tr").find("td:nth-child(3)").text();
    $.ajax({
        url: url + "trip/fetch_trip_step?trip_id="+trip_id,
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
             $('#modal-id').modal('show');
        }
    })
});

// Saving Add Trip Step Form Data 

    $(document).on('submit',"#save_trip_step",function(event){
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
            url:url+"trip/add_trip_step",
            method:"post",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                    var resp = jQuery.parseJSON(data);
                    console.log(data);
                    if (resp.code == 1) 
                    {
                        alert(resp.msg);
                        $('#modal-id').modal('hide');
                        load_trip_data();
                    }
                    else
                    {
                        alert(resp.msg);
                    }
                    $("#loadingBlock").hide();
                 }
            })
    });

// Saving Add Trip Form Data 

    $(document).on('submit',"#add_trip",function(event){
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
            url:url+"trip/add_trip",
            method:"post",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                    var resp = jQuery.parseJSON(data);
                    console.log(data);
                    if (resp.code == 1) 
                    {
                        alert(resp.msg);
                        $('#modal-id').modal('hide');
                        load_trip_data();
                    }
                    else
                    {
                        alert(resp.msg);
                    }
                    $("#loadingBlock").hide();
                 }
            })
    });

// Saving Update Trip Form Data

    $(document).on('submit',"#update_trip_form",function(event){
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
            url:url+"trip/update_trip",
            method:"post",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                    var resp = jQuery.parseJSON(data);
                    console.log(data);
                    if (resp.code == 1) 
                    {
                        alert(resp.msg);
                        load_trip_data();
                        $('#modal-id').modal('hide');
                        $('#modal-id').html("");
                    }
                    else
                    {
                        alert(resp.msg);
                    }
                    $("#loadingBlock").hide();
                 }
            })
    });

// Saving Stop Trip Form Data

    $(document).on('submit',"#stop_trip_form",function(event){
    // var trip_id=$("#t_id").val();
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
            url:url+"trip/stop_trip",
            method:"post",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                    var resp = jQuery.parseJSON(data);
                    console.log(data);
                    if (resp.code == 1) 
                    {
                        alert(resp.msg);
                        load_trip_data();
                        $('#modal-id').modal('hide');
                        $('#modal-id').html("");
                    }
                    else
                    {
                        alert(resp.msg);
                    }
                    $("#loadingBlock").hide();
                 }
            })
    });



//fetch trip advance form

$(document).on('click',"#fetch_advance",function(event) {
    var trip_id=$(this).parent().attr('t_id');
   
    $.ajax({
        url: url + "trip/fetch_advance_form?trip_id="+trip_id,
        method: "POST",
        success: function(data) {
            $('#modal-id').html(data);
             $('#modal-id').modal('show');
        }
    })
});

//add trip advance 
    
 $(document).on('submit',"#add_advance",function(event){
    // var trip_id=$("#t_id").val();
    event.preventDefault();
    $("#loadingBlock").show();
    $.ajax({
            url:url+"trip/add_advance",
            method:"post",
            data:new FormData(this),
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                    var resp = jQuery.parseJSON(data);
                    console.log(data);
                    if (resp.code == 1) 
                    {
                        alert(resp.msg);
                        load_trip_data();
                        $('#modal-id').modal('hide');
                        $('#modal-id').html("");
                    }
                    else
                    {
                        alert(resp.msg);
                    }
                    $("#loadingBlock").hide();
                 }
            })
    });




// Load Function For Main Table Data

        function load_trip_data(){
        $("#loadingBlock").show();
        $.get(url+'trip/', function(data) {
            $("#trip_table").html(data);
            $("#loadingBlock").hide();
        });
    }