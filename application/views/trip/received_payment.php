<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $request_type; ?></h3>
    </div>
    <div class="panel-body">
        <form action="#" id="received_payment_form" method="POST" class="form-horizontal" role="form">

            <input type="hidden" name="trip_id" class="form-control" value="<?php echo $trip_id; ?>">
            <input type="hidden" name="payment_received_type" value="<?php echo ($request_type == "Received Payment") ? 0 : 1 ; ?>">
            <div class="form-group">
                <label for="inputDate" class="col-sm-2 control-label">Date:</label>
                <div class="col-sm-10">
                    <input type="date" name="payment_received_date" id="inputDate" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label for="inputAmount" class="col-sm-2 control-label">Amount:</label>
                <div class="col-sm-10">
                    <input type="number" name="payment_received_amount" id="inputAmount" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

    </div>
</div>