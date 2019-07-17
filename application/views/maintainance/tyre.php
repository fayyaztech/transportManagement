<div class="row">
    <div class="col-lg-12">
        <br>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a type="button"  class="btn btn-success btn-md pull-right" data-toggle="modal" href='#add_tyre_model'>Add Tyre</a>
        </div>
        <table  class="table table-bordered table-hover">
            <thead class="bg-primary">
                <tr>
                    <th>Sr.</th>
                    <th>Tyre Name</th>
                    <th>Tyre No.</th>
                    <th>Installation Date</th>
                    <th>Tyre Run Km</th>
                    <th>Amount</th>
                    <th>Bill No.</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="tyre_table"></tbody>
        </table>
        
    </div>
    
</div>
<!--add tyre modal-->
<div class="modal fade" id="add_tyre_model">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form id="add_tyre_form" method="post" action="javascript:void(0);">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Tyre</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <h3>truck name</h3>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="expense_details_id" id="inputVm_tyre_type" value="1" checked="checked">
                                        Tyre
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="expense_details_id" id="inputVm_tyre_type" value="4">
                                        Stepney
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <!-- <input type="hidden" name="pp_id" class="form-control" value="1"> -->
                                <label for="">Date</label>
                                <input type="date" id="vm_date" name="expense_date" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Bill No.</label>
                                <input type="text" name="expense_bill_no" id="vm_bill_no" class="form-control" value="" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Current km</label>
                                <input type="text" name="pp_start_km" id="vm_km" class="form-control" value="" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Expected Run Km</label>
                                <input type="text" id="pp_expected_run" name="pp_expected_run" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Brand Name</label>
                                <input type="text" id="expense_name" name="expense_name" class="form-control" required="required">
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
                                <label for="">Tyre serial no.</label>
                                <input type="text" id="vm_tire_no" name="pp_serial_no" class="form-control" required="required">
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
                    <button type="submit" id="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--add tyre modal ends-->



<!--remold tyre modal-->
<div class="modal fade" id="remold_tyre">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form id="remould_tyre_form" method="post" accept-charset="utf-8">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Remold tyre</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="expense_details_id" value="13">
                        <input type="hidden" name="expense_name" value="Remold Tyre"> 
                        <input type="hidden" name="pp_id" id="pp_id">
                        <input type="hidden" name="pp_serial_no" id="pp_serial_no">
                        <input type="hidden" name="pp_warranty" value="0">

                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Remold Date</label>
                                <input type="date" id="remold_date" name="expense_date" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Bill No.</label>
                                <input type="text" name="expense_bill_no" id="b_bill" class="form-control" value="" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Expected Run</label>
                                <input type="text" name="pp_expected_run" id="expected_run" class="form-control" value="" required="required"  title="">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Current km</label>
                                <input type="text" name="pp_start_km" id="vm_km" class="form-control" value="" required="required">
                            </div>
                        </div>                       
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="text" id="remold_amount" name="expense_amount" class="form-control" required="required">
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Comment</label>
                                <textarea  id="remold_comment" name="note"   class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit_remold_tyre" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--remold ends-->
<!--assign to vehicle-->
<div class="modal fade" id="Assign_to_vehicle">
    <div class="modal-dialog ">
        <div class="modal-content">
            <form id="assign_tyre">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Asiign To Vehicle</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label id="vehicle_name"></label>
                            </div>
                        </div>     
                        <input type="hidden" name="vehicle_id" id="v_id">
                        <input type="hidden" name="pp_id" id="p_id">

                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="">Assign To</label>
                                <select id="assign_vehicle_name" name="assign_vehicle_name" class="form-control" required="required">
                                    <?php 
                                    foreach (fetch_vehicle_list($this,1) as $value) 
                                    {    
                                        echo '<option value="'.$value->vehicle_id.'">'.$value->vehicle_number.'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10 col-md-offset-1">
                            <div class="form-group">
                                <label for="firstName">KM of selected vehicle</label>
                                <input type="text" name="currentKm" id="input" class="form-control" value="" required="required" title="">
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="submit_assign_tyre" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="stepney">
    <div class="modal-dialog">
        <div class="modal-content">
                <form id="changeType">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Assign To Stepny</h4>
            </div>
            <div class="modal-body">
                    <div class="col-md-10 col-md-offset-1">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="type" id="tyre" value="" checked="checked">
                                    TYRE
                                </label>
                                <label>
                                    <input type="radio" name="type" id="stepney" value="">
                                    STEPNEY
                                </label>
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
<!--end of assign to vehicle-->





