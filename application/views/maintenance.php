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

<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
       <!--  <li role="presentation" class="active" >
            <a href="#all" aria-controls="tab" role="tab" data-toggle="tab">
                <img src="<?php echo base_url();?>assets/img/checklist.png" alt="">
                <h4 class="text-center">All</h4>
            </a>
        </li> -->
        <li role="presentation"class="active">
            <a href="#tyre" aria-controls="home" role="tab" data-toggle="tab">
                <img src="<?php echo base_url();?>assets/img/tyre.png" alt="">
                <h4 class="text-center">Tyre</h4>
            </a>
        </li>
        <li role="presentation">
            <a href="#oil" aria-controls="tab" role="tab" data-toggle="tab">
                <img src="<?php echo base_url();?>assets/img/images.jpg" alt="">
                <h4 class="text-center">Engine oil</h4>
            </a>
        </li>
        <li role="presentation">
            <a href="#battery" aria-controls="tab" role="tab" data-toggle="tab">
                <img src="<?php echo base_url();?>assets/img/battery1.png" alt="">
                <h4 class="text-center">Battery</h4>
            </a>
        </li>
        
        <li role="presentation">
            <a href="#repairs" aria-controls="tab" role="tab" data-toggle="tab">
                <img src="<?php echo base_url();?>assets/img/repair.png" alt="">
                <h4 class="text-center">Misc repairs</h4>
            </a>
        </li>
       <li role="presentation">
                                <a href="#recurring" aria-controls="tab" role="tab" data-toggle="tab">
                                    <img src="<?php echo base_url();?>assets/img/checklist.png" alt="">
                                    <h4 class="text-center">Permits And Clearances</h4>
                                </a>
                            </li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        <!--all maintainance -->
        <div role="tabpanel" class="tab-pane active" id="all">
            <?php $this->load->view('maintainance/all');?>
        </div>
        <!--all maintainance complete-->
        <!--tyre section starts-->
        <div role="tabpanel" class="tab-pane fade " id="tyre">
            <?php $this->load->view('maintainance/tyre');?>
        </div>
        <!--tyre section end-->
        <!--engine oil section starts-->
        <div role="tabpanel" class="tab-pane" id="oil">
            <?php $this->load->view('maintainance/oil');?>
        </div>
        <!--engine oil section end-->
        <!--battery section starts-->
        <div role="tabpanel" area-control="tab" class="tab-pane" id="battery">
            <?php $this->load->view('maintainance/battery');?>
        </div>
        <!--battery section end-->
        <!--tyre section starts-->
        <div role="tabpanel" class="tab-pane" id="repairs">
            <?php $this->load->view('maintainance/misc');?>
        </div>
        <!--tyre section end-->
        <!--recurring expense section starts-->
                            <div role="tabpanel" class="tab-pane" id="recurring">
                                <?php $this->load->view('maintainance/recurring');?>
                            </div>
                            <!-- recurring end-->
    </div>
</div>
</div>
</div>
</div>
</div>

</body>
