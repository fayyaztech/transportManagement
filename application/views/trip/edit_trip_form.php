<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="javascript:void();" method="post" id="update_trip_form" accept-charset="utf-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center">Add Trip</h3>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-2">
                        <input type="hidden" name="trip_id" class="form-control" value="' . $trip_id . '">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="select driver">Select Driver<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select name="driver_id" id="driver_id" class="form-control" required="required">
                                        ';
                                        foreach (fetch_driver($this) as $val) {
                                        echo '<option value="' . $val->driver_id . '">' . $val->driver_name . '</option>
                                        ';
                                        }
                                        echo '</select>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="select Route">Route<span class="text-danger">*</span></label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <select name="route_id" id="route_id" class="form-control" required="required">
                                        ';
                                        foreach (fetch_route($this) as $val) {
                                        echo '<option value="' . $val->route_id . '">' . $val->route_origin . ' To ' .
                                            $val->route_destination . '</option>';
                                        }
                                        echo '
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
                                    <input type="text" value="" name="allowance" class="form-control"
                                        placeholder="allowance" autofocus="autofocus">
                                </div>
                            </div>

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
