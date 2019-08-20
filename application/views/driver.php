<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php
        $this->load->view('templates/loading');
        $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Driver Management</h1>
                </div>
                
            </div>
            <!-- /.row -->
            <div class="row">
                <button type="button" class="btn btn-primary pull-right" id="add_driver">Add Driver</button>
                <form action="" method="get" class="form-inline" role="form">
                
                    <div class="form-group">
                        <select class="form-control" name="filter">
                            <option value="4" <?php if (NULL !== $this->input->get('filter') && $this->input->get('filter') == 4) {
                                echo 'selected=""';
                            } ?>> All</option>
                            <option value="0" <?php if (NULL !== $this->input->get('filter') && $this->input->get('filter') == 0) {
                                echo 'selected=""';
                            } ?>> Deactivated</option>
                            <option value="1" <?php if (NULL !== $this->input->get('filter') && $this->input->get('filter') == 1) {
                                echo 'selected=""';
                            } ?>> Active</option>
                            <option value="2" <?php if (NULL !== $this->input->get('filter') && $this->input->get('filter') == 2) {
                                echo 'selected=""';
                            } ?>> Running</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                </form>
            </div><br>
            <div class="modal fade" id="drive_form_modal">
                <div class="modal-dialog modal-lg">
                    <div class="modal-body" id="add_driver_info">
                        
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modal1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Update Driver</h4>
                        </div>
                        <div class="modal-body" id="modal-body">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary">
                            <tr>
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody id="driver_management_table">
                            <?php
                            foreach ($driver_data as $value) {                            
                            if ($value->driver_status == 1) {
                                $status = '<span class="label label-success">Available</span>';
                                $delete_btn = '<button data-toggle="tooltip" data-placement="top" title="Delete" id="delete" class="btn btn-danger fa fa-trash"></button>';
                            }elseif($value->driver_status == 2) {
                                $status = '<span class="label label-warning">On Trip</span>';
                                $delete_btn = '<button data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger fa fa-trash" disabled></button>';
                            }elseif($value->driver_status == 0){
                                $status = '<span class="label label-danger">deactive</span>';
                                $delete_btn = '<button data-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-danger fa fa-trash" disabled></button>';
                            }

                            echo '<tr>
                                <td>' . $value->driver_id . '</td>
                                <td>' . $value->driver_name . '</td>
                                <td>' . $status . '</td>
                                <td>' . $value->driver_number . '</td>
                                <td>' . $value->driver_permanent_address . '</td>
                                <td value="' . $value->driver_id . '">
                                    <button id="driver_profile" class="btn btn-primary fa fa-eye" ></button>
                                    <button id="driver_update" class="btn btn-info fa fa-edit" ></button>
                                    '.$delete_btn.'
                                </td>
                            </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
        </div>
    </div>
    <div class="modal fade" id="del_user">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Delete Drive</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="input" class="col-sm-2 control-label">Reason :</label>
                            <div class="col-sm-12">
                                <select name="" id="input" class="form-control" required="required">
                                    <option value="resign">Resign</option>
                                    <option value="abscond">Abscond</option>
                                    <option value="leave">Leave</option>
                                    <option value="terminated">Terminated</option>
                                </select>
                            </div>
                        </div>
                        </br>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <input type="text" name="comment" id="inputComment" class="form-control" value="" required="required" pattern="" title="">
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>