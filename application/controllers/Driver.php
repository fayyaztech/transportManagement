<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller {

	public function index()
	{
		$count=1;
		$driver_data = $this->driver_model->driverManagement();
		foreach ($driver_data as $value) {
			if ($value->driver_running_status == 1) {
				$status = '<span class="label label-danger">On Trip</span>';
			}else{
				$status = '<span class="label label-success">Available</span>';
			}

			echo '<tr>
			 <td>'.$count++.'</td>
                                <td>'.$value->driver_name.'</td>
                                <td>'.$status.'</td>
                                <td>'.$value->driver_number.'</td>
                                <td>'.$value->driver_residential_address.'</td>

                                <td value="'.$value->driver_id.'">
                                <button id="update_driver1" class="btn btn-info fa fa-user" ></button>
                                    <button id="update_driver1" class="btn btn-info fa fa-edit" ></button>
                                    <button class="btn btn-success fa fa-money"></button>
                                    <button class="btn btn-danger fa fa-trash" href="#del_user" data-toggle="modal"></button>
                                </td>
                            </tr>';
		}
	}

	public function upload_doc()
	{

		$config['upload_path'] = './upload/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']  = '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('id_file')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			echo "success";
		}

		if ( ! $this->upload->do_upload('address_file')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data = array('upload_data' => $this->upload->data());
			echo "success";
		}
		// print_r($data);
	}

	public function wadge_form()
	{
		$post = $this->input->post();
		// print_r($post);
		$validation = array(
			array('field'=>"driver_salary", 'rules'=>'required|numeric')
		);
		$this->load->library('form_validation', $validation);
		
		if ($this->form_validation->run()) {
			if ($d_id = $this->driver_model->update_diver_info($post)) {
				$resp['code'] = 1;
				$resp["msg"] = "driver updated successfully !";
				$resp["driver_id"] = $d_id;
			}else{
				$resp['code'] = 0;
				$resp["msg"] = "Failed to update driver !";
			}
		} else {
			$resp['code'] = 0;
			$resp["msg"] = validation_errors();
		}

		echo json_encode($resp);
	}



	public function update_form2()
	{
		$post = $this->input->post();
		// print_r($post);
		$validation = array(
			array('field'=>"driver_licence_no", 'rules'=>'required')
		);
		$this->load->library('form_validation', $validation);
		
		if ($this->form_validation->run()) {
			if ($d_id = $this->driver_model->update_diver_info($post)) {
				$resp['code'] = 1;
				$resp["msg"] = "driver updated successfully !";
				$resp["driver_id"] = $d_id;
			}else{
				$resp['code'] = 0;
				$resp["msg"] = "Failed to update driver !";
			}
		} else {
			$resp['code'] = 0;
			$resp["msg"] = validation_errors();
		}

		echo json_encode($resp);
	}

	public function add_driver_info()
	{
		$post = $this->input->post();
		unset($post['address_check']);
		$config = array(
							array("field"=>"driver_name", "rules"=>"required"),
							array("field"=>"driver_number", "rules"=>"required|numeric|min_length[10]"),
							array("field"=>"driver_residential_address", "rules"=>"required"),
							array("field"=>"driver_permanent_address", "rules"=>"required"),
						);
	
		$this->load->library('form_validation', $config);
		if ($this->form_validation->run()) {
			if ($d_id = $this->driver_model->save_diver_info($post)) {
				$resp['code'] = 1;
				$resp["msg"] = "driver added successfully !";
				$resp["driver_id"] = $d_id;
			}else{
				$resp['code'] = 0;
				$resp["msg"] = "Failed to add driver !";
			}
		} else {
			$resp['code'] = 0;
			$resp["msg"] = validation_errors();
		}

		echo json_encode($resp);

	}

	public function update_driver_info()
	{
		$post = $this->input->post();
		//print_r($post);

		unset($post['address_check']);
		$config = array(
						array("field"=>"driver_name", "rules"=>"required"),
						array("field"=>"driver_number", "rules"=>"required|numeric|min_length[10]"),
						array("field"=>"driver_residential_address", "rules"=>"required"),
						array("field"=>"driver_permanent_address", "rules"=>"required"),
						array('field'=>"driver_licence_no", 'rules'=>'required'),
						array('field'=>"driver_salary", 'rules'=>'required|numeric'),
						);
	
		$this->load->library('form_validation', $config);
		
		if ($this->form_validation->run()) {
			if($this->driver_model->update_driver_info($post))
			{
				echo "driver updated successfully !";
			}
			else
			{
				echo "Failed to update driver !";
			}
		}
		else
		{
			echo validation_errors();
		}
		
	}

	public function fetch_driver()
	{
		$driver_id=$this->input->get('driver_id');
		$data=$this->driver_model->fetch_driver_info($driver_id);
		foreach ($data as $value) {
		$modal['personal_info'][]='
	<form action="" id="driver_form_1_update" method="POST" role="form">
	<div class="row">
		
			<div class="col-xs-10 col-sm-10 col-md-10 col-md-offset-1">
				<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="firstName">Name</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="hidden" value="'.$value->driver_id.'" name="driver_id" class="form-control" placeholder="Name" autofocus="autofocus">
						<input type="text" value="'.$value->driver_name.'" name="driver_name" class="form-control" placeholder="Name" autofocus="autofocus">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="firstName">Date Of Birth</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="date" value="'.$value->driver_dob.'" name="driver_dob" class="form-control" autofocus="autofocus">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="firstName">Mobile Number</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="tel" value="'.$value->driver_number.'" name="driver_number" class="form-control" placeholder="Contact Number" autofocus="autofocus">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="email">Email</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="email" value="'.$value->driver_email.'" name="driver_email" class="form-control" placeholder="email" autofocus="autofocus">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="firstName">Recidential Address</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<textarea name="driver_residential_address" class="form-control">'.$value->driver_residential_address.'</textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<div class="radio">
							<label>
								<input type="checkbox" name="address_check" value="address_check" >
								Same as Residential
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="firstName">Permanant Address</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<textarea name="driver_permanent_address" class="form-control">'.$value->driver_permanent_address.'</textarea>
					</div>
				</div>
			</div>
			<div class="row">
				
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Id Proof</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<select name="identity_id" class="form-control" required="required">
							
							<option value="'.$value->identity_id.'">'.$value->identity_id.'</option>
							
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Id Number</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="number" value="'.$value->driver_identy_id_no.'" name="driver_identy_id_no" class="form-control" autofocus="autofocus">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Address Proof</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<select name="address_id" class="form-control" required="required">
							<option value="'.$value->address_id.'">'.$value->address_id.'</option>
						</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="">address Proof Id</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input value="'.$value->driver_address_id_no.'" type="upload" name="driver_address_id_no" class="form-control" autofocus="autofocus">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="">driver_licence_no</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="text" value="'.$value->driver_licence_no.'" name="driver_licence_no" class="form-control"autofocus="autofocus">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Expiry Date</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="date" value="'.$value->driver_licence_exp.'" name="driver_licence_exp" class="form-control"  autofocus="autofocus">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Date of Joining</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="date" value="'.$value->driver_date_of_join.'" name="driver_date_of_join" class="form-control"  autofocus="autofocus">
					</div>
				</div>
			</div>
			<div class="row">
			<div class="col-md-3">
			</div>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="wedge_type" value="2" checked="checked">
							Monthly
						</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="wedge_type" value="3">
							Fixed Salary
						</label>
					</div>
				</div>
				<div class="col-md-3">
			</div>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="wedge_type" value="1">
							Trip based
						</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="radio">
						<label>
							<input type="radio" name="wedge_type" value="4">
							Daily
						</label>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Salary</label>
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<input type="numeric" value="'.$value->driver_salary.'" name="driver_salary" class="form-control" required=""  autofocus="autofocus">
					</div>
				</div>
			</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Salary</label>
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<input type="file" name="id_file"  autofocus="autofocus">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Salary</label>
		</div>
	</div>
	<div class="col-md-8">
		<div class="form-group">
			<input type="file" name="address_file" autofocus="autofocus">
		</div>
	</div>
</div>
		<button type="submit" class="btn btn-primary pull-right">Save changes</button>
			</div>
			</div>
	</form>';

	echo json_encode($modal);
	}
}
	
	public function __construct()
	{
		parent:: __construct();
		$this->load->model('driver_model');
	}
}

/* End of file Driver.php */
/* Location: ./application/controllers/Driver.php */