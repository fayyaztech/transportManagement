
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
					<form method="post" id="document_form" enctype="multipart/form-data" >
					<div class="row">

						<input type="hidden" name="driver_id" value="<?php echo $this->input->get('driver_id'); ?>">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Id Proof</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							<select name="identity_id" class="form-control" required="required">
									<?php 
										foreach ($id_docs as $value) {
											echo '<option value="'.$value->identity_id.'">'.$value->id_name.'</option>';
										}
									?>
							</select>
								
							</div>
						</div>
						<!-- <div class="col-md-4">
							<div class="form-group">
							<input type="file" name="id_file"  autofocus="autofocus">
							</div>
						</div> -->
					</div>

					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Id Number</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="number" name="driver_identy_id_no" class="form-control" autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Address Proof</label>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<select name="address_id" class="form-control" required="required">
									<?php 
										foreach ($id_docs as $value) {
											echo '<option value="'.$value->identity_id.'">'.$value->id_name.'</option>';
										}
									?>
								</select>
								
							</div>
						</div>
						<!-- <div class="col-md-4">
							<div class="form-group">
							<input type="file" name="address_file" autofocus="autofocus">
							</div>
						</div> -->
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">address Proof Id</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="upload" name="driver_address_id_no" class="form-control" autofocus="autofocus">
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">driver_licence_no</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="text" name="driver_licence_no" class="form-control"autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Expiry Date</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<input type="date" name="driver_licence_exp" class="form-control"  autofocus="autofocus">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="">Date of Joining</label>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
							<input type="date" name="driver_date_of_join" class="form-control"  autofocus="autofocus">
							</div>
						</div>
					</div>
					
					<button type="submit" class="btn btn-success pull-right btn-lg" id="document_info">Next</button>
					
					</form>
				</div>
				
			</div>
		</div>
	</div>
</div>
