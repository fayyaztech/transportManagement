<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Load extends CI_Controller {

	public function index()
	{
		$count = 1;	
		$load_info = $this->loads_model->fetch_load_records();
		foreach ($load_info as  $value) {
			echo'
				<tr>
					<td>'.$count++.'</td>
					<td>'.$value->load_name.'</td>
					<td>'.$value->route_origin.'-'.$value->route_destination.'</td>
					<td>'.$value->consignor_name.'</td>
					<td>'.$value->route_distance.' Km</td>
					<td>'.$value->freight.'</a>
                    </td>
				</tr>
			';
		}
	}

	public function add_load(){
		$post = $this->input->post();
		
		$validation = array(
			array('field'=>"load_name", 'rules'=>'required'),
			array('field'=>"consignor_id", 'rules'=>'required'),
			array('field'=>"route_id", 'rules'=>'required'),
			array('field'=>"freight", 'rules'=>'required'),

		);
		$this->load->library('form_validation', $validation);
		
		if ($this->form_validation->run()) {
			if ($this->loads_model->add_load($post)) {
				$resp['code'] = 1;
				$resp["msg"] = "load added sucessfully!";
			}else{
				$resp['code'] = 0;
				$resp["msg"] = "Failed to add !";
			}
		} else {
			$resp['code'] = 0;
			$resp["msg"] = validation_errors();
		}

		echo json_encode($resp);
	}
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('loads_model');
	}

}

/* End of file Load.php */
/* Location: ./application/controllers/Load.php */