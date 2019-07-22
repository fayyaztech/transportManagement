<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Trip management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#trip_details" aria-controls="home" role="tab" data-toggle="tab">TRIP DETAILS</a>
                    </li>
                    <li role="presentation">
                        <a href="#add_trips" aria-controls="tab" role="tab" data-toggle="tab">
                        ADD TRIP</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="trip_details">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="tab1" class="table table-bordered table-hover">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Consignor Name</th>
                                            <th>Consignee Name</th>
                                            <th>Vehicle Number</th>
                                            <th>Trip Start Date</th>
                                            <th>Trip Stop Date</th>
                                            <th>Route</th>
                                            <th>Driver</th>
                                            <th>Distance</th>
                                            <th>Frieght</th>
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="trip_table">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="add_trips">
                        
                        <form action="javascript:void();" method="post" id="add_trip" accept-charset="utf-8">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="text-center">Add Trip</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="row">
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="select truck">Trip Date</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="date" name="trip_start_date" id="inputTrip_date" class="form-control" value="" required="required" title="">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="select Route">Route<span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="route_id" id="routes" class="form-control" required="required">
                                                    <option value="">Select Route</option>
                                                    <?php
                                                        foreach (fetch_route($this) as $v) {
                                                            echo '<option value="'.$v->route_id.'">'.$v->route_origin.' to '.$v->route_destination.'</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" href='#modal-id' id="add_route"> <i class="fa fa-plus"></i> Route</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Select Consignor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="consignor_id" id="select_consignor" class="form-control" required="required">
                                                    <option value="">select consignor</option>
                                                    <?php   foreach (fetch_consignor($this) as $value)
                                                    {
                                                    echo '<option value="'.$value->consignor_id.'">'.$value->consignor_name.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" href='#modal-id' id="add_consignor"> <i class="fa fa-plus"></i> Consignor</button>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">Select consignee</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="consignee_id" id="select_consignee" class="form-control" required="required">
                                                    <option value="">select consignee</option>
                                                    <?php   foreach (fetch_consignee($this) as $value)
                                                    {
                                                    echo '<option value="'.$value->consignee_id.'">'.$value->consignee_name.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-primary pull-right" data-toggle="modal" href='#modal-id' id="add_consignee"> <i class="fa fa-plus"></i> consignee</button>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="select truck">Select Truck <span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="vehicle_id" id="vehicle_id" class="form-control" required="required">

                                                   <option value="">select truck</option>

                                                    <?php   
                                                  
                                                    if(!empty(fetch_vehicle_list($this)))
                                                    {
                                                    foreach (fetch_vehicle_list($this) as $value)
                                                        {
                                                        echo ' 
                                                        <option value="'.$value->vehicle_id.'">'.$value->vehicle_number.'</option>';
                                                        }
                                                    }else{
                                                        echo'<option value="">Not Available</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="select driver">Select Driver<span class="text-danger">*</span></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="driver_id" id="driver_id" class="form-control" required="required">
                                                    <option value="">Select Driver</option>
                                                    <?php
                                                    // $data = fetch_driver($this,0);
                                                    // print_r($data);
                                                    foreach (fetch_driver($this,1) as $value)
                                                    {
                                                    echo '<option value="'.$value->driver_id.'">'.$value->driver_name.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="select Allowance"><span class="text-danger">*</span>Allowance Issued</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="allowance" class="form-control" placeholder="allowance"  autofocus="autofocus">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="select Route">Add Advance</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <input type="text" name="advance" class="form-control" placeholder="advance"  autofocus="autofocus">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                 <div class="row">
                                    <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Add Load<span class="text-danger">*</span></label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select name="load_id" id="load_id" class="form-control" >
                                                        <option value="0">Market</option>
                                                        <?php
                                                            foreach (fetch_load($this) as $value)
                                                            {
                                                                    echo '<option value="'.$value->load_id.'">'.$value->load_name.'</option>';
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                       
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="select Allowance">
                                                            <span class="text-danger">*</span>Freight</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                       <input type="text" name="trip_detail_freight" class="form-control" placeholder="freight"  autofocus="autofocus">
                                                    </div>
                                                </div>
                                            </div>
                                       
                                        <div class="row">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-danger pull-right btn-lg" data-dismiss="modal">close</button>
                                                <button type="submit" class="btn btn-success pull-right btn-lg" id="personal_information">Submit</button>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content" id="add_route_info">
                        <div class="modal-body" >
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
        </div>
    </div>
</body>