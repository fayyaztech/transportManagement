<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{

    public function index()
    {
    	$filter = 1;
    	if ($this->input->get('filter') !== NULL) {
    		$filter = $this->input->get('filter');
    	}
        $driver_data = $this->driver_model->driverManagement($filter);
        template($this, 'driver',['driver_data'=>$driver_data]);
    }

    public function add_driver_info()
    {
        $post = $this->input->post();
        unset($post['address_check']);
        $config = array(
            array("field" => "driver_name", "rules" => "required"),
            array("field" => "driver_number", "rules" => "required|numeric|min_length[10]"),
            array("field" => "driver_permanent_address", "rules" => "required"),
        );

        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {
            $responce = $this->driver_model->save_diver_info($post);
            echo $responce;
        } else {
            echo validation_errors();
        }

    }


    public function driver_form()
    {
    	$driver_data = [];
    	if (isset($_GET['driver_id'])) {
    		$driver_data = $this->driver_model->fetch_driver_info($this->input->get('driver_id'));
    	}
        $this->load->view('driver/driver_form',['driver_data'=>$driver_data]);
    }

    public function update_driver_info()
    {
        $post = $this->input->post();

        $config = array(
            array("field" => "driver_name", "rules" => "required"),
            array("field" => "driver_number", "rules" => "required|numeric|min_length[10]"),
            array("field" => "driver_permanent_address", "rules" => "required"),
        );
        $this->load->library('form_validation', $config);

        if ($this->form_validation->run()) {
            if ($this->driver_model->update_driver_info($post)) {
                $resp['code'] = 1;
                $resp["msg"] = "driver updated successfully !";

            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to update driver !";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }

        echo json_encode($resp);

    }

    public function delete_driver()
    {

        $driver_id = $this->input->get('driver_id');
        echo $this->driver_model->delete_driver_info($driver_id);
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('driver_model');
    }
}

/* End of file Driver.php */
/* Location: ./application/controllers/Driver.php */
