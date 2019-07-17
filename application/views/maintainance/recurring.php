<div class="row">
    <br>
    <div class="col-md-2 col-md-offset-10">
        <a type="button" class="btn btn-warning btn-md " data-toggle="modal" href='#modal-id'>Add Permit </a>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-primary">
                    <tr>
                        <th>Sr.</th>
                        <th>Type</th>
                        <th>Bill Date</th>
                        <th>Renewal Date</th>
                        <th>Bill No.</th>
                        <th>Amount</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody id="permit_table">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Permits & Clearances</h4>
            </div>
            <div class="modal-body">
                
                  <form id="add_permit_form" method="post" action="javascript:void(0);">
                    <div class="panel">
                        <div class="panel-body">
                            
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="firstName">Vehicle Name</label>
                                 <input type="text" id="m_vehicle" name="vehicle" class="form-control" value="vehicle name" required="required" disabled="disabled">
                                
                            </div>
                        </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Type</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <select name="expense_details_id" class="form-control" required="required">
                                            <option value="">Select Type</option>
                                            <option value="10">Authorisation</option>
                                            <option value="11">National Permit</option>
                                            <option value="12">Fitness</option>
                                            <option value="9">Tax</option>
                                            <option value="8">Insurance</option>
                                            <option value="6">PUC</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select truck">Bill Date</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="date" name="expense_date" id="vm_date" class="form-control" value="" required="required" title="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select truck">Renewal Date</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="date" name="pp_expiry" id=vm_expiry_date" class="form-control" value="" required="required" title="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select truck">Bill No</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" name="expense_bill_no" class="form-control" placeholder="Bill No"  autofocus="autofocus">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select truck">Amount</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" name="expense_amount" class="form-control" placeholder="amount"  autofocus="autofocus">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select truck">Note</label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="text" name="note" class="form-control" placeholder="Note"  autofocus="autofocus">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success pull-right btn-lg" id="personal_information">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>