
                   <div role="tabpanel" class="tab-pane" id="add_consignee">
                        
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <form id="add_consignee_form">
                                    
                                    <h3 class="text-primary text-center">Add Consignee</h3><br>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">
                                                    <span class="text-danger">*</span>
                                                    Select Consigner
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="consignor_id">
                                                    <option>select Consignor</option>
                                                    <?php 
                                                        $consignor_list = fetch_consignor($this);
                                                        foreach ($consignor_list as $value) {
                                                            echo "<option value='".$value->consignor_id."'>".$value->consignor_name."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="consignie">
                                                    <span class="text-danger">*</span>Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="consignee_name" class="form-control" autofocus="autofocus">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="">
                                                    <span class="text-danger">*</span>
                                                    Contact No.
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="consignee_contact" class="form-control"  autofocus="autofocus">
                                            </div>
                                        </div>
                                                                          
                                    
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for=""><span class="text-danger">*</span>
                                                Address
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <textarea name="consignee_address" id="textarea" class="form-control" rows="3" required="required"></textarea>
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for=""><span class="text-danger">*</span>
                                                    Pincode
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="consignee_pin_code" class="form-control" autofocus="autofocus">
                                            </div>
                                        </div>
                                   
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for=""><span class="text-danger">*</span>
                                                 city
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="consignee_city" class="form-control" autofocus="autofocus">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for=""><span class="text-danger">*</span>
                                                State
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                 <input type="text" name="consignee_state" class="form-control" autofocus="autofocus">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="pull-right btn btn-danger" data-dismiss="modal">close</button>
                                            <button type="submit" class="pull-right btn btn-primary">
                                            <span class="fa fa-plus text-white"></span> Add Client
                                            </button>
                                        </div>
                                    </div>
                    
                                    
                                </form>
                            </div>
                        </div>
                   </div>