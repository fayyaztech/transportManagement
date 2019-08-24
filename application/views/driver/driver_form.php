<?php
$data_empty = false;
$profile_view = false;
if (!empty($driver_data))$data_empty = true;
if($this->input->get('action') == "view")$profile_view=true;

?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="text-center">Personal Information</h3>
			</div>
			<div class="panel-body">
				<form method="post" id="driver_form">
					<h3>Personal Info</h3>
					<hr>
					<?php
						if ($data_empty) {
					?>
					<input type="hidden" name="driver_id" value="<?php echo $driver_data[0]["driver_id"]; ?>">
					<?php
					}
					?>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="firstName">Name</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="driver_name" class="form-control" placeholder="Name" autofocus="autofocus" required="" <?php if($data_empty) echo "value='".$driver_data[0]['driver_name']."'"; if($profile_view)echo "disabled";?>>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<label for="firstName">Date Of Birth</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="date" name="driver_dob" class="form-control" autofocus="autofocus" <?php if($data_empty) echo "value='".$driver_data[0]['driver_dob']."'"; if($profile_view)echo "disabled";?>>
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
								<input type="tel" name="driver_number" class="form-control" placeholder="Contact Number" autofocus="autofocus" required="" <?php if($data_empty) echo "value='".$driver_data[0]['driver_number']."'"; if($profile_view)echo "disabled";?>>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="email">Email</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="email" name="driver_email" class="form-control" placeholder="email" autofocus="autofocus" required="" <?php if($data_empty) echo "value='".$driver_data[0]['driver_email']."'"; if($profile_view)echo "disabled";?>>
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
								<input type="date" name="driver_date_of_join" class="form-control"  autofocus="autofocus" required="" <?php if($data_empty) echo "value='".$driver_data[0]['driver_date_of_join']."'"; if($profile_view)echo "disabled";?>>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Salary</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="numeric" name="driver_salary" class="form-control" required=""  autofocus="autofocus" required="" <?php if($data_empty) echo "value='".$driver_data[0]['driver_salary']."'"; if($profile_view)echo "disabled"; ?>>
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
								<input type="text" name="driver_licence_no" class="form-control"autofocus="autofocus" required="" <?php if($data_empty) echo "value='".$driver_data[0]['driver_licence_no']."'"; if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Expiry Date</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="date" name="driver_licence_exp" class="form-control"  autofocus="autofocus" required="" <?php if($data_empty) echo "value='".$driver_data[0]['driver_licence_exp']."'"; if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Adhar no</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="driver_adhar_no" class="form-control"autofocus="autofocus" required="" <?php if($data_empty) echo "value='".$driver_data[0]['driver_adhar_no']."'"; if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Upload Adhar or Any Id</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="file" name="driver_licance_doc" class="form-control"  autofocus="autofocus" <?php if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
					</div>
					<hr><h3>Bank Details</h3> <hr>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Name As per Bank Account</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="driver_bank_name" class="form-control"autofocus="autofocus" <?php if($data_empty) echo "value='".$driver_data[0]['driver_bank_name']."'"; if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">bank A/C no</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="driver_bank_ac" class="form-control"autofocus="autofocus" <?php if($data_empty) echo "value='".$driver_data[0]['driver_bank_ac']."'"; if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Bank IFSC Code</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="driver_bank_ifsc" class="form-control"  autofocus="autofocus" <?php if($data_empty) echo "value='".$driver_data[0]['driver_bank_ifsc']."'"; if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
					</div>
					<hr>
					<h3>Driver Reference </h3>
					<hr>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Name (refer)</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="driver_refer_name" class="form-control"autofocus="autofocus" <?php if($data_empty) echo "value='".$driver_data[0]['driver_refer_name']."'"; if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Adhar No</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="text" name="driver_refer_adhar" class="form-control"autofocus="autofocus" <?php if($data_empty) echo "value='".$driver_data[0]['driver_refer_adhar']."'"; if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
						
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Reference ID</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="file" name="driver_refer_id" class="form-control"  autofocus="autofocus" <?php if($profile_view)echo "disabled"; ?>>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="firstName">Address</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<textarea name="driver_permanent_address" class="form-control" required="" <?php if($profile_view)echo "disabled"; ?>><?php if($data_empty) echo $driver_data[0]['driver_permanent_address'];?></textarea>
							</div>
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-success pull-right btn-lg" id="personal_information" <?php if($profile_view)echo "disabled"; ?>><?php if($data_empty){echo "Update";}else{echo "Save";} ?></button>
						</div>
					</div>
				</div>
			</form>
			
		</div>
	</div>
</div>