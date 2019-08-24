<form id="mnt_forward_submit" action="javascript:void(0);">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Maintanance vehicle Change</h4>
    </div>
    <div class="modal-body">
        
        <input type="hidden" name="mnt_id" class="form-control" value="<?php echo $mnt_id; ?>">
        
        <select name="vehicle_id" class="form-control" required="required">
        <option value="">-- select vehicle -- </option>
        <?php for($i = 0;$i < count($vehicle_list);$i++){?>
            <option value="<?php echo $vehicle_list[$i]['vehicle_id']?>"><?php echo $vehicle_list[$i]['vehicle_number'];?></option>
        <?php } ?>
        </select>
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="submit" class="btn btn-primary">
            save Changes
        </button>
    </div>
</form>