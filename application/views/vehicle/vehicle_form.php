<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header bg-info">
            <div class="modal-title">Vehicle</div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
            </button>
        </div>
        <form id="submit" method="post" action="javascript:void(0);">
            <div class="modal-body">
                <div class="card mx-auto">
                    <div class="card-body">
                        <div class="row">
                            <?php
                            // print_r($vehicle_data);
                            if(isset($vehicle_data[0])) {
                            ?>
                            <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_data[0]['vehicle_id']?>">
                            <?php
                            }
                            ?>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Owner Name</label>
                                    <input type="text" id="owner_name" name="vehicle_owner_name" class="form-control" placeholder="Owner Name" required="required" autofocus="autofocus" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_owner_name'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passing no">Engine Number</label>
                                    <input type="text" id="vehicle_engine_no" name="vehicle_engine_no" class="form-control" placeholder="Engine Number" required="required" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_engine_no'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Purchase/Delivery date</label>
                                    <input type="date" id="purchase_date" name="vehicle_purchase_date" class="form-control" placeholder="Delivery date" required="required" autofocus="autofocus"<?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_purchase_date'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Vehicle class</label>
                                    <input type="text" id="vehicle_class" name="vehicle_class" class="form-control" placeholder="Vehicle Class" required="required" autofocus="autofocus"<?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_class'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Body Type</label>
                                    <input type="text" id="body_type" name="vehicle_body_type" class="form-control" placeholder="Body Type" required="required" autofocus="autofocus"<?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_body_type'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Maker</label>
                                    <input type="text" id="maker" name="vehicle_maker" class="form-control" placeholder="Maker" required="required" autofocus="autofocus"<?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_maker'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Maker Model</label>
                                    <input type="text" id="maker_model" name="vehicle_maker_model" class="form-control" placeholder="Maker Model" required="required" autofocus="autofocus" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_maker_model'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Unladen Weight(kg.)</label>
                                    <input type="number" id="unladen_wt" name="vehicle_unladen_wt" class="form-control" placeholder="Unladen Weight" required="required" autofocus="autofocus" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_unladen_wt'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Laden Weight(kg.)</label>
                                    <input type="number" id="laden_wt" name="vehicle_laden_wt" class="form-control" placeholder="Laden Weight" required="required" autofocus="autofocus" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_laden_wt'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Seating Capacity</label>
                                    <input type="number" id="seating_cap" name="vehicle_seating_capacity" class="form-control" placeholder="Seating Capacity" autofocus="autofocus" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_seating_capacity'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Manufacture Year</label>
                                    <input type="date" id="manufacture" name="vehicle_manufacture_year" class="form-control" placeholder="Manufacture year" required="required" autofocus="autofocus" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_manufacture_year'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passing no">Chassis Number</label>
                                    <input type="text" id="vehicle_chassis_no" name="vehicle_chassis_no" class="form-control" placeholder="Chassis Number" required="required" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_chassis_no'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passing no">Registration Date</label>
                                    <input type="date" id="reg_date" name="vehicle_registration_date" class="form-control" placeholder="Registration date" required="required" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_registration_date'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstName">Vehicle Number</label>
                                    <input type="text" id="vehicle_number" name="vehicle_number" class="form-control" placeholder="Vehicle Name" required="required" autofocus="autofocus" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_number'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                    
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purchase year">Start Km</label>
                                    <input type="number" name="vehicle_current_reading" class="form-control" placeholder="Start Km" required="required" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_current_reading'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passing no">Vehicle type</label>
                                    <input type="text" id="vehicle_type" name="vehicle_type" class="form-control" placeholder="Vehicle type" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_type'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passing no">Vehicle Category</label>
                                    <input type="text" id="vehicle_category" name="vehicle_category" class="form-control" placeholder="Vehicle Category" required="required" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_category'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="passing no">Expected Average</label>
                                    <input type="text" id="vehicle_expected_average" name="vehicle_expected_mileage" class="form-control" placeholder="Expected Average" required="required" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_expected_mileage'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="purchase year">Number Of Tyres</label>
                                    <input type="number" id="vehicle_tyres" name="vehicle_tyres" class="form-control" placeholder="Number of Tyres" required="required" <?php if(isset($vehicle_data[0])) {echo 'value="'.$vehicle_data[0]['vehicle_tyres'].'"';} if ($show_info){ echo 'disabled=""';}?>>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info" id="submit" <?php if ($show_info){echo 'disabled=""';}?>>
                    <?php 

                    if(isset($vehicle_data[0])) 
                        {
                            echo 'Update';
                        }else{
                            echo "Add";
                        }
                    ?>

                </button>
                <input type="reset" class="btn btn-info" placeholder="Number of Tyres" required="required">
                
            </div>
        </form>
        </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->