<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">End Step</h3>
	</div>
	<div class="panel-body">
		<form action="javaScript(void(0));" method="POST" role="form" id="end_step_form">
			<legend>End Step</legend>
			
			<input type="hidden" name="trip_details_id" class="form-control" value="<?php echo $step_id; ?>">
			
			<div class="row">
			<div class="form-group col-md-12">
				<label for="">End date</label>
				<input type="date" class="form-control col-md-6" name="step_end_date" placeholder="dd/mm/yyyy" required="">
			</div>
			<div class="form-group col-md-12">
				<label for="">Note</label>
				<textarea name="trip_details_note" class="col-lg-6 form-control" required=""></textarea>
			</div>
		</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>