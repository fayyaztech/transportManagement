<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{

    public function index()
    {
        /**Client home page
         * client list get from model
         */
        $consinee_list = $this->common_model->get_consignors();
        $data['consinee_list'] = $consinee_list;
        template($this, 'client', $data);
    }

    public function assign_routes_view()
    {
        $data['consignor_id'] = $this->input->get('consignor_id');
        $data['action'] = $this->input->get('action');
        $data['title'] = "Unassign";
        $data['consignor_name'] = $this->common_model->get_consignor_name($data['consignor_id']);
        // $status = 'unchecked';
        $routes = $this->common_model->fetch_route();
        $assigned_routes = $this->common_model->fetch_assigned_routes($data['consignor_id']);

        for ($i = 1; $i < count($routes); $i++) {
            $route_id = $routes[$i]['route_id'];
            $key = array_search($route_id, array_column($assigned_routes, 'route_id'));
            $key = "$key";
            $status = ($key != "") ? 'checked' : '';
            $data['routes'][] = ['route_id' => $routes[$i]['route_id'], 'route_origin' => $routes[$i]['route_origin'], 'route_destination' => $routes[$i]['route_destination'], 'route_distance' => $routes[$i]['route_distance'], 'status' => $status];
        }
        $this->load->view('client/assign_routes', $data);

    }

    public function assign_route_controll()
    {
        $responce = 0; //operatoin failed
        $action = $this->input->post('action');
        $routes = $this->input->post('routes');
        $consignor_id = $this->input->post('consignor_id');
        $data = [];
        for ($i = 0; $i < count($routes); $i++) {
            $data[] = ['consignor_id' => $consignor_id, 'route_id' => $routes[$i]];
        }
        if ($this->client_model->assign_routes($data)) {
            $responce = 2;
        }
        echo $responce;

    }

    public function add_consignor_form()
    {
        /**send consignor form via ajax
         * action new|edit
         * view true|false (editable|non-editable)
         */
        $data['view'] = false;
        $data['action'] = 'new';
        if (null !== $this->input->get('action')) {
            $data['action'] = $this->input->get('action');
            $data['info'] = $this->client_model->fetch_client_info($this->input->get('consignor_id'));
        }
        if ($this->input->get('view') == 'true') {
            $data['view'] = true;
        }
        $this->load->view('client/consignor_form', $data);
    }

    public function add_consignee_form()
    {
        $this->load->view('client/consignee_form');
    }

    public function add_consignor()
    {
        $post = $this->input->post();
        $validation = array(
            array('field' => "consignor_name", 'rules' => 'required'),
            array('field' => "consignor_contact", 'rules' => 'required|numeric'),
            array('field' => "consignor_address", 'rules' => 'required'),
            array('field' => "consignor_pin_code", 'rules' => 'required|numeric'),
            array('field' => "consignor_city", 'rules' => 'required'),
            array('field' => "consignor_state", 'rules' => 'required'),
        );
        $this->load->library('form_validation', $validation);

        if ($this->form_validation->run()) {
            if ($r = $this->client_model->add_client($post)) {
                echo $r;
            }
        } else {
            echo validation_errors();
        }

    }

    public function add_consignee()
    {
        $r = "Error Client-103";
        $post = $this->input->post();
        $validation = array(
            array('field' => "consignee_name", 'rules' => 'required'),
            array('field' => "consignor_id", 'rules' => 'required'),
            array('field' => "consignee_contact", 'rules' => 'required|numeric'),
            array('field' => "consignee_address", 'rules' => 'required'),
            array('field' => "consignee_pin_code", 'rules' => 'required|numeric'),
            array('field' => "consignee_city", 'rules' => 'required'),
            array('field' => "consignee_state", 'rules' => 'required'),
        );
        $this->load->library('form_validation', $validation);

        if ($this->form_validation->run()) {
            if ($this->client_model->add_consignee($post)) {
                $r = 1;
            } else {
                $r = "Failed to add client !";
            }
        } else {
            $r = validation_errors();
        }

        echo $r;
    }

    public function delete_consignor()
    {
        $consinor_id = $this->input->get('consignor_id');
        if ($this->client_model->delete_consignor($consinor_id)) {
            echo 1;
        } else {
            echo 2;
        }

    }

    public function delete_consignee()
    {
        $consinee_id = $this->input->get('consignee_id');
        if ($this->client_model->delete_consignee($consinee_id)) {
            echo 1;
        } else {
            echo 2;
        }

    }

    public function consinee_list()
    {
        $consinor_id = $this->input->get('consignor_id');
        $data['consignees'] = $this->common_model->get_consignees($consinor_id);
        $this->load->view('client/consignee_list', $data);

    }

    public function fetch_client()
    {
        $client_id = $this->input->get('client_id');
        $client_info = $this->client_model->fetch_client_info($client_id);
        foreach ($client_info as $value) {

            echo '<div class="row">
				<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
				<div class="panel-body">
					<form id="update_client">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h3 class="text-primary text-center">update client</h3><br>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="consignie"><span class="text-danger">*</span>Consignie Name</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input value="' . $value->client_name . '" type="text" name="client_name" class="form-control" autofocus="autofocus">
								<input id="client_id" value="' . $value->client_id . '" type="hidden" class="form-control" autofocus="autofocus">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for=""><span class="text-danger">*</span>Contact No.</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<input type="text" value="' . $value->client_contact . '" name="client_contact" class="form-control"  autofocus="autofocus">
							</div>
						</div>
					</div>

					<div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for=""><span class="text-danger">*</span>
                                                Client type
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <select class="c-select form-control" name="client_type">
                                                <option>Client type</option>
                                                ';
            if ($value->client_type == 'consignor') {
                echo '
                                                <option value="consignor" selected>consignor</option>
                                                <option value="consignee">consignee</option>
                                                ';
            } else {
                echo '
                                                <option value="consignor">consignor</option>
                                                <option value="consignee" selected>consignee</option>';
            }

            echo '</select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for=""><span class="text-danger">*</span>
                                                Type of Consignment
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="radio">';
            if ($value->consignment_type == 'private company') {
                echo '<label>
                                                    <input type="radio" name="consignment_type" id="Private_comp" value="private company" checked="checked">
                                                    Private Company
                                                </label>
                                                <label>
                                                    <input type="radio"  name="consignment_type" id="Private_comp" value="market" >
                                                    Market
                                                </label>';
            } else {
                echo '<label>
                                                    <input type="radio" name="consignment_type" id="Private_comp" value="private company" >
                                                    Private Company
                                                </label>
                                                <label>
                                                    <input type="radio"  name="consignment_type" id="Private_comp" value="market" checked="checked" >
                                                    Market
                                                </label>';
            }

            echo ' </div>
                                        </div>
                                    </div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for=""><span class="text-danger">*</span>Address</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<textarea name="client_address" id="textarea" class="form-control" rows="3" required="required">' . $value->client_address . '</textarea>

							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for=""><span class="text-danger">*</span>Pincode</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" value="' . $value->client_pincode . '" name="client_pincode" class="form-control" autofocus="autofocus">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for=""><span class="text-danger">*</span>city</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" value="' . $value->client_city . '" name="client_city" class="form-control" autofocus="autofocus">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for=""><span class="text-danger">*</span>State</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" value="' . $value->client_state . '" name="client_state" class="form-control" autofocus="autofocus">
							</div>
						</div>
					</div>

					<button class="pull-right btn btn-danger" data-dismiss="modal">close</button>
					<button type="submit" class="pull-right btn btn-primary"><span class="fa fa-plus text-white"></span> Update Consignie</button>
					</div>
				</form>
				</div>
			</div>
	</div>
</div>';
        }
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('client_model');
    }

}

/* End of file client.php */
/* Location: ./application/controllers/client.php */
