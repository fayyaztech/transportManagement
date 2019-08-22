<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Trip extends CI_Controller
{

    public function stop_step()
    {
    	$data = $this->trip_model->fetch_step_details($this->input->post('trip_step_id'));
        if ($this->trip_model->stop_step($this->input->post())) {
        	update_driver_status($this,['driver_id'=>$data->driver_id,"driver_running_status"=>1]);
        	// update_vehicle_status($this, $, $status);
        	
            echo "trip Stoped";
        } else {
            echo "failed to stop ";
        }
    }

    public function fetch_stop_step_trip()
    {

        $trip_step_id = $this->input->get('trip_id');

        echo '

            <div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="javascript:void();" method="post" id="stop_trip_step_form" accept-charset="utf-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center">Add Trip Step</h3>
                </div>
                <div class="panel-body">

                    <input type="hidden" name="trip_step_id" class="form-control" value="' . $trip_step_id . '">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="select origin">Stop Date<span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" name="trip_stop_date">
	</div>
	</div>

            </div>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">close</button>
            <button type="submit" class="btn btn-success pull-right btn-md">Submit</button>
            </div>
            </div>
            </form>
            </div>
            </div>

        ';
    }
    public function get_consignee()
    {
        $cosignor_id = $this->input->get('consignor_id');
        echo '<option value="">Select</option>';
        foreach (fetch_consignee($this, $cosignor_id) as $value) {
            echo '<option value="' . $value->consignee_id . '">' . $value->consignee_name . '</option>';
        }

    }

    public function get_routs()
    {
        foreach (fetch_route($this, $this->input->get('client_id')) as $value) {
            echo '<option value="' . $value->route_id . '">' . $value->route_origin . ' To ' . $value->route_destination . '</option>';
        }
    }
    public function get_loads()
    {
        echo '
		<option value="">Select</option>
		<option value="0">Market</option>
		';
        foreach (fetch_load($this, $this->input->get('consignor_id')) as $value) {
            echo '<option value="' . $value->load_id . '">' . $value->load_name . '</option>';
        }
    }

    public function index()
    {
        // $this->output->enable_profiler(TRUE);

        $trip_info = fetch_trip_list($this);
        // echo "<pre>";
        // print_r($trip_info);
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

        // print_r($trip_data);

        if (!empty($trip_data)) {
            foreach ($trip_data as $k => $v) {
                // echo "loop Start";
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
					<td  style="vertical-align: middle;" rowspan="' . $row_span . '">' . $trip_data[$k]['client_details']['vehicle_number'] . '</td>';
                // echo "<pre>";
                // print_r($trip_data[$k]);
                foreach ($trip_data[$k]['trip_details'] as $trip_d) {

                    if ($loop_count != 1) {
                        echo "<tr>";
                    }

                    // print_r($trip_d);
                    $per_km = "";
                    
                    if ($trip_d->trip_status == 0) {
                    	
                    $stop_button = '<button id="stop_trip" class="btn btn-danger text-danger fa fa-stop "></button>';
					$step_button = '<button id="step_trip" class="btn btn-success text-danger fa fa-step-forward "></button>';
                    }else{
                    	$stop_button = "";
                    	$step_button = "";
                    }

                    // check if trip is empty
                    // 1 is empty || 0 is loaded
                    if ($trip_d->trip_details_is_loaded == 0) {

	                    if ($trip_d->trip_detail_freight != 0) {
	                        $freight = $trip_d->trip_detail_freight;
	                    }else {
	              
		                        $load_route_id = $this->trip_model->get_load_route_id($trip_d->load_id, $trip_d->route_id);
		                        if (empty($load_route_id)) {
		                        	$freight = '<span class="label label-danger">freight not available For this route</span>';
		                        }else{

		                        	$freight = getCurrentFreight($this, $load_route_id);
		                        }
	                    }
                }else{
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

                    echo $add_advance_btn.'
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
    }
    
    //Add step Trip
    public function add_trip_step()
    {
        $old_driver_id = $this->input->post('old_driver_id');
        unset($_POST['old_driver_id']);
        $post = $this->input->post();
        $config = array(
            array("field" => "driver_id", "rules" => "required"),
            array("field" => "route_id", "rules" => "required"),
            array("field" => "load_id", "rules" => "required"),
            array("field" => "trip_start_date", "rules" => "required"),
        );
        $this->load->library('form_validation', $config);

        //check trip empty or loaded
        $post['trip_detail_status'] = 2;
        if ($this->input->post('load_id') == 0) {
        	$post['trip_details_is_loaded'] = 1;
        }




        

        if ($this->form_validation->run()) {

            if ($this->trip_model->add_trip_step($post)) {

            	/*
        check driver old or new 
        	* if driver is new then update old driver status as free
        	*/

        if ($this->input->post('driver_id') != $old_driver_id) {
        	update_driver_status($this, ["driver_id"=>$old_driver_id,"driver_running_status"=>0]);
        	update_driver_status($this, ["driver_id"=>$this->input->post('driver_id'),"driver_running_status"=>1]);
        }

                $resp['code'] = 1;
                $resp["msg"] = "Step Added Successfully.!";
            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to Add Step.!";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }
        echo json_encode($resp);
    }
    // Add Trip Function
    public function add_trip()
    {
        $post = $this->input->post();
        $config = array(
            array("field" => "driver_id", "rules" => "required"),
            array("field" => "consignor_id", "rules" => "required"),
            array("field" => "consignee_id", "rules" => "required"),
            array("field" => "route_id", "rules" => "required"),
            array("field" => "load_id", "rules" => "required"),
            array("field" => "vehicle_id", "rules" => "required"),
            array("field" => "allowance", "rules" => "numeric"),
            array("field" => "advance", "rules" => "numeric"),
        );
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {
            $advance = $this->input->post('advance');
            $driver_id = $this->input->post('driver_id');
            unset($_POST['advance']);
            $step['driver_id'] = $this->input->post('driver_id');
            $step['load_id'] = $this->input->post('load_id');
            $step['route_id'] = $this->input->post('route_id');
            $step['trip_detail_status'] = 2;
            $step['trip_start_date'] = $this->input->post('trip_start_date');
            $step['trip_detail_freight'] = $this->input->post('trip_detail_freight');
            unset($_POST['driver_id']);
            if ($trip_id = $this->trip_model->save_trip_info($post)) {

                $step['trip_id'] = $trip_id;
                //$step['trip_start_date'] = $date;
                $this->trip_model->add_trip_step($step);
                $this->trip_model->add_advance(['trip_id' => $trip_id, 'advance_amount' => $advance, 'advance_date' => $step['trip_start_date']]);
                update_driver_status($this, ['driver_id' => $post['driver_id'], 'driver_running_status' => 2]);
                update_vehicle_status($this, $this->input->post('vehicle_id'), 2);
                $resp['code'] = 1;
                $resp["msg"] = "Trip Added Successfully.!";
            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to Add Trip.!";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }
        echo json_encode($resp);
    }

    // Update Trip Function
    public function add_advance()
    {
        $post = $this->input->post();
        $config = array(
            array("field" => "advance_amount", "rules" => "required"),
            array("field" => "advance_date", "rules" => "required"),
        );
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {
            if ($trip_id = $this->trip_model->add_advance($post)) {
                $resp['code'] = 1;
                $resp["msg"] = "advance Added Successfully.!";
            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to Add advance.!";
            }

            echo json_encode($resp);
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }
    }
    public function update_trip()
    {
        $post = $this->input->post();
        $config = array(
            array("field" => "driver_id", "rules" => "required"),
            array("field" => "route_id", "rules" => "required"),
            array("field" => "allowance", "rules" => "numeric"),
            array("field" => "advance", "rules" => "numeric"),
        );
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {
            if ($this->trip_model->update_trip_info($post)) {
                $resp['code'] = 1;
                $resp["msg"] = "Trip Update Successfully.!";
            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to Update Trip.!";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }
        echo json_encode($resp);
    }
    // Stop Trip Function
    public function stop_trip()
    {
        $post = $this->input->post();
        $config = array(
            array("field" => "trip_stop_date", "rules" => "required"),
            array('field' => "trip_id", "rule" => "required" )
        );
        // print_r($post);
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {

        	//make sure trip not running
            if (!empty($data = $this->trip_model->get_incomplet_trips($post['trip_id']))) {
            	foreach ($data as $d) {
            		$this->trip_model->stop_step(['trip_details_id'=>$d->trip_details_id,"trip_stop_date"=>$post['trip_stop_date']]);
            	}
            }

            if ($this->trip_model->stop_trip($post)) {
            	$vehicle_id = $this->trip_model->get_vehicle($post['trip_id']);
	            update_vehicle_status($this, $vehicle_id, 1);
            	$resp['code'] = 1;
            	$resp["msg"] = "trip Stoped";
            }





        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }
        echo json_encode($resp);
    }
    public function fetch_advance_form()
    {
        $trip_id = $this->input->get('trip_id');
        echo
            '<div class="row">
		    <div class="col-md-8 col-md-offset-2">
			     <form action="javascript:void();" method="post" id="add_advance" accept-charset="utf-8">
				        <div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="text-center">Add Trip Step</h3>
					</div>
					<div class="panel-body">

						<input type="hidden" name="trip_id" class="form-control"  value="' . $trip_id . '" >
						<div class="row">

							<div class="col-md-2 col-md-offset-3">
								<div class="form-group">
									<label for="select origin">Advance
										<span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										    <input type="text" name="advance_amount" class="form-control"  value="" required="required">
									</div>
								</div>

							</div>
							<div class="row">

								<div class="col-md-2 col-md-offset-3">
									<div class="form-group">
										<label for="select origin">Date
											<span class="text-danger">*</span></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											    <input type="date" name="advance_date" class="form-control"  value="" required="required">
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-offset-5 col-md-4">
										<input type="submit" class="btn btn-primary pull-right"/>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			    </div>';
    }
    public function fetch_trip_step()
    {
    	// $this->output->enable_profiler(TRUE);
        $trip_id = $this->input->get('trip_id');
        $trip_details = $this->trip_model->fetch_trip_details($trip_id);

        // print_r($trip_details);
        

        echo '<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="javascript:void();" method="post" id="save_trip_step" accept-charset="utf-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center">Add Trip Step</h3>
                </div>
                <div class="panel-body">

                    <input type="hidden" name="trip_id" class="form-control" value="' . $trip_id . '">
                    <input type="hidden" name="old_driver_id" class="form-control" value="' . $trip_details->driver_id . '">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="select origin">Route<span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="route_id" id="route_id" class="form-control" required="required">';
        foreach (fetch_route($this) as $val) {
            echo '<option value="' . $val->route_id . '">' . $val->route_origin . ' To ' . $val->route_destination . '</option>';
        }
        echo '
											</select>
	</div>
	</div>
	<div class="col-md-2">
	    <div class="form-group">
	        <label for=""><span class="text-danger">*</span>
	            select Load
	        </label>
	    </div>
	</div>

	<input type="hidden" name="trip_id" value="'.$trip_details->trip_id.'">
	<div class="col-md-4">
	    <select name="load_id" id="trip_type" class="form-control" required="required">

	        <option value="0">Empty Trip</option>
	        ';
	        
	        foreach (fetch_load($this, $trip_details->consignor_id) as $v) {
	        	echo '<option value="'.$v->load_id.'">'.$v->load_name.'</option>';
	        }
	    echo '</select>
	</div>
	</div>
	<div class="row">
	    <div class="col-md-2">
	        <div class="form-group">
	            <label for="select driver">Select Driver<span class="text-danger">*</span></label>
	        </div>
	    </div>
	    <div class="col-md-4">
	        <div class="form-group">
	            <select name="driver_id" id="driver_id" class="form-control" required="required">
	            <option value="'.$trip_details->driver_id.'">continued as old</option>';
        foreach (fetch_driver($this) as $val) {
            echo '<option value="' . $val->driver_id . '">' . $val->driver_name . '</option>';
        }
        echo '
            </select>
            </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="select truck">Trip start Date</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input type="date" name="trip_start_date" id="inputTrip_date" class="form-control" value="" required="required"
                        title="">
                </div>
            </div>
            </div>
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">close</button>
            <button type="submit" class="btn btn-success pull-right btn-md">Submit</button>
            </div>
            </div>
            </form>
            </div>
            </div>
        ';
    }
    // Fetching Trip Data For Update
    public function fetch_trip_info()
    {
        $trip_id = $this->input->get('trip_id');
        echo '<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form action="javascript:void();" method="post" id="update_trip_form" accept-charset="utf-8">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="text-center">Add Trip</h3>
						</div>
						<div class="panel-body">
							<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-2">

								<input type="hidden" name="trip_id" class="form-control"  value="' . $trip_id . '" >



								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label for="select driver">Select Driver<span class="text-danger">*</span></label>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<select name="driver_id" id="driver_id" class="form-control" required="required">
												';
        foreach (fetch_driver($this) as $val) {
            echo '<option value="' . $val->driver_id . '">' . $val->driver_name . '</option>';
        }
        echo '</select>
										</div>
									</div>

								</div>

								<div class="row">

									<div class="col-md-2">
										<div class="form-group">
											<label for="select Route">Route<span class="text-danger">*</span></label>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<select name="route_id" id="route_id" class="form-control" required="required">
												';
        foreach (fetch_route($this) as $val) {
            echo '<option value="' . $val->route_id . '">' . $val->route_origin . ' To ' . $val->route_destination . '</option>';
        }
        echo '
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
									<div class="col-md-8">
										<div class="form-group">
											<input type="text" value="" name="allowance" class="form-control" placeholder="allowance"  autofocus="autofocus">
										</div>
									</div>

								</div>

								<button type="button" class="btn btn-danger pull-right" data-dismiss="modal">close</button>
								<button type="submit" class="btn btn-success pull-right btn-md">Update</button>
							</div>

						</div>

					</div>
				</form>
			</div>
		</div>
	</div>';
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->model('trip_model');
    }
}

/* End of file Trip.php */
/* Location: ./application/controllers/Trip.php */
