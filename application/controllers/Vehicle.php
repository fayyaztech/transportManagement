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
		$show_info = false;
		$vehicle_id = $this->input->get('vehicle_id');
		if ($vehicle_id != NULL) {
			if (!empty($data = $this->vehicle_model->fetch_single_vehicle_info($vehicle_id))) {
				$vehicle_data = $data;
			}
		}

		if ($this->input->get('action')=="show_info") {
			$show_info = true;
		}
		$this->load->view('vehicle/vehicle_form',['vehicle_data'=>$vehicle_data,'show_info'=>$show_info]);
	}


		public function add_vehicle()
	{
		/*
			* add new vehicle 
			* update old vehicle data 
		*/
		$data = $this->input->post();
		$config = array(
		array('field' =>'vehicle_number' ,'rules'=>'required|min_length[7]|max_length[10]'),
		array('field' =>'vehicle_purchase_date' ,'rules'=>'required|date'),
		array('field' =>'vehicle_current_reading' ,'rules'=>'required|numeric'),
		array('field' =>'vehicle_chassis_no' ,'rules'=>'required'),
		array('field' =>'vehicle_engine_no' ,'rules'=>'required'),
		array('field' =>'vehicle_tyres' ,'rules'=>'required|min_length[1]'),
		);

		$this->load->library('form_validation',$config);

		//form validation 
		if($this->form_validation->run() == true)
		{
			$resp = $this->vehicle_model->add_vehicle_info($data);
		}
		else
		{
			$resp = stripcslashes(validation_errors());
		}

		echo $resp;
	}

	public function delete_vehicle()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		if($data=$this->vehicle_model->delete_vehicle_info($vehicle_id))
		{
			echo "Record Deleted..";
		}
	}

	public function reactive_vehicle()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		if($data=$this->vehicle_model->reactive_vehicle($vehicle_id))
		{
			echo "vehicle reactivated ..";
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