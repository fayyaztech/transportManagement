        <form id="add_consignor_form">
            <h3 class="text-primary text-center">Add Consignor</h3><br>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="consignie">
                            <span class="text-danger">*</span>Name</label>
                    </div>
                </div>
                <?php 
                    if($action == 'edit' && isset($info)){
                        ?>
                        
                        <input type="hidden" name="consignor_id" class="form-control" value="<?php echo $info['consignor_id'];?>">
                        

                   <?php }?>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="consignor_name" class="form-control" autofocus="autofocus" <?php if($action == 'edit' && isset($info))echo 'value="'.$info['consignor_name'].'"'; echo (!$view) ? : 'disabled' ; ?>>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="">
                            <span class="text-danger">*</span>
                            Contact No.
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="consignor_contact" class="form-control" autofocus="autofocus" <?php if($action == 'edit' && isset($info))echo 'value="'.$info['consignor_contact'].'"'; echo (!$view) ? : 'disabled' ;?>>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-2">
                    <div class="form-group">
                        <label for=""><span class="text-danger">*</span>
                            Address
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <textarea name="consignor_address" id="textarea" class="form-control" rows="3"
                            required="required" <?php echo (!$view) ? : 'disabled' ;?>> <?php if($action == 'edit' && isset($info))echo $info['consignor_address']; ?> </textarea>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for=""><span class="text-danger">*</span>
                            Pincode
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="consignor_pin_code" class="form-control" autofocus="autofocus" <?php if($action == 'edit' && isset($info))echo 'value="'.$info['consignor_pin_code'].'"'; echo (!$view) ? : 'disabled' ;?>>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for=""><span class="text-danger">*</span>
                            city
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="consignor_city" class="form-control" autofocus="autofocus" <?php if($action == 'edit' && isset($info))echo 'value="'.$info['consignor_city'].'"'; echo (!$view) ? : 'disabled' ;?>>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for=""><span class="text-danger">*</span>
                            State
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="consignor_state" class="form-control" autofocus="autofocus" <?php if($action == 'edit' && isset($info))echo 'value="'.$info['consignor_state'].'"'; echo (!$view) ? : 'disabled' ;?>>
                    </div>
                </div>
                <div class="col-md-6">
                    <button class="pull-right btn btn-danger" data-dismiss="modal">close</button>
                    <button type="submit" class="pull-right btn btn-primary" <?php echo (!$view) ? : 'disabled' ;?>>
                        <span class="fa fa-plus text-white"></span>
                        <?php echo ($action == 'edit' && isset($info))? 'update' : 'save'; ?>
                    </button>
                </div>
            </div>


        </form>