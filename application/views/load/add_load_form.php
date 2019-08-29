<form action="javascript:void();" method="Post" id="add_load_submit" accept-charset="utf-8" class="padding">
    <div class="panel">
        <div class="panel-heading bg-primary">
            <h3 class="text-center">Add Load</h3>
        </div>
        <div class="panel-body">


            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="consignor">consignor</label>
                    </div>
                </div>  
                <?php
if ($edit) {
    ?>

                <input type="hidden" name="load_id" class="form-control" value="<?php echo $load_data['load_id'] ?>">

                <?php
}
?>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="c-select form-control" name="consignor_id">
                            <option selected>select Consignor</option>
                            <?php
                            $consignor = fetch_consignor($this);
                            foreach ($consignor as $value) {?>
                            <option value="<?php echo $value->consignor_id ?>"
                                <?php if (isset($load_data) && $value->consignor_id == $load_data['consignor_id']) {echo 'selected';}?>>
                                <?php echo $value->consignor_name; ?></option>
                            <?php }
?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="load">Load name</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="load_name" class="form-control" autofocus="autofocus" <?php if($edit){echo 'value="'.$load_data['load_name'].'"';}?>>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="pull-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-success" id="personal_information">Submit</button>
                </div>
            </div>

        </div>

    </div>
</form>