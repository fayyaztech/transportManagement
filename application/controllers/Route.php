<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Route extends CI_Controller
{

    public function index()
    {
        $data['route_info'] = $this->common_model->fetch_route();
        template($this, 'route', $data);
    }

    public function delete_route()
    {
        $route = $this->input->get('route_id');
        if ($this->routes_model->delete_route($route)) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function add_route_form()
    {
        $data['view'] = false;
        $data['action'] = 'new';
        if (null !== $this->input->get('action')) {
            $data['action'] = $this->input->get('action');
            $data['info'] = $this->routes_model->fetch_route_info($this->input->get('route_id'));
        }
        if ($this->input->get('view') == 'true') {
            $data['view'] = true;
        }
        $this->load->view('route/add_route_form', $data);
    }

    public function add_route()
    {
        $response = 0; //operation
        $post = $this->input->post();

        $validation = array(
            array('field' => "route_origin", 'rules' => 'required'),
            array('field' => "route_destination", 'rules' => 'required'),
            array('field' => "route_distance", 'rules' => 'required'),

        );
        $this->load->library('form_validation', $validation);

        if ($this->form_validation->run()) {
            $response = $this->routes_model->add_route($post);
        } else {
            $response = validation_errors();
        }
        echo $response;
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('routes_model');
    }

}
