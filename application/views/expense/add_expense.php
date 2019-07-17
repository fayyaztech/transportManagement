<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<form action="javascript:void();" method="get" id="add_expense_form" accept-charset="utf-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="text-center">Add Expense</h3>
				</div>
				<div class="panel-body">
					
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">
						<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="select truck">Expense Type</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<select name="expense_name" id="inputSelect_truck" class="form-control" required="required">
									<?php 

										foreach (getGenralExpense($this) as $value) {
											echo "<option value='".$value->ed_id."'>".$value->ed_name."</option>";
										}
									 ?>
								</select>
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Billing Date</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="date" name="expense_date" id="inputBill_date" class="form-control" value="" required="required" title="">
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Bill No</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="text" name="expense_bill_no" id="inputBill_no" class="form-control" required="">
							</div>
						</div>
						
					</div>
					<!-- <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Biller Name</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="text" name="biller_name" class="form-control" placeholder="biller name"  autofocus="autofocus">
							</div>
						</div>
						
					</div> -->
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Vendor Name</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="text" name="expense_vendar_name" class="form-control" placeholder="vendor name"  autofocus="autofocus">
							</div>
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Amount</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="text" name="expense_amount" class="form-control" placeholder="amount"  autofocus="autofocus" required="">
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Note</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<textarea name="note" class="form-control" autofocus="autofocus"></textarea>
							</div>
						</div>
						
					</div>
					<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
				<button class="btn btn-success pull-right btn-lg" id="">Submit</button>
					
					</div>
				</div>
				
			</div>
		</form>
		
	</div>
</div>
</div>