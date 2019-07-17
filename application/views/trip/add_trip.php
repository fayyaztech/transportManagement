<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form action="javascript:void();" method="post" id="add_trip" accept-charset="utf-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Add Trip</h3>
				</div>
				<div class="panel-body">
					<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-2">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="select truck">Trip Date</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="date" name="trip_date" id="inputTrip_date" class="form-control" value="" required="required" title="">
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Select Consignee</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<select name="consignee_id" id="select_consignee" class="form-control" required="required">
										<option value="">select Consignee</option>
										<?php	foreach (fetch_consignees($this) as $value)
										{
										echo '<option value="'.$value->consignee_id.'">'.$value->consignee_name.'</option>';
										}
										?>
									</select>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="select truck">Select Truck <span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<select name="vehicle_id" id="vehicle_id" class="form-control" required="required">
										<option value="">select truck</option>
										<?php	foreach (fetch_vehicle_list($this) as $value)
										{
										echo '<option value="'.$value->vehicle_id.'">'.$value->vehicle_number.'</option>';
										}
										?>
									</select>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="select driver">Select Driver<span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<select name="driver_id" id="driver_id" class="form-control" required="required">
										<option value="">Select Driver</option>
										<?php
										// $data = fetch_driver($this,0);
										// print_r($data);
										foreach (fetch_driver($this,0) as $value)
										{
										echo '<option value="'.$value->driver_id.'">'.$value->driver_name.'</option>';
										}
										?>
									</select>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="">Add Load<span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<select name="load_id" id="load_id" class="form-control" required="required">
										<option value="">select load</option>
										<?php	foreach (fetch_load_types($this) as $value)
										{
										echo '<option value="'.$value->load_id.'">'.$value->load_name.'</option>';
										}
										?>
									</select>
								</div>
							</div>
							
						</div>
						<div class="row">
							
							<div class="col-md-2">
								<div class="form-group">
									<label for="select Route">Route<span class="text-danger">*</span></label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<select name="route_id" id="routes" class="form-control" required="required">
										
									</select>
								</div>
							</div>
						</div>
						<!-- <div class="row">
								<div class="col-md-2">
										<div class="form-group">
												<label for="">Standard Fuel</label>
										</div>
								</div>
								<div class="col-md-3">
										<div class="form-group">
												<input type="text" name="t_fuel" class="form-control" placeholder="fuel"  autofocus="autofocus">
										</div>
								</div>
								<div class="col-md-2">
										<div class="form-group">
												<label for="">Standard duration</label>
										</div>
								</div>
								<div class="col-md-3">
										<div class="form-group">
												<input type="text" name="t_std_duration" class="form-control" placeholder="duration"  autofocus="autofocus">
										</div>
								</div>
						</div>
						-->
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="select Route">Add Advance</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<div class="form-group">
										<input type="text" name="trip_advance" class="form-control" placeholder="advance"  autofocus="autofocus">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="select Allowance"><span class="text-danger">*</span>Allowance Issued</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" name="trip_allowance" class="form-control" placeholder="allowance"  autofocus="autofocus">
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="select Allowance"><span class="text-danger">*</span>Current Km Reading</label>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<input type="text" name="trip_start_km" class="form-control" placeholder="reading"  autofocus="autofocus">
								</div>
							</div>
							
						</div>
						
						<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
						<button type="submit" class="btn btn-success pull-right btn-lg" id="personal_information">Submit</button>
					</div>
					
				</div>
				
			</div>
		</form>
	</div>
</div>