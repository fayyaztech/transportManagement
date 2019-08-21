<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/loading');
        $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<div class="row">
    <hr>
    <div class="form-horizontal">
       <div class="form-group">
        <label for="exampleInputName2" class="col-sm-2 control-label">Vehicle</label>
        <div class="col-sm-6">
            <select name="vehicle_id" id="vehicle_id" class="form-control" required="required">
                
                option
                <?php 
                foreach ($data as $value) 
                {    
                    echo '<option value="'.$value->vehicle_id.'">'.$value->vehicle_number.'</option>';
                }
                ?>
            </select>
           <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
        </div>
    </div>
    <div>
    <hr>
</div>
</body>
