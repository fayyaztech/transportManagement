<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">End Trip</h3>
	</div>
	<div class="panel-body">
		<form action="javaScript(void(0));" method="POST" role="form" id="end_trip_form">
			<legend>End Trip</legend>

			<input type="hidden" name="trip_id" class="form-control" value="<?php echo $trip_id; ?>">

			<div class="row">
				<div class="form-group col-md-6">
					<label for="">End date</label>
					<input type="date" class="form-control col-md-6" name="trip_end_date" placeholder="dd/mm/yyyy"
						required="">
				</div>

				<div class="form-group col-md-6">
					<label for="">Trip Closing Km</label>
					<input type="number" class="form-control col-md-6" name="trip_closing_km"
						required="">
				</div>
			</div>

			<div class="row">

				<div class="form-group col-md-4">
					<label for="">OK Delivery</label>
					<input type="checkbox" class="form-control col-md-6" name="ok_delivery" value="1">
				</div>

				<div class="form-group col-md-8">
					<label for="">Ok delivery Remark</label>
					<input type="text" class="form-control col-md-6" name="ok_delivery_remark">
				</div>
			</div>

			<div class="row">

				<div class="form-group col-md-4">
					<label for="">Delivery In Time</label>
					<input type="checkbox" class="form-control col-md-6" name="in_time_delivery" value="1">
				</div>

				<div class="form-group col-md-8">
					<label for="">Delivery in Time Remark</label>
					<input type="text" class="form-control col-md-6" name="in_time_delivery_remark">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
					<label for="">Closing Diesel</label>
					<input type="text" class="form-control col-md-6" name="closing_diesel" require="">
				</div>

				<div class="form-group col-md-6">
					<label for="">Driver Incentive</label>
					<input type="number" class="form-control col-md-6" name="driver_incentive">
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
					<label for="">Closing balance</label>
					<input type="text" class="form-control col-md-6" value="<?php echo $closing_balance; ?>" disabled="true">
				</div>
					<input type="hidden" class="form-control col-md-6" name="closing_bal" value="<?php echo $closing_balance; ?>">
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label for="">Note</label>
					<textarea name="trip_details_note" class="col-lg-6 form-control" required=""></textarea>
				</div>
			</div>

			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>