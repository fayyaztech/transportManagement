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
				<form method="post" id="document_upload" enctype="multipart/form-data" >
					<div class="row">
						<input type="hidden" name="driver_id" value="<?php echo $this->input->get('driver_id'); ?>">
						<div class="col-md-4">
							<div class="form-group">
								<input type="file" name="id_file"  autofocus="autofocus">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<input type="file" name="address_file" autofocus="autofocus">
							</div>
						</div>
						<button type="submit" class="btn btn-success pull-right btn-lg" id="document_info">Upload</button>
					</div>
				</form>
			</div>
		</div>
	</div>