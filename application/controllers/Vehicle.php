<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {

	public function index()
	{
		$this->load->model('vehicle_model');
        template($this, 'vehicle');
	}

	public function vehicle_form()
	{
		// both add and update operation perform in single file
		$vehicle_data = [];
		$vehicle_id = $this->input->get('vehicle_id');
		if ($vehicle_id != NULL) {
			if (!empty($data = $this->vehicle_model->fetch_single_vehicle_info($vehicle_id))) {
				$vehicle_data = $data;
			}
		}
		$this->load->view('vehicle/vehicle_form',['vehicle_data'=>$vehicle_data]);
	}

		public function add_vehicle()
	{
		$data=$this->input->post();
		$config= array(
		array('field' =>'vehicle_number' ,'rules'=>'required|min_length[7]|max_length[10]'),
		array('field' =>'vehicle_purchase_date' ,'rules'=>'required|date'),
		array('field' =>'vehicle_current_reading' ,'rules'=>'required|numeric'),
		array('field' =>'vehicle_chassis_no' ,'rules'=>'required'),
		array('field' =>'vehicle_engine_no' ,'rules'=>'required'),
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

	public function __construct()
	{
		parent::__construct();
		$this->load->model('vehicle_model');
	}

}

/* End of file Vehicle.php */
/* Location: ./application/controllers/Vehicle.php */