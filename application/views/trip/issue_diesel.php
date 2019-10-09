
<div class="panel panel-primary">
      <div class="panel-heading">
            <h3 class="panel-title">Issue Diesel</h3>
      </div>
      <div class="panel-body">
            
            <form id="issue_diesel">
            
            <input type="hidden" name="trip_id" class="form-control" value="<?php echo $trip_id ?>">
            <input type="hidden" name="driver_id" class="form-control" value="<?php echo $driver_id ?>">
            <input type="hidden" name="vehicle_id" class="form-control" value="<?php echo $vehicle_id ?>">
            
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="diesel_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Diesel Issued (Liters)</label>
                    <input type="text" name="diesel_quantity" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Diesel Price</label>
                    <input type="text" name="diesel_price" class="form-control">
                </div>
      
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            
      </div>
</div>
