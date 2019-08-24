<form id="maintainance_form" action="javascript:void(0);">
<?php if($action == 'edit' && $mnt_recycle == FALSE){?>
    <input type="hidden" name="mnt_id" class="form-control" value="<?php echo $mnt_record['mnt_id']; ?>">
<?php }?>
<?php  if($mnt_recycle){?>
 
 <input type="hidden" name="mnt_type_renewed_id" class="form-control" value="<?php echo $mnt_record['mnt_id']; ?>">
 
<?php } ?>

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Maintanance 
        <?php 
            if($action == 'edit'){
                echo "Edit";
            }elseif($action == 'view'){
                echo 'View';
            }else{
                echo 'New Entry';
            }

            echo ($mnt_recycle) ? ' Recycling' : '' ;
        ?>
        
        </h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <input type="hidden" name="vehicle_id" id="vehicle_id" class="form-control" value="<?php echo $vehicle_id;?>">
                    <label for="">vehicle number</label>
                    <input type="text" id="vehicle_number" class="form-control" value="<?php echo $vehicle_number;?>" required="required"
                        disabled="disabled">
                </div>
            </div>

            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Type</label>
                    <select class="form-control" name="mnt_type" id="mnt_type" <?php if($action == "view" || $mnt_recycle == TRUE)echo "disabled"; ?>>
                    <?php for($i = 0; $i < count($mnt_types);$i++){?>
                        <option value="<?php echo $mnt_types[$i]['mnt_type_id'];?>" <?php if(isset($mnt_record) && ($mnt_record['mnt_type'] == $mnt_types[$i]['mnt_type_id']))echo "selected"; ?> ><?php echo $mnt_types[$i]['mnt_type_name']?></option>
                    <?php } ?>                      
                    </select>
                    <?php if ($mnt_recycle) {?>
                     <input type="hidden" name="mnt_type" class="form-control" value="<?php echo $mnt_record['mnt_type'];?>">
                    <?php }?>
                    
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" name="mnt_date" class="form-control" required="required" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_date'].'"'; if($action == "view")echo "disabled";?>>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Brand Name</label>
                    <input type="text" id="mnt_name" name="mnt_name" class="form-control" required="required" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_name'].'"'; if($action == "view")echo "disabled";?>>
                </div>
            </div>

            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Bill No.</label>
                    <input type="text" name="mnt_bill_no" class="form-control" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_bill_no'].'"'; if($action == "view")echo "disabled";?> required="required">
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Shop Name</label>
                    <input type="text" name="mnt_shop_name" class="form-control" required="required" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_shop_name'].'"'; if($action == "view")echo "disabled";?>>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Amount</label>
                    <input type="text" name="mnt_amount" class="form-control" required="required" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_amount'].'"'; if($action == "view")echo "disabled";?>>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Searial No.</label>
                    <input type="text" name="mnt_serial_no" class="form-control" required="required" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_serial_no'].'"'; if($action == "view")echo "disabled";?>>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Warranty (in Months)</label>
                    <input type="text" name="mnt_warranty" class="form-control" required="required" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_warranty'].'"'; if($action == "view")echo "disabled";?>>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Total Run</label>
                    <input type="text" name="mnt_total_ran" class="form-control" required="required" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_total_ran'].'"'; if($action == "view")echo "disabled"; ?>>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Expected Run</label>
                    <input type="text"  name="mnt_expected_run" class="form-control"
                        required="required" <?php if(isset($mnt_record))echo 'value="'.$mnt_record['mnt_expected_run'].'"'; if($action == "view")echo "disabled"; ?>>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="form-group">
                    <label for="">Note</label>
                    <textarea id="vm_note" name="mnt_note" class="form-control" <?php if($action == "view")echo "disabled"; ?>><?php if(isset($mnt_record))echo $mnt_record['mnt_note']; ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary" <?php if($action == "view")echo "disabled"; ?>>
        <?php
            if($action == "new"){
                echo "save Changes";
            }elseif($action == "edit" || $action == "view"){
                echo "update data";
            }
        ?>
        </button>
    </div>
</form>