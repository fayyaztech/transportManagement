<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Route extends CI_Controller
{

    public function index()
    {
        $data['route_info'] = $this->routes_model->fetch_route();
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
        $data = [];
        $this->load->view('route/add_route_form', $data);
    }

    public function add_route()
    {
        $post = $this->input->post();

        $validation = array(
            array('field' => "route_origin", 'rules' => 'required'),
            array('field' => "route_destination", 'rules' => 'required'),
            array('field' => "route_distance", 'rules' => 'required'),

        );
        $this->load->library('form_validation', $validation);

        if ($this->form_validation->run()) {
            if ($this->routes_model->add_route($post)) {
                $resp['code'] = 1;
                $resp["msg"] = "route added sucessfully!";
            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to add !";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }

        echo json_encode($resp);
    }

    public function fetch_update_freight_form()
    {
        $route_id = $this->input->get('route_id');

        $route_info = $this->routes_model->single_route($route_id);

        foreach ($route_info as $value) {
            echo '
					<form action="javascript:void();" method="Post" id="update_route_submit" accept-charset="utf-8">
				<div class="panel">
				<div class="panel-heading bg-primary">
					<h3 class="text-center">Update freight Rate</h3>
				</div>
				<div class="panel-body">
					<div class="row">

					<input type="hidden" name="freight_id" value="' . $value->freight_id . '">
						<div class="col-md-2">
							<div class="form-group">
								<label for="route">Route</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
						<input type="text" name="route_name" value="' . $value->route_origin . ' to ' . $value->route_destination . '" class="form-control"   autofocus="autofocus" disabled>
								<input type="hidden" name="route_id" id="Route_id" class="form-control" value="' . $value->route_id . '">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="Freight date">Affected date</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="date" name="freight_affect_date" value="' . $value->freight_affect_date . '" class="form-control"   autofocus="autofocus">

							</div>
						</div>



					</div>




					<div class="row">
					<div class="col-md-2">
							<div class="form-group">
								<label for="route_id">Freight Rate</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="freight_rate" value=
								"' . $value->freight_rate . '" class="form-control"   autofocus="autofocus">
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<label for="CMVR">CMVR</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="freight_cmvr" value="' . $value->freight_cmvr . '" class="form-control"   autofocus="autofocus">
							</div>
						</div>

					</div>

					<div class="row">

						<div class="col-md-3 col-md-offset-9">
							<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
							<button type="submit" class="btn btn-success" id="personal_information">Update</button>
						</div>
					</div>

				</div>

			</div>
		</form>

			';
        }

    }

    public function update_freight()
    {
        $post = $this->input->post();

        $validation = array(

            array('field' => "route_id", 'rules' => 'required'),
            array('field' => "freight_rate", 'rules' => 'required'),
            array('field' => "freight_cmvr", 'rules' => 'required'),
            array('field' => "freight_affect_date", 'rules' => 'required'),

        );
        $this->load->library('form_validation', $validation);

        if ($this->form_validation->run()) {
            if ($this->routes_model->update_freight($post)) {
                $resp['code'] = 1;
                $resp["msg"] = "freight updated sucessfully!";
            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to add !";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }

        echo json_encode($resp);
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('routes_model');
    }

}
