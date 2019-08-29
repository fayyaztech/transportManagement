<div class="panel panel-primary">
      <div class="panel-heading">
            <h3 class="panel-title"><?php echo $title;?> Routs FOR <b><?php echo strtoupper($consignor_name);?></b></h3>
      </div>
      <div class="panel-body">
            <div class="table-responsive">
            <form id="assign_route">
            
            <input type="hidden" name="consignor_id" class="form-control" value="<?php echo $consignor_id; ?>">
            
            <input type="hidden" name="action" value="<?php echo $action; ?>">
            
            
                <table class="table table-hover" id="route_table">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Distance</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php for ($i = 0; $i < count($routes); $i++) {?>
                        <tr>
                            <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="routes[]" value="<?php echo $routes[$i]['route_id']; ?>" <?php echo $routes[$i]['status'];?>>
                                </label>
                            </div>
                            </td>
                                <td><?php echo $routes[$i]['route_origin'] ?></td>
                                <td><?php echo $routes[$i]['route_destination'] ?></td>
                                <td><?php echo $routes[$i]['route_distance'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
                
                <button type="submit" class="btn btn-primary pull-right col-md-4">Assign</button>
                
                </form>
            </div>

      </div>
</div>
