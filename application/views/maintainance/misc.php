<div class="row">
    <br>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a type="button" class="btn btn-success btn-md pull-right" data-toggle="modal" href='#Add_expenses'>Add Expenses</a>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-primary">
                    <tr>
                        <th>Sr.</th>
                        <th>Misc Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Bill No.</th>
                        <th>Comment</th>
                        
                    </tr>
                </thead>
                <tbody id="misc_table">
                   
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--add expenses form-->
<div class="modal fade" id="Add_expenses">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form id="add_misc_form" method="post" action="javascript:void(0);">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Miscellanious</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="firstName">Vehicle Name</label>
                                 <input type="text" id="m_vehicle" name="vehicle" class="form-control" value="vehicle name" required="required" disabled="disabled">

                                <input type="hidden" id="pp_id" name="expense_details_id" class="form-control" value="7" >
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
                                <label for="">Misc Name</label>
                                <input type="text" id="vm_name" name="expense_name" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Bill No.</label>
                                <input type="text" name="expense_bill_no" id="vm_bill_no" class="form-control" value="" required="required" >
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
<!-- end of add_expenses-->