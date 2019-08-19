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
                <a class="btn btn-warning pull-right add_vehicle" style="margin-right: 40px;" href='#'>Add vehicle</a>
            </div>
            <br>
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
            <div class="row">                            
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
                                            $data = [];
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
                <div class="modal fade" id="modal">
                    <div class="modal-dialog modal_containt">
                        
                    </div>
                </div>
            </body>
            
            
            <!-- /.row -->