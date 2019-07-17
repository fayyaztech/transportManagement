<div class="row">
    <br>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <a type="button" class="btn btn-success btn-md pull-right" data-toggle="modal" href='#Add_battery'>Add Battery</a>
    </div>
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-primary">
                    <tr>
                        <th>sr. no.</th>
                        <th>Battery Name</th>
                        <th>Date</th>
                        <th>Warranty</th>
                        <th>Amount</th>
                        <th>serial No.</th>
                        <th>Bill No.</th>
                        <th>comment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="battery_table"></tbody>
            </table>
        </div>
    </div>
</div>
<!--add battery modal-->
<div class="modal fade" id="Add_battery">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form id="add_battery_form" method="post" action="javascript:void(0);">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Battery</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="firstName">Vehicle Name</label>
                                 <input type="text" id="vehicle1" name="vehicle" class="form-control" value="vehicle name" required="required" disabled="disabled">
                                <input type="hidden" id="pp_id" name="expense_details_id" class="form-control" value="3" >
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
                                <label for="">Bill No.</label>
                                <input type="text" name="expense_bill_no" id="expense_bill_no" class="form-control" value="" required="required" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Brand Name</label>
                                <input type="text" name="expense_name" id="expense_name" class="form-control" value="" required="required" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Serial No.</label>
                                <input type="text" name="pp_serial_no" id="pp_serial_no" class="form-control" value="" required="required" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Warranty</label>
                                <input type="text" id="vm_warranty" name="pp_warranty" class="form-control" required="required">
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
                                <textarea  id="vm_comment" name="note"   class="form-control"></textarea>
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
<!-- end add battery-->

<!--update battery modal-->

<div class="modal fade" id="update_battery_modal">
    
</div>

<!-- update battery modal Ends-->


<!-- maintain battery-->
<div class="modal fade" id="maintain_battery">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form action="javascript:void(0);" id="recharge_battery" method="post" accept-charset="utf-8">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Maintain Battery</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Maintenance For</label>
                                <input type="text" id="name" name="vm_name" class="form-control" required="required" readonly="true" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Type Of Maintainance</label>
                                <select name="pp_id" id="pp_id" class="form-control" required="required">
                                    <option value="7">Recharge</option>
                                    <option value="">others</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" id="vm_date" name="vm_date" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" name="vm_amount" id="vm_amount" class="form-control" required="required" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Bill No.</label>
                                <input type="text" name="vm_bill_no" id="vm_bill_no" class="form-control" value="" required="required">
                            </div>
                        </div>
                       
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Comment</label>
                                <textarea id="vm_note" name="vm_note" class="form-control"></textarea>
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
<!-- end maintain-->
<!-- battery assign to-->

<div class="modal fade" id="battery_assign">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="assign_battery" action="javascript.void(0);" method="post" accept-charset="utf-8">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Assign Battery</h4>
                </div>
                <div class="modal-body">
                    <?php $vehicle_list = fetch_vehicle_list($this);
                     ?>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Assign Battery</label>
                                <input type="text" id="assign_name" name="vehicle" class="form-control" readonly="" >
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">To</label>
                                <select name="vehicle_id" id="truck" class="form-control" required="required">
                                    <?php foreach ($vehicle_list as $value) {
                                        echo '<option value="'.$value->vehicle_id.'">'.$value->vehicle_number.'</option>';
                                    } ?>
                                </select>
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
<!--battery assign ends-->