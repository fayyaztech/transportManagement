<?php if(!$this->input->get('driver_id')){echo "page not found try again";die();}
	$id_docs = fetch_identity_doc($this);
?>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="text-center">Upload Documents</h3>
			</div>
			<div class="panel-body">
				<form method="post" id="wage_form">
					<div class="row">
						<input type="hidden" name="driver_id" value="<?php echo $this->input->get('driver_id'); ?>">
						<div class="col-md-6">
							<div class="radio">
								<label>
									<input type="radio" name="wedge_type" value="2" checked="checked">
									Monthly
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="radio">
								<label>
									<input type="radio" name="wedge_type" value="3">
									Fixed Salary
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="radio">
								<label>
									<input type="radio" name="wedge_type" value="1">
									Trip based
								</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="radio">
								<label>
									<input type="radio" name="wedge_type" value="4">
									Daily
								</label>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Salary</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="numeric" name="driver_salary" class="form-control" required=""  autofocus="autofocus">
							</div>
						</div>
					</div>
					
					<button type="submit" class="btn btn-success pull-right btn-lg" id="salary_info">submit</button>
					
				</form>
			</div>
			
		</div>
	</div>
</div>
</div>