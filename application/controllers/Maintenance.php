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

    public function mnt_forward_form()
    {
        // changer vehicle assigned vehicle form 
        $vehicle_list = $this->common_model->fetch_vehicle_list($vehicle_filter = "");
        $mnt_id = $this->input->get('mnt_id');

        $data = [
            'vehicle_list' => $vehicle_list,
            'mnt_id' => $mnt_id,
        ];
        $this->load->view('maintenance/mnt_forward_form', $data);

    }

    public function save_forward_mnt()
    {
        /* chage assigned vehicle */
        $post = $this->input->post();
        echo $this->maintenance_model->save_forward_mnt($post);
    }

    public function get_maintainance_form()
    {
        /* 
            * gernate form on ajax request 
            * new entry
            * view details
            * edit details
            * recycle old entry tyre remold || battry recharged
        */
        // action is type of request
        $action = $this->input->get('action');
        $data['action'] = $action;

        /* mnt type for Action
         * remold tyre
         * recharge battry
        default mnt is null
         */
        $data['mnt_recycle'] = false;

        // if mnt_type received
        if (null !== ($this->input->get('mnt_recycle'))) {
            $data['mnt_recycle'] = $this->input->get('mnt_recycle');
        }

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
            if ($this->input->get('mnt_id') == "") {
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

        $this->load->view('maintenance/maintenance_form', $data);
    }

    public function delete_mnt_record()
    {
        /* delete maintenance records */
        $mnt_id = $this->input->get('mnt_id');
        echo $this->maintenance_model->delete_record($mnt_id);

    }

    public function srap_mnt_record()
    {
        /* delete maintenance records */
        $mnt_id = $this->input->get('mnt_id');
        echo $this->maintenance_model->make_mnt_scrap($mnt_id);

    }

    public function add_maintenance()
    {
        /* save maintenance new data
         * update data
         * update recycled data
         */
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
