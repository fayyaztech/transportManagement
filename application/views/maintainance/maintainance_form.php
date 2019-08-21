<form id="maintainance_form" method="post" action="javascript:void(0);">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Maintanance Form</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <input type="hidden" name="vehicle_id" id="vehicle_id" class="form-control" value="<?php echo $vehicle_id;?>">
                    <label for="">vehicle number</label>
                    <input type="text" id="vehicle_number" class="form-control" value="<?php echo $vehicle_number;?>" required="required"
                        disabled="disabled">
                </div>
            </div>

            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Type</label>
                    <select class="form-control" name="mnt_type" id="mnt_type">
                        <option value="1">Tyre</option>
                        <option value="2">Oil</option>
                        <option value="3">Battry</option>
                        <option value="4">Body Work</option>
                        <option value="5">Engin Work</option>
                        <option value="6">Misc. Repair</option>                        
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="mnt_date" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Brand Name</label>
                    <input type="text" id="mnt_name" name="mnt_name" class="form-control" required="required">
                </div>
            </div>

            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Bill No.</label>
                    <input type="text" name="mnt_bill_no" class="form-control" value=""
                        required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Shop Name</label>
                    <input type="text" name="mnt_shop_name" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="text" name="mnt_amount" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Searial No.</label>
                    <input type="text" name="mnt_serial_no" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Warranty (in Months)</label>
                    <input type="text" name="mnt_warranty" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Total Run</label>
                    <input type="text" name="mnt_total_ran" class="form-control" required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Expected Run</label>
                    <input type="text" id="vm_expected_km" name="mnt_expected_run" class="form-control"
                        required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Note</label>
                    <textarea id="vm_note" name="mnt_note" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>