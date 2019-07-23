<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{

    public function index()
    {
        $count = 1;
        $driver_data = $this->driver_model->driverManagement();
        foreach ($driver_data as $value) {
            if ($value->driver_running_status == 1) {

                $status = '<span class="label label-success">Available</span>';
            } else {
                $status = '<span class="label label-danger">On Trip</span>';

            }

            echo '<tr>
			 		<td>' . $count++ . '</td>
                    <td>' . $value->driver_name . '</td>
                    <td>' . $status . '</td>
                    <td>' . $value->driver_number . '</td>
                    <td>' . $value->driver_permanent_address . '</td>
				    <td value="' . $value->driver_id . '">
                    <button id="update_driver" class="btn btn-info fa fa-edit" ></button>
                    <button data-toggle="tooltip" data-placement="top" title="Delete" id="delete" class="btn btn-danger fa fa-trash"></button>
                    </td>
                 </tr>';
        }
    }

    public function add_driver_info()
    {
        $post = $this->input->post();
        unset($post['address_check']);
        $config = array(
            array("field" => "driver_name", "rules" => "required"),
            array("field" => "driver_number", "rules" => "required|numeric|min_length[10]"),
            array("field" => "driver_permanent_address", "rules" => "required"),
        );

        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {
            if ($d_id = $this->driver_model->save_diver_info($post)) {
                $resp['code'] = 1;
                $resp["msg"] = "driver added successfully !";

            } else {
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

        $config = array(
            array("field" => "driver_name", "rules" => "required"),
            array("field" => "driver_number", "rules" => "required|numeric|min_length[10]"),
            array("field" => "driver_permanent_address", "rules" => "required"),
        );
        $this->load->library('form_validation', $config);

        if ($this->form_validation->run()) {
            if ($this->driver_model->update_driver_info($post)) {
                $resp['code'] = 1;
                $resp["msg"] = "driver updated successfully !";

            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to update driver !";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }

        echo json_encode($resp);

    }

    public function fetch_driver()
    {
        $driver_id = $this->input->get('driver_id');
        $data = $this->driver_model->fetch_driver_info($driver_id);
        foreach ($data as $value) {

            echo '
				<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="text-center">Personal Information</h3>
			</div>
			<div class="panel-body">
				<form method="post" id="driver_update_submit">
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="firstName">Name</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="driver_name" class="form-control" placeholder="Name" value="' . $value->driver_name . '" autofocus="autofocus">
								<input type="hidden" class="form-control" id="driver_id" name="driver_id" value="' . $value->driver_id . '" placeholder="Enter email">

							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<label for="firstName">Date Of Birth</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="date" name="driver_dob" value="' . $value->driver_dob . '" class="form-control" autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="firstName">Mobile Number</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="tel" name="driver_number"  value="' . $value->driver_number . '" class="form-control" placeholder="Contact Number" autofocus="autofocus">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="email">Email</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="email" name="driver_email" value="' . $value->driver_email . '" class="form-control" placeholder="email" autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-2">
							<div class="form-group">
								<label for="">Date of Joining</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="date" name="driver_date_of_join" value="' . $value->driver_date_of_join . '"class="form-control"  autofocus="autofocus">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Salary</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="numeric" name="driver_salary" value="' . $value->driver_salary . '" class="form-control" required=""  autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Licence no</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="driver_licence_no" value="' . $value->driver_licence_no . '" class="form-control"autofocus="autofocus">
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<label for="">Expiry Date</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="date" name="driver_licence_exp" value="' . $value->driver_licence_exp . '" class="form-control"  autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="firstName">Address</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<textarea name="driver_permanent_address"  class="form-control">' . $value->driver_permanent_address . '</textarea>
							</div>
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-success pull-right btn-lg" id="personal_information">Update</button>
						</div>
					</div>



				</div>
			</form>

		</div>
	</div>
</div>

		';

        }
    }

    public function delete_driver()
    {

        $driver_id = $this->input->get('driver_id');

        if ($this->driver_model->delete_driver_info($driver_id)) {
            $resp['code'] = 1;
            $resp["msg"] = "deleted successfully !";
        } else {
            $resp['code'] = 0;
            $resp["msg"] = "may be driver is on trip!";
        }

        echo json_encode($resp);

    }

    public function __construct()
    {
        parent::__construct();
        $this->load->model('driver_model');
    }
}

/* End of file Driver.php */
/* Location: ./application/controllers/Driver.php */
