var url = $("#url").val();
jQuery(document).ready(function($) {
        $("#loadingBlock").hide();
        load_driver_data()
 });

$("#add_driver").click(function(event){
        $.ajax({
                url:url+"operations/personal_info",
                method:"POST",
                success:function(data){
                            $("#drive_form_modal").modal('show');
                            $('#add_driver_info').html(data);

                            }
                })
        });


$(document).on('click',"#update_driver",function(event){
     var driver_id=$(this).parent().attr('value');
       
        $.ajax({
                url:url+"driver/fetch_driver?driver_id="+driver_id,
                method:"POST",
                success:function(data){
                            $("#drive_form_modal").modal('show');
                            $('#add_driver_info').html(data);

                            }
                })
        });
$(document).on('submit',"#driver_form",function(event){
        event.preventDefault();
        $("#loadingBlock").show();
        $.ajax({
                url:url+"driver/add_driver_info",
                method:"post",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                        var resp = jQuery.parseJSON(data);
                        console.log(data);
                        if (resp.code == 1) {
                                $("#drive_form_modal").modal('hide');
                                load_driver_data();
                        
                        }else{
                            alert(resp.msg);        
                        }

                        $("#loadingBlock").hide();


                     }
                })
        });


$(document).on('submit',"#driver_update_submit",function(event){
        event.preventDefault();
       
        $.ajax({
                url:url+"driver/update_driver_info",
                method:"post",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function(data){
                        var resp = jQuery.parseJSON(data);
                       
                        if (resp.code == 1) {   
                                alert(resp.msg); 
                                load_driver_data();

                        }else{
                            alert(resp.msg);    
                        }
                        $("#drive_form_modal").modal('hide');
                        

                     }
                })
        });

 function load_driver_data(){

            $("#loadingBlock").show();
            $.get(url+'driver/', function(data) {
                $("#driver_management_table").html(data);
                $("#loadingBlock").hide();
            });
        }



    $(document).on('click', '#delete', function(event){
    
    if (confirm('Do You Want To Delete Vehicle Record..?')) 
    {
        var driver_id = $(this).parent().attr('value');
        $.ajax({
                url:url+"driver/delete_driver?driver_id="+driver_id,
                method:"POST",
                success:function(data){
                    var resp = jQuery.parseJSON(data);
                 if (resp.code == 1) {   
                                alert(resp.msg); 
                                load_driver_data();

                        }else{
                            alert(resp.msg);    
                        }


              
            }
        })
        
    } 
    else 
    {
        location.reload();
    }
        
});



function showMsg(msg) {

        $('#add_driver_info').html(
            '<div class="row"> <div class="col-md-10 col-md-offset-1"><div class="panel panel-primary"><div class="panel-heading"><h3 class="text-center">'+msg+'</h3></div></div></div></div>'
            );

        $("#drive_form_modal").modal('show');
    }