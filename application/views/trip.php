<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Trip management</h1>
                    
                    <button type="button" class="btn btn-info  pull-right" id="add-trip">
                    <i class="fa fa-plus-circle"></i> Add Trip
                    </button>
                    
                <br/><br/>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="trip_details">
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center" id="dataTable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Consignor Name</th>
                                            <th>Consignee Name</th>
                                            <th>Vehicle Number</th>
                                            <th>Advance</th>
                                            <th>Trip Start Date</th>
                                            <th>Trip End Date</th>
                                            <th>Route</th>
                                            <th>Driver</th>
                                            <th>Distance</th>
                                            <th>Expected Frieght</th>
                                            <th>Payment Recieved</th>
                                            <th>Incentive</th>
                                            <th>Steps</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $count = 1;
                                            $freight = "undefine";
                                            $row_span = "";
                                            foreach ($trip_info as $value) {
                                                $consignor_name = $value->consignor_name;
                                                $vehicle_number = $value->vehicle_number;
                                                $consignee_name = $value->consignee_name;
                                                unset($value->client_name);
                                                unset($value->vehicle_number);
                                                $trip_data[$value->trip_id]['client_details'] = ['consignor_name' => $consignor_name, 'vehicle_number' => $vehicle_number, 'consignee_name' => $consignee_name];
                                                $trip_data[$value->trip_id]['trip_details'][] = $value;
                                            }
                                    
                                            // var_dump($trip_info);
                                            // print_r($trip_data);
                                    
                                            if (!empty($trip_data)) {
                                                foreach ($trip_data as $k => $v) {
                                                    $loop_count = 1;
                                                    /*
                                                    @ $k is a key of array
                                                    @ $row_span used to arrange the display of table row
                                                     */
                                    
                                                    $row_span = count($trip_data[$k]['trip_details']);
                                                    // echo "<-----tr>";
                                                    echo
                                                    '<tr>
                                                        <td  style="vertical-align: middle;" rowspan="' . $row_span . '">' . $count++ . '</td>
                                                        <td  style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_data[$k]['client_details']['consignor_name'] . '</td>
                                                        <td  style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_data[$k]['client_details']['consignee_name'] . '</td>
                                                        <td  style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_data[$k]['client_details']['vehicle_number'] . '</td>
                                                        <td  style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_data[$k]['client_details']['vehicle_number'] . '</td>';
                                                    foreach ($trip_data[$k]['trip_details'] as $trip_d) {                                    
                                                        if ($loop_count != 1) {
                                                            echo "<tr>";}
                                
                                                        // print_r($trip_d);
                                                        $per_km = "";
                                    
                                                        if ($trip_d->trip_status == 0) {
                                    
                                                            $stop_button = '<button id="stop_trip" class="btn btn-danger text-danger fa fa-stop "></button>';
                                                            $step_button = '<button id="step_trip" class="btn btn-success text-danger fa fa-step-forward "></button>';
                                                        } else {
                                                            $stop_button = "";
                                                            $step_button = "";
                                                        }
                                    
                                                        // check if trip is empty
                                                        // 1 is empty || 0 is loaded
                                                        if ($trip_d->trip_details_is_loaded == 0) {
                                    
                                                            if ($trip_d->trip_detail_freight != 0) {
                                                                $freight = $trip_d->trip_detail_freight;
                                                            } else {
                                                                $load_route_id = $this->trip_model->get_load_route_id($trip_d->load_id, $trip_d->route_id);
                                                                if (empty($load_route_id)) {
                                                                    $freight = '<span class="label label-danger">freight not available For this route</span>';
                                                                } else {
                                    
                                                                    $freight = getCurrentFreight($this, $load_route_id);
                                                                }
                                                            }
                                                        } else {
                                                            $freight = '<span class="label label-danger">empty</span>';
                                                        }
                                                        // status 2 = running
                                                        if ($trip_d->trip_detail_status == 2) {
                                                            $status = "bg-success";
                                                            $add_advance_btn = '<button id="fetch_advance" class="btn btn-info fa fa-plus text-white">advance</button>';
                                                        } else {
                                                            $status = "bg-danger";
                                                            $add_advance_btn = "";
                                                        }
                                    
                                                        if ($trip_d->trip_stop_date == "0000-00-00") {
                                                            $stop_date = "-- -- --";
                                                        } else {
                                                            $stop_date = $trip_d->trip_stop_date;
                                                        }
                                                        echo ' <td>' . $trip_d->trip_start_date . '</td>
                                                            <td>' . $stop_date . '</td>
                                                   <td>' . $trip_d->route_origin . ' to ' . $trip_d->route_destination . '</td>
                                                   <td>' . $trip_d->driver_name . '</td>
                                                   <td>' . $trip_d->route_distance . '</td>';
                                                        echo '<td>' . $freight . '</td><td></td><td></td>';
                                    
                                                        echo '<td t_id="' . $trip_d->trip_details_id . '" v_id="' . $trip_d->vehicle_id . '">
                                                             <button id="update_trip" class="btn btn-success fa fa-edit text-primary"></button>';
                                                        if ($trip_d->trip_detail_status == 2) {
                                                            echo '<button id="stop_step_trip" class="btn btn-danger fa fa-stop text-danger"></button>';
                                                        }
                                    
                                                        echo $add_advance_btn . '
                                                         </td>';
                                                        if ($loop_count == 1) {
                                                            echo '<td t_id="' . $trip_d->trip_id . '" style="vertical-align: middle;" rowspan="' . $row_span . '">' . $step_button . " " . $stop_button . '</td></tr>';
                                                        } else {
                                                            echo "</tr>";
                                                        }
                                                        // echo "\n2nd loop End".$loop_count;
                                                        $loop_count++;
                                                    }
                                                    // echo "<-----/tr>";
                                                    // echo "\nloop end\n";
                                                    $loop_count = 0;
                                                }
                                            }
                                        
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>            
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        
                    </div>
                </div>
            </div>
            
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
        </div>
    </div>
</body>
