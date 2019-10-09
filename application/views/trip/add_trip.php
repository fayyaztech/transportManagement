<form action="javascript:void();" method="post" id="add_trip" accept-charset="utf-8">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="text-center">Add Trip</h3>
		</div>
		<div class="panel-body">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">

					<div class="col-md-2">
						<div class="form-group">
							<label for="select truck">Trip Date</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="date" name="trip_start_date" id="inputTrip_date" class="form-control" value=""
								required="required" title="">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Select Consignor</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="consignor_id" id="select_consignor" class="form-control" required="required">
								<option value="">select consignor</option>
								<?php foreach (fetch_consignor($this) as $value) {
									echo '<option value="' . $value->consignor_id . '">' . $value->consignor_name . '</option>';
								}
								?>
							</select>
						</div>


					</div>
					<div class="col-md-1">
						<button type="button" class="btn btn-primary pull-right" data-toggle="modal" href='#modal-id'
							id="add_consignor"> <i class="fa fa-plus"></i> Consignor</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Select consignee</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="consignee_id" id="select_consignee" class="form-control" required="required">
								<option value="">select consignee</option>

							</select>
						</div>
					</div>
					<div class="col-md-1">
						<button type="button" class="btn btn-primary pull-right" data-toggle="modal" href='#modal-id'
							id="add_consignee"> <i class="fa fa-plus"></i> consignee</button>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="select Route">Route<span class="text-danger">*</span></label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="route_id" id="select-routes" class="form-control" required="required">
								
							</select>
						</div>
					</div>
					<div class="col-md-1">
						<button type="button" class="btn btn-primary pull-right" data-toggle="modal" href='#modal-id'
							id="add_route"> <i class="fa fa-plus"></i> Route</button>
					</div>

				</div>

				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label for="select truck">Select Truck <span class="text-danger">*</span></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select name="vehicle_id" id="vehicle_id" class="form-control select_vehicle" required="required">

								<option value="">select truck</option>

								<?php

										if (!empty(fetch_vehicle_list($this))) {
											foreach (fetch_vehicle_list($this) as $value) {
												echo '
												<option value="' . $value->vehicle_id . '">' . $value->vehicle_number . '</option>';
											}
										} else {
											echo '<option value="">Not Available</option>';
										}
										?>
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="select driver">Select Driver<span class="text-danger">*</span></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select name="driver_id" id="driver_id" class="form-control" required="required">
								<option value="">Select Driver</option>
								<?php
// $data = fetch_driver($this,0);
// print_r($data);
foreach (fetch_driver($this, 1) as $value) {
    echo '<option value="' . $value->driver_id . '">' . $value->driver_name . '</option>';
}
?>
							</select>
						</div>
					</div>
				</div>

				<div class="row">


					<div class="col-md-2">
						<div class="form-group">
							<label for="select Allowance"><span class="text-danger">*</span>Allowance Issued</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" name="allowance" class="form-control" placeholder="allowance"
								autofocus="autofocus">
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="select Route">Add Advance</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<div class="form-group">
								<input type="text" name="advance" class="form-control" placeholder="advance"
									autofocus="autofocus">
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Add Load<span class="text-danger">*</span></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<select name="load_id" id="loads_by_consignor" class="form-control">
							</select>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="select Allowance">
								<span class="text-danger">*</span>Freight</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="text" name="trip_detail_freight" class="form-control" placeholder="freight"
								autofocus="autofocus">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Vehicle Opening Km<span class="text-danger">*</span></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							
							<input type="number" name="trip_opening_km" class="form-control" >
							
						</div>
						</div>

						<div class="col-md-2">
						<div class="form-group">
							<label for="">Opening Diesel<span class="text-danger"></span></label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<input type="number" id="opening_diesel" name="opening_diesel" class="form-control" >
							
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6">
						<button type="button" class="btn btn-danger pull-right btn-lg"
							data-dismiss="modal">close</button>
						<button type="submit" class="btn btn-success pull-right btn-lg"
							id="personal_information">Submit</button>
					</div>
				</div>


			</div>

		</div>

	</div>
</form>

</div>
</div>
</div>