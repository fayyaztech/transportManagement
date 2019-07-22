<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form action="javascript:void();" id="stop_trip_form" accept-charset="utf-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Complete Trip</h3>
				</div>
				<div class="panel-body">
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="select Allowance"><span class="text-danger">*</span>Trip Stop date</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="date" name="trip_stop_date" class="form-control" placeholder="reading" autofocus="autofocus">
							</div>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="expense"><span class="text-danger">*</span>Total trip Expense</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="text" name="trip_total_expense" class="form-control" placeholder="total trip expense"  autofocus="autofocus">
							</div>
						</div>
						
					</div>					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="expense">Comment</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
									<textarea name="note" id="textareaComment" class="form-control" rows="3"></textarea>
							</div>
						</div>
						<input type="hidden" name="trip_id" value="<?php echo $this->input->get('trip_id'); ?>">
						
					</div>
					<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
					<button type="submit" class="btn btn-success pull-right btn-lg" id="personal_information">Stop trip</button>
					</div>
					
				</div>
				
			</div>
		</form>
		
	</div>
</div>
</div>