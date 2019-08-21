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

                <form action="" method="get" class="form-inline" role="form">

                    <div class="form-group">
                        <select class="form-control" name="filter" id="filter">
                            <option value="4" <?php if (NULL !== $this->input->get('filter') && $this->input->get('filter') == 4) {
                                echo 'selected';
                            } ?>> All</option>
                            <option value="0" <?php if (NULL !== $this->input->get('filter') && $this->input->get('filter') == 0) {
                                echo 'selected';
                            } ?>> Deactivated</option>
                            <option value="1" <?php if (NULL !== $this->input->get('filter') && $this->input->get('filter') == 1) {
                                echo 'selected';
                            } ?>> Active</option>
                            <option value="2" <?php if (NULL !== $this->input->get('filter') && $this->input->get('filter') == 2) {
                                echo 'selected';
                            } ?>> Running</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <select name="vehicle_id" id="vehicle_id" class="form-control  col-md-4">
                            <option value="all" <?php if($this->input->get('vehicle_id') == "all"
                    ) echo "selected"; ?>>ALL</option>

                            <?php 
                            $vahicle_id = NULL;
                            $vahicle_number = "not selected";
                            foreach ($vehicle_list as $v) {?>
                            <option value="<?php echo $v->vehicle_id; ?>" <?php 
                            if($this->input->get('vehicle_id') == $v->vehicle_id)
                            {echo "selected";
                            $vahicle_id = $v->vehicle_id;
                            $vahicle_number = $v->vehicle_number; }?>>
                                <?php echo $v->vehicle_number;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                </form>

            </div>
            <hr />
            <div class="row">
                <h3 id="selected_vehicle" class="pull-left" v_id="<?php echo $vahicle_id; ?>" v_name="<?php echo $vahicle_number;?>">Select Vehicle:
                    <?php echo $vahicle_number;?></h3>
                <?php if($vahicle_id !== NULL){?>
                <button type="button" class="btn btn-primary pull-right" id="add_maintainance">
                    <i class="fa fa-plus-circle"></i> Add New Maintainance
                </button>
                <?php } ?>
            </div>
            
            <div class="row">
                
                <div class="table-responsive">
                    <table class="table table-hover " id="dataTable">
                        <thead>
                            <tr class=" bg-primary">
                                <th>Id</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>vehicle</th>
                                <th>Shop Name</th>
                                <th>Amount</th>
                                <th>Warranty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php for($i = 0; $i < count($maintenance_records); $i++){?>
                            <tr>
                                <td><?php echo $maintenance_records[$i]['mnt_id'] ?></td>
                                <td><?php echo $maintenance_records[$i]['mnt_type_name'] ?> <i class="fa fa-tire"></i></td>
                                <td><?php echo $maintenance_records[$i]['mnt_name'] ?></td>
                                <td><?php echo $maintenance_records[$i]['mnt_date'] ?></td>
                                <td><?php echo $maintenance_records[$i]['vehicle_number'] ?></td>
                                <td><?php echo $maintenance_records[$i]['mnt_shop_name'] ?></td>
                                <td><?php echo $maintenance_records[$i]['mnt_amount'] ?></td>
                                <td><?php echo $maintenance_records[$i]['mnt_warranty'] ?></td>
                                <td mnt_id="<?php echo $maintenance_records[$i]['mnt_id'] ?>">
                                    
                                    <button type="button" class="btn btn-info mnt_info">
                                    <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary mnt_edit">
                                    <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger mnt_delete">
                                    <i class="fa fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-success mnt_recycled">
                                    <i class="fa fa-recycle"></i>
                                    </button>
                                    <button type="button" class="btn btn-info mnt_forward">
                                    <i class="fa fa-arrow-right"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            
        </div>
        <div class="modal fade" id="modal-id">
            <div class="modal-dialog">
                <div class="modal-content modal-lg">
                </div>
            </div>
        </div>
        
        <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url();?>">
        
    </div>
</body>