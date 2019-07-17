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
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <button type="button" class="btn btn-primary pull-right" id="add_driver">Add Driver</button>
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
<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a>
</body>