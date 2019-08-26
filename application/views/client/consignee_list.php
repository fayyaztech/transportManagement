<div class="table-responsive">
<h3>Cosignee List </h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Pin Code</th>
                <th>City</th>
                <th>State</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php for ($i=0; $i < count($consignees); $i++) { ?>
            <tr>
                <td><?php echo $consignees[$i]['consignee_name'];?></td>
                <td><?php echo $consignees[$i]['consignee_contact'];?></td>
                <td><?php echo $consignees[$i]['consignee_address'];?></td>
                <td><?php echo $consignees[$i]['consignee_pin_code'];?></td>
                <td><?php echo $consignees[$i]['consignee_city'];?></td>
                <td><?php echo $consignees[$i]['consignee_state'];?></td>
                <td consignee_id="<?php echo $consignees[$i]['consignee_id'];?>">
                <button type="button" class="btn btn-danger delete_consignee">delete</button>
                </td>
            </tr>            
        <?php } ?>
        </tbody>
    </table>
</div>
