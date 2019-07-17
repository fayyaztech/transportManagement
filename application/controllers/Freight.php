<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Freight extends CI_Controller {

	public function index()
	{
		
	}

	public function download_freight_excel()
	{
		$this->load->library('excel');
		
	}

}

/* End of file freight.php */
/* Location: ./application/controllers/freight.php */