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
            <!-- /.row -->
            <!--  <div class="row">
                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" href='#modal-id' id="add_client">Add client</button>
            </div><br> -->
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body" >
                            
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#client" aria-controls="home" role="tab" data-toggle="tab">
                            Clients
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#add_consignor" aria-controls="tab" role="tab" data-toggle="tab">
                            Add Consignor
                        </a>
                    </li>
                     <li role="presentation">
                        <a href="#add_consignee" aria-controls="tab" role="tab" data-toggle="tab">
                            Add Consignee
                        </a>
                    </li>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="client">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
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
                                    
                                    <tbody id="client_table">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <?php
                        $this->load->view('client/consignor');
                        $this->load->view('client/consignee');
                    ?>
                </div>
            </div>
        </div>
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
    </div>
</body>
