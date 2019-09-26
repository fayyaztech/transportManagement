<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Trip Expenses Form</h3>
    </div>
    <div class="panel-body">

        <form action="javaScript(void(0))" method="POST" role="form" id="trip_expense_form">

            <input type="hidden" name="trip_id" value="<?php echo $trip_id;?>">

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="select origin">Date<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <input type="date" name="trip_expense_date" class="form-control" required="required">
                        
                    </div>
                </div>

                <!-- second row -->

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="select origin">Title<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <input type="text" name="trip_expense_name" class="form-control" required="required">
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="select origin">Amount<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <input type="number" name="trip_expense_amount" class="form-control" required="required">
                        
                    </div>
                </div>

                <!-- second row -->

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="select origin">description<span class="text-danger">*</span></label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        
                        <textarea type="text" name="trip_expense_note" class="form-control"></textarea>
                        
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</div>