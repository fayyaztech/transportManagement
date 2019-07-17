<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maintenance extends CI_Controller {

	public function index()
	{
		
	}

	public function delete_expense()
	{
		if ($this->maintenance_model->delete_expense($this->input->get('expense_id'))) {
			echo 1;
		}else{
			echo "somthing problem to delete report to develepers";
		}
	}

	public function get_expenses()
	{
		$expenses = $this->maintenance_model->get_expense();
		$i = 0;
		foreach ($expenses as $item) {
			echo "
			<tr>
				<td>".$item->ed_name."</td>
				<td>".$item->expense_amount."</td>
				<td>".$item->expense_bill_no."</td>
				<td>".$item->expense_vendar_name."</td>
				<td>".$item->note."</td>
				<td><button id='delete_expense' expense_id='".$item->expense_id."' type='button' class='btn btn-danger'><span class='fa fa-trash'></span></button></td>
				</tr>
			";
		}
	}
	public function add_expense()
	{
		$data=$this->input->post();
		// print_r($data);
		
		$config= array(
				 array('field' =>'expense_bill_no' ,'rules'=>'required|min_length[2]'),
		  		 array('field' =>'expense_amount' ,'rules'=>'required|numeric'),
		  		 array('field' =>'expense_date' ,'rules'=>'required'),
				 array('field' =>'expense_name' ,'rules'=>'required|min_length[2]'),
				);

		$this->load->library('form_validation',$config);
		if($this->form_validation->run()==true)
		{
			
			if($insert_id = $this->maintenance_model->add_expenses($data))
			{
				
					echo 1;
			}
			else
			{
				echo 0;
			}
		}
		else
		{
			echo validation_errors();
		}
	}

	public function assign_tyre_to_vehicle()
	{
		$post = $this->input->post();
		print_r($post);
	}
	public function get_vehicle_details(){
		/*
			* get vehicle all maintenance details
			* tyres, oils , etc;
			* json format
		*/
		$vehicle_id = $this->input->get('vehicle_id');

		$data = $this->maintenance_model->fetch_vehicle_details($vehicle_id);
		// print_r($data);
		$i = 1;
		$tyre = [];
		$oil = [];
		$battery = [];
		$misc = [];
		$permit = [];
		$stepny = [];
		foreach ($data as $val) {
			$id = $val->expense_details_id;
				if ($id == 1 || $id == 4 || $id == 13) {
					$tyre[] = $val;
				}elseif ($id == 2) {
					$oil[] = $val;
				}elseif ($id == 3) {
					$battery[] = $val;
				}elseif ($id == 5 || $id == 6 || $id == 8 || $id == 9 || $id == 10 || $id == 11 || $id == 12 ) {
					$permit[] = $val;
				}elseif ($id == 7) {
					$misc[] = $val;
				}
			}
			
		

		// print_r($battery);
		$this->_filter_data($tyre,$oil,$battery,$misc,$permit);

		// echo json_encode($data);
		// print_r($data);
	}

	public function fetch_tyre_by_vid()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		$tyre_info=$this->maintenance_model->fetch_tyre_info_by_vid($vehicle_id);
		$count=1;
		// print_r($tyre_info);
		foreach ($tyre_info as  $value) {
		echo '<tr>
                    <td>'.$count++.'</td>
                    <td>'.$value->expense_name.'</td>
                    <td>'.$value->vm_tire_no.'</td>
                    <td>'.$value->expense_date.'</td>
                    <td></td>
                    <td>'.$value->expense_amount.'</td>
                    <td>'.$value->expense_bill_no.'</td>
                    <td>'.$value->note.'</td>
                    <td>
                        <a class="btn btn-info fa fa-edit" data-toggle="modal" href="#Remold_tyre"> Remold</a>
                        <a class="btn btn-warning fa fa-cog" data-toggle="modal" href="#Assign_to_vehicle"> assign</a>
                    </td>
                </tr>';
	}
	}


    // Saving Tyre Maintenance //

	public function add_tyre_maintenance()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		$data=$this->input->post();
		$data['vehicle_id']=$vehicle_id;
		//print_r($data);
		
			if ($data['expense_details_id'] == 1) {
				if (!check_number_of_tyre($this,$vehicle_id)) {
				echo " Maximun Number of tyre added please remove or add as a stepny";
				die();
			}

		}

		$config= array(
		array('field' =>'expense_bill_no' ,'rules'=>'required|min_length[2]'),
		array('field' =>'pp_start_km' ,'rules'=>'required|numeric'),
		array('field' =>'pp_expected_run' ,'rules'=>'required|numeric'),
		array('field' =>'expense_name' ,'rules'=>'required|min_length[2]'),
		array('field' =>'pp_serial_no' ,'rules'=>'required|min_length[1]'),
		array('field' =>'expense_amount' ,'rules'=>'required|numeric'),
		);

		$this->load->library('form_validation',$config);

		if($this->form_validation->run()==true)
		{
			
			$product = ['pp_start_km'=>$data['pp_start_km'],'pp_expected_run' => $data['pp_expected_run'], 'pp_warranty'=>$data['pp_warranty'],'pp_serial_no'=>$data['pp_serial_no'],'vehicle_id'=>$data['vehicle_id'],'expense_details_id'=>$data['expense_details_id']];
			if (isset($data['pp_id'])) {
				// is remould tyre 
				$product = array_merge($product,['pp_id'=>$data['pp_id']]);
			}

			$expense = array_diff_key($data, $product);
			$vers = ['vehicle_id'=>$product['vehicle_id'],'vehicle_current_reading'=>$product['pp_start_km']];
			if (!check_current_reading_greater($this,$vers)) {
				echo 'please check kilometer reading you provided is lower than older ';
				die();
			}
			
			if($insert_id = $this->maintenance_model->add_product($product))
			{
				$expense['product_purchase_id'] = $insert_id;
				if ($this->maintenance_model->insert_expenses($expense)) {
					update_vehicle_km($this,$vers);
					echo "New add success ";
				}else{
					$this->maintenance_model->delete_product($insert_id);
					echo 'failed to add product';
				}
			}
			else
			{
				echo "Failed Try Again.!";
			}

		}
		else
		{
			echo validation_errors();
		}	
	}

	// Saving Oil Maintenance //

	public function add_oil_maintenance()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		$data=$this->input->post();
		$data['vehicle_id']=$vehicle_id;
		//print_r($data);
		$config= array(
				 array('field' =>'expense_bill_no' ,'rules'=>'required|min_length[2]'),
		 		 array('field' =>'pp_start_km' ,'rules'=>'required|numeric'),
		  		 array('field' =>'pp_expected_run' ,'rules'=>'required|numeric'),
				 array('field' =>'expense_amount' ,'rules'=>'required|numeric'),
		);

		$this->load->library('form_validation',$config);

		if($this->form_validation->run()==true)
		{
			$product = ['pp_start_km'=>$data['pp_start_km'],'pp_expected_run' => $data['pp_expected_run'],'vehicle_id'=>$data['vehicle_id'],'expense_details_id'=>$data['expense_details_id']];
			

			$expense = array_diff_key($data, $product);
			$vers = ['vehicle_id'=>$product['vehicle_id'],'vehicle_current_reading'=>$product['pp_start_km']];
			if (!check_current_reading_greater($this,$vers)) {
				echo 'please check kilometer reading you provided is lower than older ';
				die();
			}
			if($insert_id = $this->maintenance_model->add_product($product))
			{
				$expense['product_purchase_id'] = $insert_id;
				if ($this->maintenance_model->insert_expenses($expense)) {
					update_vehicle_km($this,$vers);
					echo "New add success ";
				}else{
					$this->maintenance_model->delete_product($insert_id);
					echo 'failed to add product';
				}
			}
			else
			{
				echo "Failed Try Again.!";
			}
		}
		else
		{
			echo validation_errors();
		}	
	}

	// Saving Battery Maintenance //

	public function add_battery_maintenance()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		$data=$this->input->post();
		$data['vehicle_id']=$vehicle_id;
		//print_r($data);
		
		$config= array(
				 array('field' =>'expense_bill_no' ,'rules'=>'required|min_length[2]'),
		 		 array('field' =>'pp_warranty' ,'rules'=>'required|numeric'),
		  		 array('field' =>'expense_amount' ,'rules'=>'required|numeric'),
		  		 array('field' =>'pp_serial_no' ,'rules'=>'required'),
				 array('field' =>'expense_name' ,'rules'=>'required|min_length[2]'),
				);

		$this->load->library('form_validation',$config);
		if($this->form_validation->run()==true)
		{
			$product = ['pp_warranty'=>$data['pp_warranty'],'pp_serial_no'=>$data['pp_serial_no'],'vehicle_id'=>$data['vehicle_id'],'expense_details_id'=>$data['expense_details_id']];
			// print_r($product);

			$expense = array_diff_key($data, $product);
			
			if($insert_id = $this->maintenance_model->add_product($product))
			{
				$expense['product_purchase_id'] = $insert_id;
				if ($this->maintenance_model->insert_expenses($expense)) {
					echo "New add success ";
				}else{
					$this->maintenance_model->delete_product($insert_id);
					echo 'failed to add product';
				}
			}
			else
			{
				echo "Failed Try Again.!";
			}
		}
		else
		{
			echo validation_errors();
		}
	}

// Saving Battery Maintenance //

	public function update_battery_maintenance()
	{
		$expense_details_id=$this->input->post('expense_details_id');
		$data=$this->input->post();
		//$data['vehicle_id']=$vehicle_id;
		//print_r($data);
		$config= array(
				 array('field' =>'expense_bill_no' ,'rules'=>'required|min_length[2]'),
		 		 array('field' =>'pp_warranty' ,'rules'=>'required|numeric'),
		  		 array('field' =>'expense_amount' ,'rules'=>'required|numeric'),
		  		 array('field' =>'pp_serial_no' ,'rules'=>'required'),
				 array('field' =>'expense_name' ,'rules'=>'required|min_length[2]'),
				);

		$this->load->library('form_validation',$config);
		if($this->form_validation->run()==true)
		{
			if($this->maintenance_model->update_battery_maintenance_info($expense_details_id,$data))
			{
				echo " Battery Record Update ";
			}
			else
			{
				echo "Failed Try Again.!";
			}
		}
		else
		{
			echo validation_errors();
		}
	}

// Saving Battery Recharge Maintenance //

	public function add_recharge_battery()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		$data=$this->input->post();
		print_r($data);
		$data['vehicle_id']=$vehicle_id;
		$config= array(
				 array('field' =>'expense_bill_no' ,'rules'=>'required|min_length[2]'),
		  		 array('field' =>'expense_amount' ,'rules'=>'required|numeric'),
				 array('field' =>'expense_name' ,'rules'=>'required|min_length[2]'),
				);

		$this->load->library('form_validation',$config);
		if($this->form_validation->run()==true)
		{
			if($this->maintenance_model->add_recharge_battery_info($data))
			{
				echo "Battery Recharge Record Added.";
			}
			else
			{
				echo "Failed Try Again.!";
			}
		}
		else
		{
			echo validation_errors();
		}
		
	}

	public function assign_battery()
	{
		$old_id=$this->input->get('old_id');
		$data=$this->input->post();
			if($this->maintenance_model->assign_battery($old_id,$data))
			{
				echo " Battery Assign ";
			}
			else
			{
			echo "Failed Try Again.!";
			}
	}
		
	public function fetch_update_battery_info()
	{
		$expense_details_id= $this->input->get('expense_details_id');
		$expense_name= $this->input->get('v_name');
		$data=$this->maintenance_model->fetch_battery_info($expense_details_id);
		foreach ($data as $value) {
		echo '<div class="modal-dialog ">
        <div class="modal-content">
            <form id="update_battery_form" method="post" action="javascript:void(0);">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Update Battery</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="firstName">Vehicle Name</label>
                                 <input type="text" id="vehicle1" name="vehicle" class="form-control" value="'.$expense_name.'" required="required" disabled="disabled">
                                <input type="hidden" id="pp_id" name="pp_id" class="form-control" value="3" >
                                <input type="hidden" id="expense_details_id" name="expense_details_id" class="form-control" value="'.$value->expense_details_id.'" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input value='.$value->expense_date.' type="date" id="expense_date" name="expense_date" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Bill No.</label>
                                <input value='.$value->expense_bill_no.' type="text" name="expense_bill_no" id="expense_bill_no" class="form-control" required="required" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Brand Name</label>
                                <input value='.$value->expense_name.' type="text" name="expense_name" id="expense_name" class="form-control" required="required" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Serial No.</label>
                                <input value='.$value->pp_serial_no.' type="text" name="pp_serial_no" id="pp_serial_no" class="form-control" required="required" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Warranty</label>
                                <input value='.$value->pp_warranty.' type="text" id="pp_warranty" name="pp_warranty" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" value='.$value->expense_amount.' id="expense_amount" name="expense_amount" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Comment</label>
                                <textarea  value="note" name="note"   class="form-control">'.$value->note.'</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>';
		}
	}



	// Saving Miscellanious Maintenance //

	public function add_misc_maintenance()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		$data=$this->input->post();
		$data['vehicle_id']=$vehicle_id;
		//print_r($data);
		$config= array(
				 array('field' =>'expense_bill_no' ,'rules'=>'required|min_length[2]'),
		  		 array('field' =>'expense_amount' ,'rules'=>'required|numeric'),
				 array('field' =>'expense_name' ,'rules'=>'required|min_length[2]'),
				);

		$this->load->library('form_validation',$config);
		if($this->form_validation->run()==true)
		{
			$product = ['vehicle_id'=>$data['vehicle_id'],'expense_details_id'=>$data['expense_details_id']];
			// print_r($product);

			$expense = array_diff_key($data, $product);
			
			if($insert_id = $this->maintenance_model->add_product($product))
			{
				$expense['product_purchase_id'] = $insert_id;
				if ($this->maintenance_model->insert_expenses($expense)) {
					echo "New add success ";
				}else{
					$this->maintenance_model->delete_product($insert_id);
					echo 'failed to add product';
				}
			}
			else
			{
				echo "Failed Try Again.!";
			}
		}
		else
		{
			echo validation_errors();
		}
	}
	
	// Saving Permit And Clearance Maintenance //

	public function add_permit_maintenance()
	{
		$vehicle_id=$this->input->get('vehicle_id');
		$data=$this->input->post();
		$data['vehicle_id']=$vehicle_id;
		//print_r($data);
		$config= array(
				array('field'=>'expense_details_id','rules'=>'required|numeric'),
				 array('field' =>'expense_bill_no' ,'rules'=>'required|min_length[2]'),
		  		 array('field' =>'expense_amount' ,'rules'=>'required|numeric'),
				);

		$this->load->library('form_validation',$config);
		if($this->form_validation->run()==true)
		{
			$product = ['pp_expiry'=>$data['pp_expiry'],'vehicle_id'=>$data['vehicle_id'],'expense_details_id'=>$data['expense_details_id']];

			$expense = array_diff_key($data, $product);
			
			if($insert_id = $this->maintenance_model->add_product($product))
			{
				$expense['product_purchase_id'] = $insert_id;
				if ($this->maintenance_model->insert_expenses($expense)) {
					echo "New add success ";
				}else{
					$this->maintenance_model->delete_product($insert_id);
					echo 'failed to add product';
				}
			}
			else
			{
				echo "Failed Try Again.!";
			}
		}
		else
		{
			echo validation_errors();
		}
	}
	public function __construct()
	{
		parent::__construct();
		$this->load->model('maintenance_model');
	}


	private function _filter_data($tyre = array(),$oil = array(),$battery = array(),$misc = array(),$permit= array()){
		$table = [];
		$count = 1;
		foreach ($tyre as  $value) {
			$color = "";
			$run = ($value->pp_total_run + ($value->vehicle_current_reading - $value->pp_start_km));
			if ($value->expense_details_id == 4) {
                    $color = 'bg-success';
                    $run = $value->pp_total_run;
                    // if tyre is a stepny 
                }elseif ($value->expense_details_id == 13) {
                	$color = 'bg-warning';
                	// if tyre is remould
                }
		$table['tyre'][] = '<tr  class="'.$color.'">
                    <td >'.$count++.'</td>
                    <td>'.$value->expense_name.'</td>
                    <td>'.$value->pp_serial_no.'</td>
                    <td>'.$value->expense_date.'</td>
                    <td>'.$run.'/'.$value->pp_expected_run.'</td>
                    <td>'.$value->expense_amount.'</td>
                    <td>'.$value->expense_bill_no.'</td>
                    <td>'.$value->note.'</td>
                    <td p_id="'.$value->pp_id.'" serial="'.$value->pp_serial_no.'" v_id="'.$value->vehicle_id.'">
                        <a class="btn btn-info fa fa-edit" data-toggle="modal" id="remould_btn" href="#remold_tyre"> Remold</a>
                        <a class="btn btn-warning fa fa-cog" data-toggle="modal" href="#Assign_to_vehicle" id="assingTyreVehicle"> assign</a>
                        <a class="btn btn-primary fa fa-arrow-right" id="stepney_btn" data-toggle="modal" href="#stepney">
                        </a>
                    </td>
                </tr>';
	}

	$count=1;
	foreach ($oil as  $value) {
		$table['oil'][] = '<tr>
                    <td>'.$count++.'</td>
                    <td>'.$value->expense_name.'</td>
                    <td>'.$value->expense_date.'</td>
                    <td>'.$value->pp_start_km.'</td>
                    <td>'.(($value->vehicle_current_reading - $value->pp_start_km)).'/'.$value->pp_expected_run.'</td>
                    <td>'.$value->expense_amount.'</td>
                    <td>'.$value->expense_bill_no.'</td>
                    <td>'.$value->note.'</td>
                </tr>';
	}
	$count=1;
	foreach ($battery as  $value) {
		$table['battery'][] = '<tr>
                    <td>'.$count++.'</td>
                    <td>'.$value->expense_name.'</td>
                    <td>'.$value->expense_date.'</td>
                    <td>'.$value->pp_warranty.'</td>
                    <td>'.$value->expense_amount.'</td>
                    <td>'.$value->pp_serial_no.'</td>
                    <td>'.$value->expense_bill_no.'</td>
                    <td>'.$value->note.'</td>
                    <td value="'.$value->expense_details_id.'" >
                    <a  data-toggle="modal" id="update123" href="#update_battery_modal" class="btn btn-info fa fa-edit" value="'.$value->expense_details_id.'">
                            </a>
                            <a id="recharge" class="btn btn-warning fa fa-cog" data-toggle="modal" href="#maintain_battery"></a>
                            <a id="assign_bat" class="btn btn-primary fa fa-car" data-toggle="modal" href="#battery_assign"></a>
                    </td>
                </tr>';
	}

	$count=1;
	foreach ($misc as  $value) {
		$table['misc'][] = '<tr>
                    <td>'.$count++.'</td>
                    <td>'.$value->expense_name.'</td>
                    <td>'.$value->expense_date.'</td>
                    <td>'.$value->expense_amount.'</td>
                    <td>'.$value->expense_bill_no.'</td>
                    <td>'.$value->note.'</td>
                </tr>';
	}
	$count=1;
	foreach ($permit as  $value) {
		$table['permit'][] = '<tr>
                    <td>'.$count++.'</td>
                    <td>'.$value->ed_name.'</td>
                    <td>'.$value->expense_date.'</td>
                      <td>'.$value->pp_expiry.'</td>
                    <td>'.$value->expense_bill_no.'</td>
                    <td>'.$value->expense_amount.'</td>
                    <td>'.$value->note.'</td>
                </tr>';
	}
echo json_encode($table);
}


}

/* End of file Maintenance_controller */
/* Location: ./application/controllers/Maintenance_controller */