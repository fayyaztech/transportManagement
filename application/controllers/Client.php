<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {

	public function index()
	{
		$consinee_list = $this->client_model->get_list();
		$count = 1;
		foreach ($consinee_list as $value) {
			echo '
				<tr>
					<td>'.$count++.'</td>
                    <td>'.$value->consignor_name.'</td>
                    <td>'.$value->consignor_address.'</td>
                    <td>'.$value->consignor_contact.'</td>
                    <td>'.$value->consignor_city.'</td>
                    <td value='.$value->consignor_id.'>
                      <a id="update_con" href="#modal-id" data-toggle="modal" class="btn btn-info fa fa-edit edit_client" ></a>
                      <button class="btn btn-danger fa fa-trash delete_consingee"></button>
                    </td>
                </tr>
			';
		}
	}

	public function add_consignor()
	{
		$post = $this->input->post();
		$validation = array(
			array('field'=>"consignor_name", 'rules'=>'required'),
			array('field'=>"consignor_contact", 'rules'=>'required|numeric'),
			array('field'=>"consignor_address", 'rules'=>'required'),
			array('field'=>"consignor_pin_code", 'rules'=>'required|numeric'),
			array('field'=>"consignor_city", 'rules'=>'required'),
			array('field'=>"consignor_state", 'rules'=>'required')
		);
		$this->load->library('form_validation', $validation);

			if ($this->form_validation->run()) {
			if ($this->client_model->add_client($post)) {
				$resp['code'] = 1;
				$resp["msg"] = "client added successfully !";
			}else{
				$resp['code'] = 0;
				$resp["msg"] = "Failed to add client !";
			}
		} else {
			$resp['code'] = 0;
			$resp["msg"] = validation_errors();
		}

		echo json_encode($resp);
	}

	public function add_consignee()
	{
		$post = $this->input->post();
		$validation = array(
			array('field'=>"consignee_name", 'rules'=>'required'),
			array('field'=>"consignor_id", 'rules'=>'required'),
			array('field'=>"consignee_contact", 'rules'=>'required|numeric'),
			array('field'=>"consignee_address", 'rules'=>'required'),
			array('field'=>"consignee_pin_code", 'rules'=>'required|numeric'),
			array('field'=>"consignee_city", 'rules'=>'required'),
			array('field'=>"consignee_state", 'rules'=>'required')
		);
		$this->load->library('form_validation', $validation);

			if ($this->form_validation->run()) {
			if ($this->client_model->add_consignee($post)) {
				$resp['code'] = 1;
				$resp["msg"] = "client added successfully !";
			}else{
				$resp['code'] = 0;
				$resp["msg"] = "Failed to add client !";
			}
		} else {
			$resp['code'] = 0;
			$resp["msg"] = validation_errors();
		}

		echo json_encode($resp);
	}

	public function update_client()
	{
		$client_id=$this->input->get('client_id');
		$data = $this->input->post();
		print_r($data);
		$validation = array(
			array('field'=>"client_name", 'rules'=>'required'),
			array('field'=>"client_contact", 'rules'=>'required|numeric'),
			array('field'=>"client_address", 'rules'=>'required'),
			array('field'=>"client_pincode", 'rules'=>'required|numeric'),
			array('field'=>"client_city", 'rules'=>'required'),
			array('field'=>"client_state", 'rules'=>'required')
		);
		
		$this->load->library('form_validation', $validation);
		
		if ($this->form_validation->run()) {
			if ($this->client_model->update_client_info($data,$client_id)) {
				$resp['code'] = 1;
				$resp["msg"] = "client Update successfully !";
			}else{
				$resp['code'] = 0;
				$resp["msg"] = "Failed to Update client !";
			}
		} else {
			$resp['code'] = 0;
			$resp["msg"] = validation_errors();
		}

		echo json_encode($resp);
	}

	public function fetch_client()
	{
		$client_id=$this->input->get('client_id');
		$client_info= $this->client_model->fetch_client_info($client_id);
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
								<input value="'.$value->client_name.'" type="text" name="client_name" class="form-control" autofocus="autofocus">
								<input id="client_id" value="'.$value->client_id.'" type="hidden" class="form-control" autofocus="autofocus">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for=""><span class="text-danger">*</span>Contact No.</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<input type="text" value="'.$value->client_contact.'" name="client_contact" class="form-control"  autofocus="autofocus">
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
                                            if($value->client_type == 'consignor'){
												echo'
                                                <option value="consignor" selected>consignor</option>
                                                <option value="consignee">consignee</option>
                                                ';
                                             }else{
                                             	echo'
                                                <option value="consignor">consignor</option>
                                                <option value="consignee" selected>consignee</option>';
                                                }

                                            echo'</select>
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
                                          if($value->consignment_type == 'private company'){
                                          		echo'<label>
                                                    <input type="radio" name="consignment_type" id="Private_comp" value="private company" checked="checked">
                                                    Private Company
                                                </label>
                                                <label>
                                                    <input type="radio"  name="consignment_type" id="Private_comp" value="market" >
                                                    Market
                                                </label>';
                                              }else{
                                              	echo'<label>
                                                    <input type="radio" name="consignment_type" id="Private_comp" value="private company" >
                                                    Private Company
                                                </label>
                                                <label>
                                                    <input type="radio"  name="consignment_type" id="Private_comp" value="market" checked="checked" >
                                                    Market
                                                </label>';
                                              }
                                                
                                           echo' </div>
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
								<textarea name="client_address" id="textarea" class="form-control" rows="3" required="required">'.$value->client_address.'</textarea>
								
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for=""><span class="text-danger">*</span>Pincode</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" value="'.$value->client_pincode.'" name="client_pincode" class="form-control" autofocus="autofocus">
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
								<input type="text" value="'.$value->client_city.'" name="client_city" class="form-control" autofocus="autofocus">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for=""><span class="text-danger">*</span>State</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" value="'.$value->client_state.'" name="client_state" class="form-control" autofocus="autofocus">
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
		parent:: __construct();
		$this->load->model('client_model');
	}

}

/* End of file client.php */
/* Location: ./application/controllers/client.php */