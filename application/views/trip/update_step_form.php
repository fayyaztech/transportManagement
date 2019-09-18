<form action="javascript:void();" method="post" id="update_step" accept-charset="utf-8">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="text-center">Update Step</h3>
        </div>
        <div class="panel-body">

            <input type="hidden" name="trip_details_id" value="<?php echo $step_details['trip_details_id'] ?>">

            <div class="form-group">
                <label for="input" class="col-sm-2 control-label">Trip Start date:</label>
                <div class="col-sm-10">
                    <input type="date" name="step_start_date" class="form-control"
                        value="<?php echo $step_details['step_start_date']; ?>" required="required" title="">
                </div>
            </div>

            <div class="form-group">
                <label for="route_id" class="col-sm-2 control-label"> select route:</label>
                <div class="col-sm-10">
                    <select name="route_id" id="route_id" class="form-control">
                        <?php
                    for($i = 0; $i < count($routes);$i++){?>
                        <option value="<?php echo $routes[$i]['route_id'];?>"
                            <?php if($routes[$i]['route_id'] == $step_details['route_id']){ echo "selected";} ?>>
                            <?php echo $routes[$i]['route_origin']."-".$routes[$i]['route_destination']; ?>
                        </option>
                            <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="load_id" class="col-sm-2 control-label"> select load:</label>
                <div class="col-sm-10">
                    <select name="load_id" id="load_id" class="form-control">
                        <?php
                    for($i = 0; $i < count($loads);$i++){?>
                        <option value="<?php echo $loads[$i]['load_id'];?>"
                            <?php if($loads[$i]['load_id'] == $step_details['load_id']){ echo "selected";} ?>>
                            <?php echo $loads[$i]['load_name']; ?>
                        </option>
                            <?php } ?>
                    </select>
                </div>
            </div>            
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            

        </div>
    </div>
</form>