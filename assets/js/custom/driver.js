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

//document upload

        $(document).on('submit', '#document_upload', function(event) {
            event.preventDefault();
            $("#loadingBlock").show();
            $.ajax({
                url: url+'driver/upload_doc',
                type: 'POST',
                data: new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success:function(data){
                        var resp = jQuery.parseJSON(data);
                        console.log(data);
                        if (resp.code == 1) {
                            $.get(url+"operations/driver_uploads?driver_id="+resp.driver_id, function(data) {
                                $('#add_driver_info').html(data);
                            });
                        }else{
                            alert(resp.msg);
                            
                        }

                        $("#loadingBlock").hide();

                }
            })
        });

// wedge form submittion
        $(document).on('submit', '#wage_form', function(event) {
            event.preventDefault();
            console.log('wage_form clicked');
            $("#loadingBlock").show();
            $.ajax({
                url: url+'driver/wadge_form',
                type: 'POST',
                data: new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success:function(data){
                        var resp = jQuery.parseJSON(data);
                        console.log(data);
                        if (resp.code == 1) {
                            $.get(url+"operations/driver_uploads?driver_id="+resp.driver_id, function(data) {
                                $('#add_driver_info').html(data);
                            });
                        }else{
                            alert(resp.msg);
                            
                        }

                        $("#loadingBlock").hide();

                }
            })
        });

    // second form submition 
        $(document).on('submit', '#document_form', function(event) {
            event.preventDefault();
            $("#loadingBlock").show();
            $.ajax({
                url: url+'driver/update_form2',
                type: 'POST',
                data: new FormData(this),
                cache:false,
                contentType:false,
                processData:false,
                success:function(data){
                        var resp = jQuery.parseJSON(data);
                        console.log(data);
                        if (resp.code == 1) {
                            $.get(url+"operations/driver_salary_info?driver_id="+resp.driver_id, function(data) {
                                $('#add_driver_info').html(data);
                            });
                        }else{
                            alert(resp.msg);
                            
                        }

                        $("#loadingBlock").hide();

                }
            })
        });

// first form submiton 
        $(document).on('submit',"#driver_form_1",function(event){
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
                            $.get(url+"operations/driver_upload_info?driver_id="+resp.driver_id, function(data) {
                                $('#add_driver_info').html(data);
                                load_driver_data();
                            });
                        }else{
                            alert(resp.msg);
                            
                        }

                        $("#loadingBlock").hide();

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

    function showMsg(msg) {

        $('#add_driver_info').html(
            '<div class="row"> <div class="col-md-10 col-md-offset-1"><div class="panel panel-primary"><div class="panel-heading"><h3 class="text-center">'+msg+'</h3></div></div></div></div>'
            );

        $("#drive_form_modal").modal('show');
    }