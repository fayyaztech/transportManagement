<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function index()
    {
        echo "page not found";
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
