<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance extends CI_Controller
{

    public function index()
    {
        //index function home page of maintaiance
        $vehicle_filter = "";
        if ($this->input->get('filter') !== null) {
            $vehicle_filter = $this->input->get('filter');
        }

        if ($this->input->get('filter') == 4) {
            $vehicle_filter = "";
        }

        $data = $this->common_model->fetch_vehicle_list($vehicle_filter);
        template($this, 'maintenance', ['data' => $data]);
    }

    public function get_maintainance_form()
    {
        //maintainance form for ajax request
        if(NULL === $this->input->get('v_id') && NULL === $this->input->get('v_name')){
            echo "vehicle not selected";
            die();
        }
        $data = [
            'vehicle_id'=>$this->input->get('v_id'),
            'vehicle_number'=>$this->input->get('v_name')
            
        ];
        $this->load->view('maintainance/maintainance_form', $data);
    }

    public function add_maintenance()
    {
        $data = $this->input->post();
        echo $this->maintenance_model->add_maintenance($data);
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('maintenance_model');
        
    }
}

/* End of file Maintenance_controller */
/* Location: ./application/controllers/Maintenance_controller */
