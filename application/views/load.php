<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Load Master</h1>

                    <button type="button" class="btn btn-primary pull-right" id="add_load">
                        <i class="fa fa-plus-circle"></i>
                        Add Load</button>
                        <br/>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="load_list">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="dataTable">
                                <thead class="bg-primary">
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Load Name</th>
                                        <th>Consignor Name</th>
                                        <th>action</th>
                                    </tr>
                                </thead>

                                <tbody id="load_info">
                                    <?php 
                                    $count = 1;
                                    foreach ($load_info as $value) {
                                        echo '
                                            <tr>
                                                <td>' . $count++ . '</td>
                                                <td>' . $value->load_name . '</td>
                                                <td>' . $value->consignor_name . '</td>
                                                <td load_id="'.$value->load_id.'">
                                                <span class="btn btn-info fa fa-edit edit-load"></span>
                                                    <span class="btn btn-danger fa fa-trash delete-load"></span>
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
            
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog">
                    <div class="modal-content">
                    </div>
                </div>
            </div>
            
        <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
    </div>
    </div>
</body>