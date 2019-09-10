<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php //$this->load->view('templates/loading');
        $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Client Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body" >
                            
                        </div>
                    </div>
                </div>
            </div>
                
                <!-- Tab panes -->
                
                <div class="row pull-right">
                <button type="button" class="btn btn-primary" id="add_consignor_btn"><i class="fa fa-plus-circle"></i> Add Consignor</button>
                <button type="button" class="btn btn-primary" id="add_consignee_btn"><i class="fa fa-plus-circle"></i> Add Consignee</button>
                    
                </div>
                <br/>
                <br/>
                
                
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="client">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>sr. no</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>City</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php
                                            $count = 1;
                                            foreach ($consinee_list as $value) {
                                                echo '
                                                    <tr>
                                                        <td>'.$count++.'</td>
                                                        <td>'.$value['consignor_name'].'</td>
                                                        <td>'.$value['consignor_address'].'</td>
                                                        <td>'.$value['consignor_contact'].'</td>
                                                        <td>'.$value['consignor_city'].'</td>
                                                        <td value='.$value['consignor_id'].'>
                                                        <button class="btn btn-primary fa fa-eye view_consignor" ></button>
                                                          <button class="btn btn-info fa fa-edit update_consignor" ></button>
                                                          <button class="btn btn-danger fa fa-trash delete_consignor"></button>
                                                          <button class="btn btn-success fa fa-users view_consignee"></button>
                                                          <button class="btn btn-warning fa fa-road assign_route"></button>
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
    </div>
</body>
