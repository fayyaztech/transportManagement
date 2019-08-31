<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operations extends CI_Controller
{

    public function index()
    {
        template($this);
    }
    public function expense_management()
    {
        template($this, 'expense');

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
