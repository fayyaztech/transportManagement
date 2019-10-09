<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function index()
    {
        echo anchor(base_url('report/trip?month=10&year=2019'), 'month Name 10 and year 2019');
    }

    public function driver()
    {
        $data = [];
        $this->load->view('reports/driver_report', $data);
        
    }
    public function trip()
    {
        $data = [];
        $this->load->view('reports/trip_report', $data);
        
    }

}

/* End of file Report.php */
