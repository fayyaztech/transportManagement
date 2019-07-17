<div class="row">
    <br>
    <div class="col-md-2 col-md-offset-10">
       <!--  <a type="button" class="btn btn-warning btn-md " data-toggle="modal" href='#Add_relevel'>Relevel</a> --> 
        <a type="button" class="btn btn-success btn-md float-right" data-toggle="modal" href='#Add_refill'>Refill Oil</a>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-primary">
                    <tr>
                        <th>sr. no</th>
                        <th>Name</th>
                        <th>Filling Date</th>
                        <th>Start Km</th>
                        <th>Remaining Km</th>
                        <th>Amount</th>
                        <th>Bill No.</th>
                        <th>Comments</th>
                        
                        
                    </tr>
                </thead>
                <tbody id="oil_table">                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--refill  -->
<div class="modal fade" id="Add_refill">
    <div class="modal-dialog ">
        <div class="modal-content">
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
        </div>
    </div>
</div>
<!-- refill ends-->

<!--relevel -->
<div class="modal fade" id="Add_relevel">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form action="battery_submit" method="post" accept-charset="utf-8">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Relevel</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">For</label>
                                <input type="text" id="vehicle" name="vehicle" class="form-control" value="vehicle name" required="required" disabled="disabled">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" id="oil_date" name="oil_date" class="form-control" required="required">
                            </div>
                        </div>
                       
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Bill No.</label>
                                <input type="text" name="oil_bill" id="oil_bill" class="form-control" value="" required="required" pattern="" title="">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" id="oil_amount" name="oil_amount" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Km Reading</label>
                                <input type="text" id="oil_km_reading" name="oil_km_reading" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Expected Run</label>
                                <input type="text" id="oil_exp_run" name="oil_exp_run" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Comment</label>
                                <textarea  id="oil_comment" name="oil_comment"   class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--relevel ends-->
