<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="javascript:void();" method="post" id="update_trip_form" accept-charset="utf-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center">Add Trip</h3>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-2">
                        <input type="hidden" name="trip_id" class="form-control" value="<?php echo $trip_id; ?>">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="select driver">Select Consignor<span
                                            class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select name="consignor_id" id="select_consignor" class="form-control"
                                        required="required">
                                        <?php foreach($consignors as $con){ ?>
                                        <option value="<?php echo $con['consignor_id'];?>"
                                            <?php if($con['consignor_id'] == $trip_details->consignor_id){echo "selected";} ?>>
                                            <?php echo $con['consignor_name'];?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Select consignee</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select name="consignee_id" id="select_consignee" class="form-control"
                                        required="required">
                                        <option value="">select consignee</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="select Allowance"><span class="text-danger">*</span>Allowance
                                        Issued</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" name="allowance" class="form-control"
                                        placeholder="allowance" autofocus="autofocus"
                                        value="<?php echo $trip_details->allowance; ?>">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Select Vehicle</label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select name="vehicle_id" class="form-control"
                                        required="required">
                                        <option value="<?php echo $trip_details->vehicle_id;?>"><?php echo $vehicle_name;?></option>
                                        <?php 
                                            foreach($vehicles as $v){?>
                                                <option value="<?php echo $v['vehicle_id'];?>"><?php echo $v['vehicle_number'];?></option>
                                           <?php }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <input type="hidden" name="old_vehicle_id" id="inputold_vehicle" class="form-control" value="<?php echo $trip_details->vehicle_id;?>">
                            

                        </div>



                        <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">close</button>
                        <button type="submit" class="btn btn-success pull-right btn-md">Update</button>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>
</div>