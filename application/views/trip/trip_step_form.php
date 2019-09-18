<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="javascript:void();" method="post" id="add_trip_step" accept-charset="utf-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center">Add Trip Step</h3>
                </div>
                <div class="panel-body">

                    <input type="hidden" name="trip_id" class="form-control" value="<?php echo $trip_id; ?>">
                    <input type="hidden" name="old_driver_id" class="form-control"
                        value="<?php echo $last_driver_id; ?>">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="select origin">Route<span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="route_id" id="route_id" class="form-control" required="required">
                                   <?php foreach ($routes as $val) { ?>
                                   <?php  echo '<option value="' . $val['route_id'] . '">' . $val['route_origin'] . ' To ' .
                                        $val['route_destination'] . '</option>';
                                    } 
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for=""><span class="text-danger">*</span>
                                    select Load
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="load_id" id="trip_type" class="form-control" required="required">

                                <option value="0">Empty Trip</option>
                                <?php foreach ($loads as $v) {
                                echo '<option value="' . $v['load_id'] . '">' . $v['load_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="select truck">Trip start Date</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" name="step_start_date" id="inputTrip_date" class="form-control"
                                    value="" required="required" title="">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-success pull-right btn-md">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>