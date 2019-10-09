<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Trip extends CI_Controller
{
    /**Constructor */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('trip_model');
    }
    /**Views ***************************************************************************
     * index default view
     * add trip form
     * stop_step_form
     * advance_form
     * trip_step_form
     * stop_setp
     */
    public function index()
    {
        $data['trip_data'] = $this->trip_model->fetch_trip_list();
        template($this, 'trip', $data);
    }

    public function add_trip_from()
    {
        $this->load->view('trip/add_trip');
    }

    public function trip_expenses_form()
    {
        $data['trip_id'] = $this->input->get('trip_id');
        $this->load->view('trip/trip_expenses_form', $data);

    }

    public function advance_form()
    {
        $data['trip_id'] = $this->input->get('trip_id');
        $data['driver_id'] = $this->trip_model->get_driver_by_trip_id($data['trip_id']);
        if ($data['driver_id'] === false) {
            echo "Trip is not running ";
            die();
        }
        $this->load->view('trip/advance_form', $data);
    }
    public function trip_step_form()
    {
        $data['trip_id'] = $this->input->get('trip_id');

        #check wether trip step running or not
        $is_another_step_running = $this->trip_model->is_any_active_step($data['trip_id']);
        if (!$is_another_step_running) {
            $data['msg'] = "please End Running step Before start new one ";
            $this->load->view('error_msg', $data);
        } else {

            #collect required information for start new step
            $data['consignor_id'] = $this->common_model->get_consignor_id($data['trip_id']);
            $data['routes'] = $this->common_model->fetch_assigned_routes($data['consignor_id']);
            $data['last_driver_id'] = $this->common_model->last_active_driver_on_trip($data['trip_id']);
            $data['driver_name'] = $this->common_model->get_driver_name($data['last_driver_id']);
            $data['trip_details'] = $this->trip_model->fetch_trip_details($data['trip_id']);
            $data['loads'] = $this->common_model->get_loads($data['consignor_id']);
            $data['drivers'] = $this->common_model->get_drivers();

            //load view
            $this->load->view('trip/trip_step_form', $data);
        }
    }

    public function edit_trip_form()
    {
        $data['trip_id'] = $this->input->get('trip_id');
        $data['trip_details'] = $this->trip_model->fetch_trip_details($data['trip_id']);
        $data['vehicle_name'] = $this->common_model->get_vehicle_number($data['trip_details']->vehicle_id);
        $data['vehicles'] = $this->common_model->fetch_vehicle_list(1);
        $data['consignors'] = $this->common_model->get_consignors();
        $data['drivers'] = $this->common_model->get_drivers();
        $data['driver']['driver_name'] = $this->common_model->get_driver_name($data['trip_details']->driver_id);
        $this->load->view('trip/edit_trip_form', $data);
    }

    public function update_step_form()
    {
        $data['step_id'] = $this->input->get('step_id');
        $data['step_details'] = $this->trip_model->fetch_step_details($data['step_id']);
        $data['consignor_id'] = $this->common_model->get_consignor_id($data['step_details']['trip_id']);
        $data['routes'] = $this->common_model->fetch_assigned_routes($data['consignor_id']);
        $data['loads'] = $this->common_model->get_loads($data['consignor_id']);
        $this->load->view('trip/update_step_form', $data);
    }

    public function end_step_form()
    {
        $data['step_id'] = $this->input->get('step_id');
        $this->load->view('trip/end_step', $data);
    }

    public function received_payment_form()
    {
        $data['trip_id'] = $this->input->get('trip_id');
        $data['request_type'] = $this->input->get('type');
        $this->load->view('trip/received_payment', $data);

    }

    /**form data receiver methods ******************************************************
     * add trip
     */
    public function add_trip()
    {
        $post = $this->input->post();
        $config = array(
            array("field" => "driver_id", "rules" => "required"),
            array("field" => "consignor_id", "rules" => "required"),
            array("field" => "consignee_id", "rules" => "required"),
            array("field" => "route_id", "rules" => "required"),
            array("field" => "load_id", "rules" => "required"),
            array("field" => "vehicle_id", "rules" => "required"),
            array("field" => "allowance", "rules" => "numeric"),
            array("field" => "advance", "rules" => "numeric"),
        );
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {
            $advance = $this->input->post('advance');
            unset($_POST['advance']);
            $step['load_id'] = $this->input->post('load_id');
            $step['route_id'] = $this->input->post('route_id');
            $step['trip_detail_status'] = 2;
            $step['step_start_date'] = $this->input->post('trip_start_date');
            $step['trip_detail_freight'] = $this->input->post('trip_detail_freight');
            if ($trip_id = $this->trip_model->save_trip_info($post)) {

                $step['trip_id'] = $trip_id;
                $this->trip_model->add_trip_step($step);
                $this->trip_model->add_advance(['trip_id' => $trip_id, 'advance_amount' => $advance, 'advance_date' => $post['trip_start_date']]);
                $this->common_model->driver_unavailable($post['driver_id']);
                $this->common_model->vehicle_unavailable($this->input->post('vehicle_id'));
                $resp['code'] = 1;
                $resp["msg"] = "Trip Added Successfully.!";
            } else {
                $resp['code'] = 0;
                $resp["msg"] = "Failed to Add Trip.!";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }
        echo json_encode($resp);
    }

    public function update_step()
    {
        $post = $this->input->post();
        $resp = 0; //error to update
        if ($this->trip_model->update_step($post)) {
            $resp = 1;
        }
        echo $resp;

    }

    public function end_step()
    {
        $response = 'default failed';
        $post = $this->input->post();
        /** Collect required information for finalize step and vehicle maintenance update*/
        $step_id = $post['trip_details_id'];
        $step_info = $this->trip_model->fetch_step_details($step_id);
        $vehicle_id = $this->common_model->get_active_vehicle_id($step_info['trip_id']);
        $km = $this->common_model->get_km_by_route($step_info['route_id']);
        $active_maintenance = $this->common_model->get_active_maintenance($vehicle_id);

        /**Hit final update query through the trip model */
        $update_maintenance = []; //predefine $update_maintenance blank array
        for ($i = 0; $i < count($active_maintenance); $i++) {
            $update_maintenance[] = ['mnt_id' => $active_maintenance[$i]['mnt_id'], 'mnt_run_km' => $km, 'trip_details_id' => $step_id];
        }

        if ($this->trip_model->end_step($post)) {
            $response = 1;
            if (count($update_maintenance) != 0) {
                if ($this->common_model->update_maintenance($update_maintenance)) {
                    $response = 1;
                } else {
                    $response = 'Update maintenance failed';
                }
            }
        } else {
            $response = 'failed to update step';
        }

        echo $response;
    }
    public function get_consignee()
    {
        $consignor_id = $this->input->get('consignor_id');
        echo '<option value="">Select</option>';
        foreach (fetch_consignee($this, $consignor_id) as $value) {
            echo '<option value="' . $value->consignee_id . '">' . $value->consignee_name . '</option>';
        }

    }

    public function get_routs()
    {
        foreach (fetch_route($this, $this->input->get('client_id')) as $value) {
            echo '<option value="' . $value->route_id . '">' . $value->route_origin . ' To ' . $value->route_destination . '</option>';
        }
    }
    public function get_loads()
    {
        echo '
		<option value="">Select</option>
		<option value="0">Market</option>
		';
        foreach (fetch_load($this, $this->input->get('consignor_id')) as $value) {
            echo '<option value="' . $value->load_id . '">' . $value->load_name . '</option>';
        }
    }

    //Add step Trip
    public function add_trip_step()
    {
        $r = "operation failed TRIP-224";
        $old_driver_id = $this->input->post('old_driver_id');
        $new_driver_id = $this->input->post('driver_id');
        unset($_POST['old_driver_id']);
        $post = $this->input->post();
        $config = array(
            array("field" => "route_id", "rules" => "required"),
            array("field" => "load_id", "rules" => "required"),
            array("field" => "step_start_date", "rules" => "required"),
        );
        $this->load->library('form_validation', $config);

        //check trip empty or loaded
        $post['trip_detail_status'] = 2;
        if ($this->input->post('load_id') == 0) {
            $post['trip_details_is_loaded'] = 1;
        }

        if ($this->form_validation->run()) {

            if ($this->trip_model->add_trip_step($post)) {

                /*
                check driver old or new
                 * if driver is new then update old driver status as free
                 */

                if ($new_driver_id != $old_driver_id) {
                    $this->common_model->driver_available($old_driver_id);
                    $this->common_model->driver_unavailable($new_driver_id);
                }

                $r = 1;
            } else {
                $r = "Failed to Add Step.!";
            }
        } else {
            $r = validation_errors();
        }
        echo $r;
    }

    // Add Trip Function

    // Update Trip Function
    public function add_advance()
    {
        $r = "default Failed";
        $post = $this->input->post();
        $config = array(
            array("field" => "advance_amount", "rules" => "required"),
            array("field" => "advance_date", "rules" => "required"),
        );
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {
            if ($trip_id = $this->trip_model->add_advance($post)) {
                $r = 1;
            }
        } else {
            $r = validation_errors();
        }

        echo $r;
    }

    public function receive_payment()
    {
        $r = "operation failed ";
        $post = $this->input->post();
        if ($this->trip_model->receive_payment($post)) {
            $r = 1;
        }

        echo $r;
    }
    public function update_trip()
    {
        $r = "update failed (main)";
        $post = $this->input->post();
        $config = array(
            array("field" => "consignor_id", "rules" => "required"),
            array("field" => "consignee_id", "rules" => "required"),
            array("field" => "allowance", "rules" => "numeric"),
        );
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {
            if ($post['old_vehicle_id'] !== $post['vehicle_id']) {
                $this->common_model->vehicle_available($post['old_vehicle_id']);
                $this->common_model->vehicle_unavailable($post['vehicle_id']);
            }
            unset($post['old_vehicle_id']);
            $act_driver_id = $this->common_model->get_active_driver_id($post["trip_id"]);

            if ($act_driver_id != $post['driver_id']) {
                $this->common_model->driver_available($act_driver_id);
                $this->common_model->driver_unavailable($post['driver_id']);
            }

            if ($this->trip_model->update_trip_info($post)) {
                $r = 1;
            } else {
                $r = "update failed";
            }
        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }
        echo $r;
    }
    // Stop Trip Function
    public function stop_trip()
    {
        $post = $this->input->post();
        $config = array(
            array("field" => "trip_stop_date", "rules" => "required"),
            array('field' => "trip_id", "rule" => "required"),
        );
        // print_r($post);
        $this->load->library('form_validation', $config);
        if ($this->form_validation->run()) {

            //make sure trip not running
            if (!empty($data = $this->trip_model->get_incomplet_trips($post['trip_id']))) {
                foreach ($data as $d) {
                    $this->trip_model->stop_step(['trip_details_id' => $d->trip_details_id, "trip_stop_date" => $post['trip_stop_date']]);
                }
            }

            if ($this->trip_model->stop_trip($post)) {
                $vehicle_id = $this->common_model->get_active_vehicle($post['trip_id']);
                update_vehicle_status($this, $vehicle_id, 1);
                $resp['code'] = 1;
                $resp["msg"] = "trip Stoped";
            }

        } else {
            $resp['code'] = 0;
            $resp["msg"] = validation_errors();
        }
        echo json_encode($resp);
    }

    public function get_routes()
    {
        $consignor_id = $this->input->get('consignor_id');
        $data = $this->common_model->fetch_assigned_routes($consignor_id);
        for ($i = 0; $i < count($data); $i++) {
            ?>
                <option value="<?php echo $data[$i]['route_id'] ?>"><?php echo $data[$i]['route_origin'] . '-' . $data[$i]['route_destination']; ?></option>
            <?php
}

    }

    public function add_trip_expense()
    {
        $r = "failed to add expenses";
        $post = $this->input->post();
        if ($this->trip_model->add_trip_expenses($post)) {
            $r = 1;
        }

        echo $r;
    }

    public function issue_diesel_form()
    {
        $data['trip_id'] = $this->input->get('trip_id');
        $data['driver_id'] = $this->common_model->get_driver_id($data['trip_id']);
        $data['vehicle_id'] = $this->common_model->get_vehicle_id($data['trip_id']);
        $this->load->view('trip/issue_diesel', $data);
    }

    public function add_diesel()
    {
        $r = "failed to add diesel";
        $post = $this->input->post();
        if ($this->trip_model->add_diesel($post)) {
            $r = 1;
        }

        echo $r;

    }

    public function end_trip_form()
    {
        $data['trip_id'] = $this->input->get('trip_id');
        $this->load->view('trip/end_trip', $data);

    }

    public function end_trip()
    {
        $r = "failed to stop trip";
        $post = $this->input->post();
        $driver_incentive = $post['driver_incentive'];
        unset($post["driver_incentive"]);
        $resp = $this->trip_model->end_trip($post);
        if ($resp) {
            $r = 1;
            $driver_id = $this->common_model->get_driver_id($post['trip_id']);
            $this->common_model->give_incentive_driver(
                [
                    'trip_id' => $post['trip_id'],
                    'driver_id' => $driver_id,
                    "driver_incentive_amount" => $driver_incentive,
                ]
            );
        }

        echo $r;

    }

}

/* End of file Trip.php */
/* Location: ./application/controllers/Trip.php */
