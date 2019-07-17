<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {

	public function index()
	{
		echo "not Found";
	}

		public function add_vehicle()
	{
		$data=$this->input->post();
		$config= array(
		array('field' =>'vehicle_number' ,'rules'=>'required|min_length[7]|max_length[10]'),
		array('field' =>'vehicle_purchase_year' ,'rules'=>'required|exact_length[4]|numeric'),
		array('field' =>'vehicle_current_reading' ,'rules'=>'required|numeric'),
		array('field' =>'vehicle_chassis_no' ,'rules'=>'required'),
		array('field' =>'vehicle_engine_no' ,'rules'=>'required'),
		//array('field' =>'vehicle_expected_average' ,'rules'=>'required|max_length[10]'),
		array('field' =>'vehicle_tyres' ,'rules'=>'required|min_length[1]'),
		);

		$this->load->library('form_validation',$config);
		if($this->form_validation->run() == true)
		{
			if($this->vehicle_model->add_vehicle_info($data))
			{
				echo 'Record Saved.';
			}
			else
			{
				echo 'Failed Try Again.';		
			}
		}
		else
		{
			echo stripcslashes(validation_errors());
		}
	}

	public function update_vehicle()
	{
		$vehicle_id=$this->input->post('vehicle_id');
		$info=$this->input->post();
		unset($info['vehicle_id']);
		$config= array(
		array('field' =>'vehicle_number' ,'rules'=>'required|min_length[7]|max_length[10]'),
		array('field' =>'vehicle_purchase_year' ,'rules'=>'required|exact_length[4]|numeric'),
		array('field' =>'vehicle_current_reading' ,'rules'=>'required|numeric'),
		array('field' =>'vehicle_chassis_no' ,'rules'=>'required|min_length[17]'),
		array('field' =>'vehicle_engine_no' ,'rules'=>'required|min_length[10]'),
		array('field' =>'vehicle_expected_average' ,'rules'=>'required|min_length[1]'),
		array('field' =>'vehicle_tyres' ,'rules'=>'required|min_length[1]'),
		);

		$this->load->library('form_validation',$config);
		if($this->form_validation->run() == true)
		{
			if($this->vehicle_model->update_vehicle_info($vehicle_id,$info))
			{
				echo "Record Updated.";
			}
			else
			{
				echo "Failed Try Again.?";
			}
		}
		else
		{
			echo stripcslashes(validation_errors());
		}
	}

	public function delete_vehicle()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		if($data=$this->vehicle_model->delete_vehicle_info($vehicle_id))
		{
			echo "Record Deleted..";
		}
		else
		{

		}

	}

	public function fetch_vehicle_info()
	{
		$vehicle_id= $this->input->get('vehicle_id');
		
		$data=$this->vehicle_model->fetch_single_vehicle_info($vehicle_id);
		foreach ($data as $value) {
		echo 
		'<div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                    </button>
                </div>
                
                <form id="update_form" method="post" action="javascript:void(0);">
                <input value="'.$value->vehicle_id.'" type="hidden" class="form-control" required="required" name="vehicle_id">
                    <div class="modal-body">
                        <div class="card mx-auto">
                            <div class="card-header  text-lg-center">Add Vehicle</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstName">Vehicle Name</label>
                                            <input type="text" id="vehicle_number" name="vehicle_number" class="form-control" placeholder="Vehicle Name" required="required" autofocus="autofocus" value='.$value->vehicle_number.'>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastName">Maximum Capacity</label>
                                            <select id="input" name="vehicle_load_capacity" class="form-control" required="required">
                                                <option value='.$value->vehicle_load_capacity.'>'.$value->vehicle_load_capacity.'</option>
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
                                            <input type="text" id="vehicle_purchase_year" name="vehicle_purchase_year" class="form-control" placeholder="Purchase year" required="required" value='.$value->vehicle_purchase_year.'>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="purchase year">Start Km</label>
                                            <input type="text" name="vehicle_current_reading" class="form-control" placeholder="Start Km" required="required" value='.$value->vehicle_current_reading.'>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passing no">Chassis Number</label>
                                            <input type="text" id="vehicle_chassis_no" name="vehicle_chassis_no" class="form-control" placeholder="Chassis Number" required="required" value='.$value->vehicle_chassis_no.'>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passing no">Engine Number</label>
                                            <input type="text" id="vehicle_engine_no" name="vehicle_engine_no" class="form-control" placeholder="Engine Number" required="required" value='.$value->vehicle_engine_no.'> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passing no">Expected Average</label>
                                            <input type="text" id="vehicle_expected_average" name="vehicle_expected_average" class="form-control" placeholder="Expected Average" required="required" value='.$value->vehicle_expected_average.'>
                                        </div>
                                    </div>
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="purchase year">Number Of Tyres</label>
                                            <input type="text" id="vehicle_tyres" name="vehicle_tyres" class="form-control" placeholder="Number of Tyres" required="required" value='.$value->vehicle_tyres.'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" id="update_vehicle">Update Vehicle</button>
                        <input type="reset" class="btn btn-info" placeholder="Number of Tyres" required="required" >
                    </div>
                </form>
                </div>
                </div>';
            }
	}

	public function __construct()
	{
		parent::__construct();
		$this->load->model('vehicle_model');
	}

}

/* End of file Vehicle.php */
/* Location: ./application/controllers/Vehicle.php */