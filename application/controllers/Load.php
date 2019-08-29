<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Load extends CI_Controller
{

    public function index()
    {
        $data['load_info'] = $this->load_model->fetch_load_records();
        template($this, 'load', $data);
    }

    public function get_form()
    {
        $data['edit'] = false;
        if (null !== $this->input->get('load_id')) {
            $data['load_id'] = $this->input->get('load_id');
            $data['load_data'] = $this->load_model->fetch_load($data['load_id']);
            $data['edit'] = true;
        }
        $this->load->view('load/add_load_form', $data);

	}
	
    public function delete_load()
    {
        if($this->load_model->delete_load($this->input->get('load_id'))){
			echo "record deleted";
		}
    }

    public function add_load()
    {
        $response = 0; //operation failed
        $post = $this->input->post();
        $validation = array(
            array('field' => "load_name", 'rules' => 'required'),
            array('field' => "consignor_id", 'rules' => 'required'),
        );
        $this->load->library('form_validation', $validation);
        if ($this->form_validation->run()) {
            $response = $this->load_model->add_load($post);
        } else {
            $response = validation_errors();
        }
        echo $response;
    }
    public function __construct()
    {
        parent::__construct();
        $this->load->model('load_model');
    }

}

/* End of file Load.php */
/* Location: ./application/controllers/Load.php */
