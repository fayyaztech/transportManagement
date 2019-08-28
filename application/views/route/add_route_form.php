<form action="javascript:void();" method="Post" id="add_route_submit"accept-charset="utf-8">
                            <div class="panel">
                                <div class="panel-heading bg-primary">
                                    <h3 class="text-center">Add Route</h3>
                                </div>
                                <div class="panel-body">
                                     <?php 
                                        if($action == 'edit' && isset($info)){
                                            ?>
                                            
                                            <input type="hidden" name="route_id" class="form-control" value="<?php echo $info['route_id'];?>">
                                            

                                       <?php }?>
                                   
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="origin">Origin</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="route_origin" class="form-control" autofocus="autofocus" <?php if($action == 'edit' && isset($info))echo 'value="'.$info['route_origin'].'"'; echo (!$view) ? : 'disabled' ; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="destination">Destination</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="route_destination" class="form-control"   autofocus="autofocus"<?php if($action == 'edit' && isset($info))echo 'value="'.$info['route_destination'].'"'; echo (!$view) ? : 'disabled' ; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="Distance">Distance</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="route_distance" class="form-control"  autofocus="autofocus"
                                                <?php if($action == 'edit' && isset($info))echo 'value="'.$info['route_distance'].'"'; echo (!$view) ? : 'disabled' ; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-3 col-md-offset-9">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                                            <button type="submit" class="btn btn-success" id="personal_information"> <?php echo ($action == 'edit' && isset($info))? 'update' : 'save'; ?></button>
                                            <button type="button" class="hidden reset-btn">Custom Reset Button</button>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </form>