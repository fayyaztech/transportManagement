<form id="add_oil_form" method="post" action="javascript:void(0);">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Refill</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <input type="hidden" name="expense_details_id" class="form-control" value="2">
                                <label for="">For</label>
                                <input type="text" id="vehicle" name="vehicle" class="form-control" value="vehicle name" required="required" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" id="vm_date" name="expense_date" class="form-control" required="required">
                            </div>
                        </div>

                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Brand Name</label>
                                <input type="text" id="vm_name" name="expense_name" class="form-control" required="required">
                            </div>
                        </div>
                       
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Bill No.</label>
                                <input type="text" name="expense_bill_no" id="expense_bill_no" class="form-control" value="" required="required" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" id="vm_amount" name="expense_amount" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Km Reading</label>
                                <input type="text" id="vm_km" name="pp_start_km" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Expected Run</label>
                                <input type="text" id="vm_expected_km" name="pp_expected_run" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Comment</label>
                                <textarea  id="vm_note" name="note"   class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>