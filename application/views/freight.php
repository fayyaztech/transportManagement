<?php
// get all consigner data at once
$consignor = fetch_consignor($this);
?>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Freight Master</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#freight_list" aria-controls="home" role="tab" data-toggle="tab">Freights</a>
                    </li>
                    <li role="presentation">
                        <a href="#add_freight" aria-controls="tab" role="tab" data-toggle="tab">Add Freight
                            Add/upfreight</a>
                    </li>
                </ul>
                <br/>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="freight_list">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Sr.</th>
                                            <th>affected date</th>
                                            <th>expected freight</th>
                                            <th>Consignor Name</th>
                                            <th>Load</th>
                                            <th>route</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="freight_info">
                                        <?php
                                            for($i=0;$i<count($freights);$i++){ ?>
                                                <tr>
                                                    <td><?php echo $freights[$i]['load_routes_id'] ?></td>
                                                    <td><?php echo format_date($freights[$i]['freight_effected_date']); ?></td>
                                                    <td><?php echo $freights[$i]['freight'] ?></td>
                                                    <td><?php echo $freights[$i]['consignor_name'] ?></td>
                                                    <td><?php echo $freights[$i]['load_name'] ?></td>
                                                    <td><?php echo $freights[$i]['route_origin'] ?>-<?php echo $freights[$i]['route_destination'] ?></td>
                                                    <td>action</td>
                                                </tr>
                                            <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="add_freight">
                        <div class="panel">
                            <div class="panel-heading bg-primary">
                                <h3 class="text-center">Add freight</h3>
                            </div>


                            <!-- upload file form ----------------------------------------------------------------------- -->
                            <div class="panel-body">
                                <h3>upload data file</h3>
                                <form action="<?php echo base_url(); ?>freight/upload_excel" method="Post"
                                    accept-charset="utf-8" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="consignor">consignor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="c-select form-control" name="consignor_id" required="">
                                                    <option value="">select Consignor</option>
                                                    <?php
foreach ($consignor as $value) {
    echo '
                                                                <option value="' . $value->consignor_id . '">' . $value->consignor_name . '</option>
                                                            ';
}
?>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="file" name="excel" id="excel" required="required">
                                            </div>
                                        </div>
                                        <button type="submit" class="pull-right btn btn-success" id="submit_btn">Upload
                                            File</button>
                                    </div>
                                </form>
                            </div>

                            <!-- download file form ------------------------------------------------ -->
                            <div class="panel-body">
                                <form action="<?php echo base_url()?>freight/download_excel_sample" method="get" id="add_freight_submit"
                                    accept-charset="utf-8">
                                    <h3>Download data file</h3>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="consignor">consignor</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="c-select form-control" name="consignor_id" required=""
                                                    id="consignor_id">
                                                    <option value="">select Consignor</option>
                                                    <?php
foreach ($consignor as $value) {
    echo '
                                                                <option value="' . $value->consignor_id . '">' . $value->consignor_name . '</option>
                                                            ';
}
?>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="pull-right btn btn-success"
                                            id="submit_btn">Download File</button>
                                    </div>
                                </form>
                            </div>



                        </div>
                    </div>

                </div>
                </form>

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