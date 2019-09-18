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

                    <br /><br />
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
                                        <th>Driver</th>
                                        <th>Advance</th>
                                        <th>Payment Received</th>
                                        <th>Incentive</th>
                                        <th>Trip Start Date</th>
                                        <th>Trip End Date</th>
                                        <th>Route</th>
                                        <th>Distance</th>
                                        <th>Expected Freight</th>
                                        <th>Steps</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
/**Trip Table start */
/**defined variables
 * $trip_data contained all data regarding to the trip,
 * trip data have 2 arrays client details and trip step details
 * $trip_details contains trip step part from $trip_data
 * $client_details contains trip fixed and client details from $trip_data
 */

// echo "<pre>";
// separating client details and trip details
foreach ($trip_data as $td) {
    $consignor_name = $td['consignor_name'];
    $vehicle_number = $td['vehicle_number'];
    $consignee_name = $td['consignee_name'];
    $driver_name = $td['driver_name'];
    $trip_id = $td['trip_id'];
    unset($td['client_name']);
    unset($td['vehicle_number']);
    $trip[$trip_id]['client_details'] = ['driver_name'=>$driver_name,'consignor_name' => $consignor_name, 'vehicle_number' => $vehicle_number, 'consignee_name' => $consignee_name, 'trip_id' => $trip_id];
    $trip[$trip_id]['trip_details'][] = $td;
}

// print_r($trip);
//make a sure trip data is not empty

if (!empty($trip)) {
    /**row count count row for row span */
    foreach ($trip as $key => $val) {
        $trip_details = $trip[$key]['trip_details'];
        $trip_client = $trip[$key]['client_details'];
        $row_span = count($trip_details);
        $steps_count = 0;
        // var_dump($trip_details);
        echo '<tr>
            <td style="vertical-align: middle;" rowspan="' . $row_span . '">' . 1 . '</td>
            <td style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_client['consignor_name'] . '</td>
            <td style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_client['consignee_name'] . '</td>
            <td style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_client['vehicle_number'] . '</td>
            <td style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_client['driver_name'] . '</td>
            <td style="vertical-align: middle;" rowspan="' . $row_span . '">' . 1500 . '</td>
            <td style="vertical-align: middle;" rowspan="' . $row_span . '">' . $this->common_model->received_payments(['trip_id' => $trip_client['trip_id'], 'payment_received_type' => 0]) . '</td>
            <td style="vertical-align: middle;" rowspan="' . $row_span . '">' . $this->common_model->received_payments(['trip_id' => $trip_client['trip_id'], 'payment_received_type' => 1]) . '</td>';

        $trip_step_option = [];
        #trip option
        $trip_option['run_new_step'] = "Run New Step";
        $trip_option['trip_update'] = 'Edit Trip Details';
        $trip_option['trip_advance'] = "Pay Advance";
        $trip_option['trip_received_payment'] = "Received Payment";
        $trip_option['trip_received_incentive'] = "Received Incentive";
        $trip_option['trip_expenses'] = "Trip Expenses";
        $trip_option['trip_stop'] = 'END Trip';
        $trip_option['trip_delete'] = 'DELETE TRIP';

        foreach ($trip_details as $d) {
            /**OPtions
             * $trip_step_stop
             * $trip_update_btn
             * $add_advance_btn
             */

            if ($d['trip_detail_status'] != 3) {
                $trip_step_option['step_update'] = 'Update';
                $trip_step_option['step_stop'] = 'End step';
                unset($trip_step_option['no_option']);
            } else {
                unset($trip_step_option['step_update']);
                unset($trip_step_option['step_stop']);
                $trip_step_option['no_option'] = 'no option available';
            }

            /**if trip end date is empty */
            $stp_date = $d["step_end_date"];
            if ($stp_date == "0000-00-00") {$stp_date = '
            <span class="label label-success">Running...</span>
            ';}

            /**Freight and its labels  */
            if ($d['trip_details_is_loaded'] == 0) {
                if ($td['trip_detail_freight'] != 0) {
                    $freight = $td['trip_detail_freight'];
                } else {
                    $load_route_id = $this->common_model->get_load_route_id($d['load_id'], $d['route_id']);
                    if (empty($load_route_id)) {
                        $freight = '<span class="label label-danger">freight not available For this route</span>';
                    } else {
                        $freight = getCurrentFreight($this, $load_route_id);
                    }
                }
            } else {
                $freight = '<span class="label label-danger">empty</span>';
            }

            if ($steps_count > 0) {echo "<tr>";}
            echo '<td>' . $d["step_start_date"] . '</td>';
            echo '<td>' . $stp_date . '</td>';
            echo '<td>' . $d["route_origin"] . '-' . $d["route_destination"] . '</td>';
            //echo '<td>' . $d["driver_name"] . '</td>';
            echo '<td>' . $d["route_distance"] . '</td>';
            echo '<td>' . $freight . '</td>';
            echo '<td trip_id="' . $d['trip_id'] . '" step_id="' . $d['trip_details_id'] . '" v_id="' . $d['vehicle_id'] . '">';
            echo '<select class="btn trip_step_option">';
            echo '<option> select Option</option>';
            foreach ($trip_step_option as $kk => $vl) {
                echo '<option value="' . $kk . '">' . $vl . '</option>';
            }
            echo '</select>';
            echo '</td>';
            if ($steps_count > 0) {echo "</tr>";}
            if ($steps_count == 0) {
                echo '<td trip_id="' . $d['trip_id'] . '" style="vertical-align: middle;" rowspan="' . $row_span . '">';
                echo '<select class="btn trip_option">';
                echo '<option>select Option</option>';
                foreach ($trip_option as $kk => $vl) {
                    echo '<option value="' . $kk . '">' . $vl . '</option>';
                }
                echo '</select>';
                echo '</td>';
                echo '</tr>';
            }
            $steps_count++;
        }

    }
}

/**Trip Table End */
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