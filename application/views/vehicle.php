<body>

    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Vehicle</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<div class="row">
    <a class="btn btn-warning pull-right" style="margin-right: 40px;" data-toggle="modal" href='#modal-1'>Add vehicle</a>
</div>
<br>
<input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
<div class="row">
    <div class="modal fade" id="modal-1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                      <div class="modal-title">Add Vehicle</div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    </button>
                </div>
                <form id="submit" method="post" action="javascript:void(0);">
                    <div class="modal-body">
                        <div class="card mx-auto">
                          
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstName">Vehicle Name</label>
                                            <input type="text" id="vehicle_number" name="vehicle_number" class="form-control" placeholder="Vehicle Name" required="required" autofocus="autofocus">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastName">Maximum Capacity</label>
                                            <select id="input" name="vehicle_load_capacity" class="form-control" required="required">
                                                <option value="Select">Select</option>
                                                <option value="10">10</option>
                                            </select>
                                           <!--  <input type="text" id="vehicle_load_capacity" name="vehicle_load_capacity" class="form-control" placeholder="Maximum Capacity" required="required"> -->
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="purchase year">Purchase Year</label>
                                            <input type="text" id="vehicle_purchase_year" name="vehicle_purchase_year" class="form-control" placeholder="Purchase year" required="required">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="purchase year">Start Km</label>
                                            <input type="text" name="vehicle_current_reading" class="form-control" placeholder="Start Km" required="required">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passing no">Chassis Number</label>
                                            <input type="text" id="vehicle_chassis_no" name="vehicle_chassis_no" class="form-control" placeholder="Chassis Number" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passing no">Engine Number</label>
                                            <input type="text" id="vehicle_engine_no" name="vehicle_engine_no" class="form-control" placeholder="Engine Number" required="required">
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passing no">Expected Average</label>
                                            <input type="text" id="vehicle_expected_average" name="vehicle_expected_average" class="form-control" placeholder="Expected Average" required="required">
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="purchase year">Number Of Tyres</label>
                                            <input type="text" id="vehicle_tyres" name="vehicle_tyres" class="form-control" placeholder="Number of Tyres" required="required">
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                
                                
                                
                                
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" id="submit">Add Vehicle</button>
                        <input type="reset" class="btn btn-info" placeholder="Number of Tyres" required="required">
                        
                    </div>
                </form>
                </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="bg-primary text-center">
                                <tr>
                                    <th class="text-center">Vehicle</th>
                                    <th class="text-center">Vehicle status</th>
                                    <th class="text-center">completed Kms</th>
                                    <th class="text-center">Route</th>
                                    <th class="text-center">Driver</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php 
                                $data = $this->vehicle_model->get_vehicle_details();
                                foreach ($data as $value) {
                                $exra_data = $this->vehicle_model->get_vehicle_last_trip_details($value->vehicle_id);
                                $route = "--";
                                $driver = "--";
                                $last_trip = "--";
                                
                                if (!empty($exra_data) && $value->vehicle_status == 2) {
                                        $status = '<span class="label label-danger">On Trip</span>';
                                        $route = $exra_data->route_origin." to ".$exra_data->route_destination;
                                        $driver = $exra_data->driver_name;
                                    }else{
                                        $status = '<span class="label label-success">Available</span>';
                                        // $last_trip = $exra_data->trip_stop_date;
                                   }
                                echo '<tr>
                                    <td>'.$value->vehicle_number.'</td>
                                    <td>'.$status.'</td>
                                    <td>'.$value->vehicle_current_reading.'</td>
                                    <td>'.$route.'</td>
                                   
                                    <td>'.$driver.'</td>
                                    <td value="'.$value->vehicle_id.'">
                                        <a  class="btn btn-info
                                        fa fa-edit"  data-toggle="modal" href="#modal-1" id="show_update_vform" data-toggle="tooltip" data-placement="down" title="Update"></a>
                                        <button data-toggle="tooltip" data-placement="top" title="Delete" id="delete" class="btn btn-danger fa fa-trash"></button>
                                    </td>
                                </tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
                
                
                <!-- /.row -->