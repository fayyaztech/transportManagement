<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Trip extends CI_Controller {
	public function get_routs()
	{
			foreach (fetch_route($this,$this->input->get('client_id')) as $value)
		{
				echo '<option value="'.$value->route_id.'">'.$value->route_origin.' To '.$value->route_destination.'</option>';
		}
	}
	public function get_loads()
		{
			echo '<option value="0">Market</option>';
					foreach (fetch_load($this,$this->input->get('client_id')) as $value)
				{
						echo '<option value="'.$value->load_id.'">'.$value->load_name.'</option>';
				}
		}
	
	public function index()
	{
		$trip_info=fetch_trip_list($this);
		$count=1;
		$row_span = "";
		foreach ($trip_info as $value) {
			$consignor_name = $value->consignor_name;
			$vehicle_number = $value->vehicle_number;
			$consignee_name = $value->consignee_name;
			unset($value->client_name);
			unset($value->vehicle_number);
			$trip_data[$value->trip_id]['client_details'] = ['consignor_name'=>$consignor_name,'vehicle_number'=>$vehicle_number,'consignee_name'=>$consignee_name];
			$trip_data[$value->trip_id]['trip_details'][] = $value;
		}
		// print_r($trip_data);
		if(!empty($trip_data))
		{
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
				
				
					<td  style="vertical-align: middle;" rowspan="'.$row_span.'">'.$count++.'</td>
					<td  style="vertical-align: middle;" rowspan="'.$row_span.'">'.$trip_data[$k]['client_details']['consignor_name'].'</td>
					<td  style="vertical-align: middle;" rowspan="'.$row_span.'">'.$trip_data[$k]['client_details']['consignee_name'].'</td>
					<td  style="vertical-align: middle;" rowspan="'.$row_span.'">'.$trip_data[$k]['client_details']['vehicle_number'].'</td>';
	             // echo "<pre>";
		             // print_r($trip_data[$k]);
		        foreach ($trip_data[$k]['trip_details'] as $trip_d) {
		        
		        // echo "\n2nd loop".$loop_count;
		        if ($loop_count != 1) {
		        echo "<tr>";
			        }
			        
			            $per_km = "";
			$stop_button = "";
			if($trip_d->trip_detail_freight == 0){
			$freight = getFreightRate($this,$trip_d->route_id,$trip_d->trip_start_date);
			$freight_expense = freight_calculator($trip_d->load_name,$trip_d->route_distance,$freight['freight_rate'],$freight['freight_cmvr']);
			}
			if($trip_d->trip_status==1)
			{
			$status="bg-warning";
			$total_run = 0;
			}
			elseif($trip_d->trip_status==2)
			{
			$status="bg-success";
			//$total_run = ($trip_d->vehicle_current_reading-$trip_d->trip_start_km);
			$stop_button = '<button id="stop_trip" class="btn btn-danger text-danger fa fa-stop "></button>';
			$step_button = '<button id="step_trip" class="btn btn-success text-danger fa fa-step-forward "></button>';
			}
			else{
			$status="bg-danger";
			// $total_run = ($trip_d->trip_end_km-$trip_d->trip_start_km);
			// $per_km = ceil($trip_d->trip_total_expense/$total_run);
			}
			if (empty($trip_d->trip_stop_date)) {
			$stop_date = "-- -- --";
			}else{
			$stop_date = $trip_d->trip_stop_date;
			}
			            echo ' <td>'.$trip_d->trip_start_date.'</td>
			            <td>'.$stop_date.'</td>
			   <td>'.$trip_d->route_origin.' to '.$trip_d->route_destination.'</td>
			   <td>'.$trip_d->driver_name.'</td>
			   <td>'.$trip_d->route_distance.'</td>';
		             echo '<td>'.$trip_d->trip_detail_freight.'</trip_d>';
		             
		             echo'<td t_id="'.$trip_d->trip_id.'" v_id="'.$trip_d->vehicle_id.'">
			             <button id="update_trip" class="btn btn-success fa fa-edit text-primary"> edit</button>
			              <button id="stop_step_trip" class="btn btn-danger fa fa-stop text-danger"> stop Step</button>
			              <button id="fetch_advance" class="btn btn-info fa fa-plus text-white"> add advance</button>
		             </td>';
		            if ($loop_count == 1) {
		             echo '<td style="vertical-align: middle;" rowspan="'.$row_span.'">'.$step_button." ".$stop_button.'</td></tr>'; 
		        }else{
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
	public function add_trip_step(){
	$post=$this->input->post();
	$config = array(
	     array("field"=>"driver_id", "rules"=>"required"),
	     array("field"=>"route_id", "rules"=>"required"),
	     array("field"=>"trip_type", "rules"=>"required"),
	  array("field"=>"trip_start_date", "rules"=>"required"),     
	);
	$this->load->library('form_validation', $config);
	if ($this->form_validation->run()) 
	{
	if ($this->trip_model->add_trip_step($post)) 
	{
	$resp['code'] = 1;
	$resp["msg"] = "Step Added Successfully.!";
	}else{
	$resp['code'] = 0;
	$resp["msg"] = "Failed to Add Step.!";
	}
	}else {
	$resp['code'] = 0;
	$resp["msg"] = validation_errors();
	}
	echo json_encode($resp);
	}
	// Add Trip Function
	public function add_trip()
	{
	$post=$this->input->post();
	$config = array(
	      array("field"=>"driver_id", "rules"=>"required"),
	      array("field"=>"consignor_id", "rules"=>"required"),
	      array("field"=>"consignee_id", "rules"=>"required"),
	   	  array("field"=>"route_id", "rules"=>"required"),
	      array("field"=>"load_id", "rules"=>"required"),
	      array("field"=>"vehicle_id", "rules"=>"required"),
	      array("field"=>"allowance", "rules"=>"numeric"),
	      array("field"=>"advance", "rules"=>"numeric"),
	);
	$this->load->library('form_validation', $config);
	if ($this->form_validation->run()) 
	{
				$advance = $this->input->post('advance');
				$driver_id = $this->input->post('driver_id');
				unset($_POST['advance']);
				$step['driver_id'] = $this->input->post('driver_id');
				$step['load_id'] = $this->input->post('load_id');
				$step['route_id'] = $this->input->post('route_id');
				$step['trip_status'] = 2;
				$step['trip_start_date'] = $this->input->post('trip_start_date');
				$step['trip_detail_freight'] = $this->input->post('trip_detail_freight');
				unset($_POST['driver_id']);
			if ($trip_id = $this->trip_model->save_trip_info($post)) 
				{
				
				$step['trip_id'] = $trip_id;
				//$step['trip_start_date'] = $date;
					$this->trip_model->add_trip_step($step);
				    add_advance($this,$trip_id,$advance);
					update_driver_status($this,['driver_id'=>$post['driver_id'],'driver_running_status'=>1]);
					update_vehicle_status($this,$this->input->post('vehicle_id'),2);
						$resp['code'] = 1;
						$resp["msg"] = "Trip Added Successfully.!";
				}else{
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
	public function add_advance(){
	$post=$this->input->post();
	$config = array(
	     array("field"=>"advance_amount", "rules"=>"required"),
	   array("field"=>"advance_date", "rules"=>"required"),      
	);
	$this->load->library('form_validation', $config);
	if ($this->form_validation->run()) 
	{
	if ($trip_id = $this->trip_model->add_advance($post)) 
	{
	$resp['code'] = 1;
	$resp["msg"] = "advance Added Successfully.!";
	}else{
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
	$post=$this->input->post();
	$config = array(
	     array("field"=>"driver_id", "rules"=>"required"),
	    array("field"=>"route_id", "rules"=>"required"),
	      array("field"=>"allowance", "rules"=>"numeric"),
	      array("field"=>"advance", "rules"=>"numeric"),
	);
	$this->load->library('form_validation', $config);
	if ($this->form_validation->run()) 
	{
	if ($this->trip_model->update_trip_info($post)) 
	{
	$resp['code'] = 1;
	$resp["msg"] = "Trip Update Successfully.!";
	}else{
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
	$post=$this->input->post();
	$vers = ['vehicle_id'=>$post['vehicle_id'],'vehicle_current_reading'=>$post['trip_end_km'],'vehicle_status'=>1];
	if (!check_current_reading_greater($this,$vers)) {
	$resp['code'] = 0;
	$resp["msg"] = 'please check kilometer reading you provided is lower than older ';
	echo json_encode($resp);
	die();
	}
	$config = array(
	     array("field"=>"trip_end_km", "rules"=>"required|numeric"),
	);
	$this->load->library('form_validation', $config);
	if ($this->form_validation->run()) {
	if ($this->trip_model->stop_trip_info($post)) 
	{
	update_vehicle_km($this,$vers);
	$driver_id = getDriverIDByTripId($this,$post['trip_id']);
	$d = array('driver_id'=>$driver_id,'driver_running_status'=>0);
	update_driver_status($this,$d);
	$resp['code'] = 1;
	$resp["msg"] = "Trip Added Successfully.!";
	}else{
	$resp['code'] = 0;
	$resp["msg"] = "Failed to Add Trip.!";
	}
	} 
	else {
	$resp['code'] = 0;
	$resp["msg"] = validation_errors();
	}
	echo json_encode($resp);
	}
	public function fetch_advance_form(){
	$trip_id=$this->input->get('trip_id');
	echo
	'<div class="row">
		    <div class="col-md-8 col-md-offset-2">
			     <form action="javascript:void();" method="post" id="add_advance" accept-charset="utf-8">
				        <div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="text-center">Add Trip Step</h3>
					</div>
					<div class="panel-body">
						
						<input type="hidden" name="trip_id" class="form-control"  value="'.$trip_id.'" >
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
			public function fetch_trip_step(){
			$trip_id=$this->input->get('trip_id');
			// $trip_info=$this->trip_model->fetch_trip_info($trip_id);
			// foreach ($trip_info as $key => $value) {
			echo'<div class="row">
				<div class="col-md-8 col-md-offset-2">
					   <form action="javascript:void();" method="post" id="save_trip_step" accept-charset="utf-8">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h3 class="text-center">Add Trip Step</h3>
							</div>
							<div class="panel-body">
								
								<input type="hidden" name="trip_id" class="form-control"  value="'.$trip_id.'" >
								<div class="row">
									
									<div class="col-md-2">
										<div class="form-group">
											<label for="select origin">Route<span class="text-danger">*</span></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<select name="route_id" id="route_id" class="form-control" required="required">
												';
												foreach (fetch_route($this) as $val) 
												                {   
												                    echo '<option value="'.$val->route_id.'">'.$val->route_origin.' To '.$val->route_destination.'</option>';
												                }
												                echo'
											</select>
										</div>
									</div>
									<div class="col-md-2">
										                                                <div class="form-group">
											                                                    <label for=""><span class="text-danger">*</span>
											                                                    Trip Type
										                                                </label>
									                                            </div>
								                                        </div>
								                                        <div class="col-md-4">
									                                            <select name="trip_type" id="trip_type" class="form-control" required="required">
										                                                
										                                                <option value="0">Empty Trip</option>
										                                               
										                                                
									                                            </select>
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
											';
											foreach (fetch_driver($this) as $val) 
											                {   
											                    echo '<option value="'.$val->driver_id.'">'.$val->driver_name.'</option>';
											                }
										echo '</select>
									</div>
								</div>
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
							</div>
							<button type="button" class="btn btn-danger pull-right" data-dismiss="modal">close</button>
							<button type="submit" class="btn btn-success pull-right btn-md">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>';
		}
		// Fetching Trip Data For Update
		public function fetch_trip_info()
		{
		$trip_id=$this->input->get('trip_id');
		echo '<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<form action="javascript:void();" method="post" id="update_trip_form" accept-charset="utf-8">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="text-center">Add Trip</h3>
						</div>
						<div class="panel-body">
							<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-2">
								
								<input type="hidden" name="trip_id" class="form-control"  value="'.$trip_id.'" >
								
								
								
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
												foreach (fetch_driver($this) as $val) 
												                {   
												                    echo '<option value="'.$val->driver_id.'">'.$val->driver_name.'</option>';
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
												foreach (fetch_route($this) as $val) 
												                {   
												                    echo '<option value="'.$val->route_id.'">'.$val->route_origin.' To '.$val->route_destination.'</option>';
												                }
												                echo'
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