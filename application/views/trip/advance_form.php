<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <form action="javascript:void();" method="post" id="add_advance" accept-charset="utf-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="text-center">Pay Advance</h3>
                </div>
                <div class="panel-body">

                    <input type="hidden" name="trip_id" class="form-control" value="<?php echo $trip_id; ?>">
                    <input type="hidden" name="driver_id" class="form-control" value="<?php echo $driver_id; ?>">
                    <div class="row">

                        <div class="col-md-2 col-md-offset-3">
                            <div class="form-group">
                                <label for="select origin">Advance
                                    <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="advance_amount" class="form-control" value=""
                                    required="required">
                            </div>
                        </div>
                        

                    </div>
                    <div class="row">

                        <div class="col-md-2 col-md-offset-3">
                            <div class="form-group">
                                <label for="select origin">Date
                                    <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="date" name="advance_date" class="form-control" value=""
                                    required="required">
                            </div>
                        </div>
                       

                    </div>
                    
                    <div class="row">

                        <div class="col-md-2 col-md-offset-3">
                            <div class="form-group">
                                <label for="select origin">Place
                                    <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" name="advance_place" class="form-control" value=""
                                    required="required">
                            </div>
                        </div>
                       

                    </div>
                    
                    
                    <div class="row">
                        <div class="col-md-offset-5 col-md-4">
                            <input type="submit" class="btn btn-primary pull-right" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>