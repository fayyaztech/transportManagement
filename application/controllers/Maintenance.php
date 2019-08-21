<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance extends CI_Controller
{

    public function index()
    {
        //index function home page of maintaiance
        // default vehicle filter is blank
        $vehicle_filter = "";

        //default all recorde selected
        $mnt_records_filter = "";

        //if filter is not null select filter from get
        if ($this->input->get('filter') !== null) {
            $vehicle_filter = $this->input->get('filter');
        }

        // if filter as all set filter blank
        if ($this->input->get('filter') == 4) {
            $vehicle_filter = "";
        }

        //if vehicle selected get value from get
        if ($this->input->get('vehicle_id') !== null && $this->input->get('vehicle_id') != 'all') {
            $mnt_records_filter = $this->input->get('vehicle_id');
        }

        $vehicle_list = $this->common_model->fetch_vehicle_list($vehicle_filter);
        $maintenance_records = $this->maintenance_model->maintenance_records($mnt_records_filter);
        $data = [
            'vehicle_list' => $vehicle_list,
            'maintenance_records' => $maintenance_records,
        ];
        template($this, 'maintenance', $data);
    }

    public function get_maintainance_form()
    {
        // ajax request
        // action is type of request
        $action = $this->input->get('action');
        $data['action'] = $action;
        if ($action == "new") {
            //make a sure data not empty
            if (null === $this->input->get('v_id') && null === $this->input->get('v_name')) {
                echo "vehicle not selected";
                die();
            }

            //required vehicle data
            $data['vehicle_id'] = $this->input->get('v_id');
            $data['vehicle_number'] = $this->input->get('v_name');
        } elseif ($action == "edit" || $action == "view") {
            
            //make a sure data not empty
            if($this->input->get('mnt_id') == ""){
                echo "ERROR";
                die();
            }
            $mnt_id = $this->input->get('mnt_id');
            $mnt_record = $this->maintenance_model->single_maintenance_record($mnt_id);

            //require data 
            $data['mnt_record'] = $mnt_record;
            $data['vehicle_id'] = $mnt_record['vehicle_id'];
            $data['vehicle_number'] = $mnt_record['vehicle_number'];
        }
        $data['mnt_types'] = $this->maintenance_model->get_mnt_types();
        
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
