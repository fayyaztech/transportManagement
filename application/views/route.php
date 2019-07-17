<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Route management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <!-- <div class="row">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" href='#modal-id' id="add_route">Add Route</button>
            </div><br> -->
            
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#routes" aria-controls="home" role="tab" data-toggle="tab">Routes</a>
                    </li>
                    <li role="presentation">
                        <a href="#add_route" aria-controls="tab" role="tab" data-toggle="tab">Add Routes</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="routes">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr><th>Sr.</th>  
                                            <th>Origin</th>
                                            <th>Destination</th>
                                            <!-- <th>State</th> -->
                                            <th>Distance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="route_info">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="add_route" >
                    <form action="javascript:void();" method="Post" id="add_route_submit"accept-charset="utf-8">
                            <div class="panel">
                                <div class="panel-heading bg-primary">
                                    <h3 class="text-center">Add Route</h3>
                                </div>
                                <div class="panel-body">
                                    
                                   
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="origin">Origin</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="route_origin" class="form-control" autofocus="autofocus">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="destination">Destination</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="route_destination" class="form-control"   autofocus="autofocus">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <!-- <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="via">State</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="route_state" class="form-control"  autofocus="autofocus">
                                            </div>
                                        </div> -->
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="Distance">Distance</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="route_distance" class="form-control"  autofocus="autofocus">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-3 col-md-offset-9">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                                            <button type="submit" class="btn btn-success" id="personal_information">Submit</button>
                                            <button type="button" class="hidden reset-btn">Custom Reset Button</button>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            
            
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="route">
                        <div class="modal-body" >
                            
                        </div>
                    </div>
                </div>
            </div>
           
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
        </div>
    </div>
</body>