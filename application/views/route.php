<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Route management</h1>
                </div>
                
                <button type="button" class="btn btn-info pull-right" id="add_new_route">
                <i class="fa fa-plus-circle"></i>
                 add New Route</button>
                
                <!-- /.col-lg-12 -->
            </div>
            <br/>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable">
                        <thead class="bg-primary">
                            <tr>
                                <th>Sr.</th>
                                <th>Origin</th>
                                <th>Destination</th>
                                <!-- <th>State</th> -->
                                <th>Distance</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="route_info">
                            <?php for ($i = 0; $i < count($route_info); $i++) {?>
                            <tr>
                                <td><?php echo ($i+1); ?></td>
                                <td><?php echo $route_info[$i]['route_origin']; ?></td>
                                <td><?php echo $route_info[$i]['route_destination']; ?></td>
                                <td><?php echo $route_info[$i]['route_distance']; ?> Km</td>
                                <td>
                                    <a class="btn btn-danger fa fa-trash" id="delete_route_btn"
                                        value="'.$value->route_id.'"></a>
                                </td>
                            </tr>
                            <?php
}
?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal-id">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" id="route">
                    <div class="modal-body">

                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
    </div>
    </div>
</body>