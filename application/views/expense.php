<body>
    <div id="wrapper">
        <!-- Navigation -->
        <?php $this->load->view('templates/navbar');?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Expense Management</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
                <button type="button" data-toggle="modal" href='#modal-id' class="btn btn-warning pull-right" id="add_expense">Add Expense</button>
                
            </div><br>
            <div class="modal fade" id="modal-id">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="add_route_info">
                        <div class="modal-body" >
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary">
                            <tr>
                                <th>Expense Type</th>
                                <th>Particulars</th>
                                <th>Amount</th>
                                <th>Billing Date</th>
                                <th>Vendor Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        
                        <tbody id="expense_data">
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <input type="hidden" name="url" id="url" class="form-control" value="<?php echo base_url(); ?>">
        </div>
    </div>
</body>