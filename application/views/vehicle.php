<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Vehicle</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <a class="btn btn-warning pull-right add_vehicle" style="margin-right: 40px;" href='#'><i class="fa fa-plus-circle"> </i> Add vehicle</a>
            </div>
            <br>
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
            <div class="row">
                <form action="" method="get" class="form-inline" role="form">
                
                    <div class="form-group">
                        <select class="form-control" name="filter">
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
                    <button type="submit" class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                </form>
                </br>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-center" id="dataTable">
                                        <thead class="bg-primary text-center">
                                            <tr>
                                                <th class="text-center">Vehicle ID</th>
                                                <th class="text-center">Vehicle</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">purchase Date</th>
                                                <th class="text-center">body type</th>
                                                <th class="text-center">registration_date</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php

                                            // all vehicles data array 
                                            $data = [];

                                            // vehicle filter 
                                            $filter = 1;

                                            //if receive filter prams 
                                            if ($this->input->get('filter') != NULL) {
                                                $filter = $this->input->get('filter');
                                            }

                                            $data = $this->vehicle_model->get_vehicle_details($filter);
                                            foreach ($data as $value) {

                                                if ($value->vehicle_status == 1) {
                                                    // 1 vehicle available
                                                    $status = '<span class="label label-success">Available</span>';
                                                    $delete_btn = '<button data-toggle="tooltip" data-placement="top" title="Delete" id="delete" class="btn btn-danger fa fa-trash"></button>';
                                                }elseif ($value->vehicle_status == 2) {
                                                    // 2 vehicle running 
                                                    $status = '<span class="label label-warning">Running</span>';
                                                    $delete_btn = '<button class="btn btn-danger fa fa-trash" disabled=""></button>';
                                                }elseif ($value->vehicle_status == 0) {
                                                    // vehicle deactivated
                                                    $status = '<span class="label label-danger">Deactivated</span>';
                                                    $delete_btn = '<button class="btn btn-success fa fa-recycle" id="reactive"></button>';
                                                }

                                            echo '<tr>
                                                <td>'.$value->vehicle_id.'</td>
                                                <td>'.$value->vehicle_number.'</td>
                                                <td>'.$status.'</td>
                                                <td>'.$value->vehicle_purchase_date.'</td>
                                                <td>'.$value->vehicle_body_type.'</td>
                                                
                                                <td>'.$value->vehicle_registration_date.'</td>
                                                <td value="'.$value->vehicle_id.'">
                                                    <a  class="btn btn-primary fa fa-eye"  data-toggle="modal" id="vehicle_info" data-toggle="tooltip" data-placement="down" title="Update"></a>
                                                    <a  class="btn btn-info fa fa-edit"  data-toggle="modal" id="show_update_vform" data-toggle="tooltip" data-placement="down" title="Update"></a>
                                                    '.$delete_btn.'
                                                </td>
                                            </tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal">
                    <div class="modal-dialog modal_containt">
                        
                    </div>
                </div>
            </body>
            
            
            <!-- /.row -->