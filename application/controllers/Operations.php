<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operations extends CI_Controller
{

    public function index()
    {
        template($this);
    }

    public function freight_management()
    {
        template($this, 'freight');
    }

    public function load_management()
    {
        template($this, 'load');

    }

    public function maintenance()
    {

        $data = fetch_vehicle_list($this);
        //$tyre_info=$this->maintenance_model->fetch_tyre_info();
        template($this, 'maintenance', ['data' => $data]);
        //template($this,'maintenance');
    }

    public function driver_management()
    {
        template($this, 'driver');
    }

    public function route_management()
    {
        template($this, 'route');

    }
    public function trip_management()
    {
        template($this, 'trip');

    }
    public function expense_management()
    {
        template($this, 'expense');

    }

    public function client_management()
    {
        template($this, 'client');

    }

    public function personal_info()
    {
        $this->load->view('driver/personal_info');
    }

    public function driver_upload_info()
    {
        $this->load->view('driver/documents');
    }
    public function driver_uploads()
    {
        $this->load->view('driver/document_upload');
    }
    public function driver_salary_info()
    {
        $this->load->view('driver/wage_method');
    }
    public function add_route()
    {
        $this->load->view('route/add_route');
    }
    public function add_trip()
    {
        $this->load->view('trip/add_trip');
    }
    public function complete_trip()
    {
        $this->load->view('trip/complete_trip');
    }
    public function add_expense()
    {
        $this->load->view('expense/add_expense');
    }

    public function add_consignor()
    {
        $this->load->view('client/consignor');
    }

    public function add_consignee()
    {
        $this->load->view('client/consignee');
    }

    // __constructor(){
    //     _parent::
    //     $this->load->model('operations_model');
    // }
}

/* End of file Operations.php */
/* Location: ./application/controllers/Operations.php */
