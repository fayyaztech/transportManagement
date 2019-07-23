<?php

function getCurrentFreight($ctx,$load_route_id)
{
	$ctx->db->where("load_routes_id",$load_route_id);
	return $ctx->db->get("freights")->row()->freight;
}

function add_advance($ctx, $trip_id, $advance)
{
    $ctx->db->insert('advances', ['trip_id' => $trip_id, 'advance_amount' => $advance]);
}
function getGenralExpense($ctx)
{
    $ctx->db->select('ed_id,ed_name');
    $ctx->db->where('et_id', 1);
    $query = $ctx->db->get('expenses_details');
    return $query->result();
}
function dateDifferenceInDay($date, $date2)
{
    $datetime1 = new DateTime($date);
    $datetime2 = new DateTime($date2);
    $interval = $datetime1->diff($datetime2);
    return $interval->format('%R%a days');
}

function getFreightRate($ctx, $rout_id, $trip_date)
{

	/* 
	
		@ this function is disable and deleted soon do not use any more 


	*/

    // $ctx->output->enable_profiler(TRUE);
    $ctx->db->select('freight_rate.freight_rate,freight_rate.freight_cmvr');
    $ctx->db->where('freight_rate.freight_affect_date <= "' . $trip_date . '"');
    $ctx->db->order_by('freight_rate.freight_affect_date', 'desc');
    $ctx->db->limit(1);
    $query = $ctx->db->get('freight_rate');
    $c = $query->row();
    return ['freight_rate' => $c->freight_rate, 'freight_cmvr' => $c->freight_cmvr];
}

function getDriverIDByTripId($ctx, $trip_id)
{
    $ctx->db->where('trip_id', $trip_id);
    $ctx->db->select('driver_id');
    $q = $ctx->db->get('trip');
    $c = $q->row();
    return $c->driver_id;
}

function update_driver_status($ctx, $status)
{
    // if status is 2 then vehicle is running
    // status is an array contains driverId and Status 
    $ctx->db->where('driver_id', $status['driver_id']);
    if ($ctx->db->update('driver', $status)) {
        return true;
    }
}
function check_current_reading_greater($ctx, $vers)
{
    // before updating tyre check current vehicale reading is grate than old reading
    // $vers is an array of vehicle id and kilometer reading

    $ctx->db->select('vehicle_current_reading');
    $ctx->db->where('vehicle_id', $vers['vehicle_id']);
    $query = $ctx->db->get('vehicle');
    $r = $query->row();
    // $o old reading
    $o = $r->vehicle_current_reading;
    // new reading
    $c = $vers['vehicle_current_reading'];
    if ($o <= $c) {
        // if old is smaller than new
        return true;
    } else {
        return false;
        // new smaller than old
    }

}

function check_number_of_tyre($ctx, $vehicle_id)
{
    $ctx->db->select('vehicle_tyres');
    $ctx->db->where('vehicle_id', $vehicle_id);
    $query = $ctx->db->get('vehicle');
    $r = $query->row();
    $v_tyre = $r->vehicle_tyres;
    $ctx->db->where(['vehicle_id' => $vehicle_id, 'expense_details_id' => 1]);
    $q = $ctx->db->get('product_purchase');
    $q->num_rows();
    if ($v_tyre > $q->num_rows()) {
        // possible to add new tyre
        return true;
    } else {
        // tyre capacity of vehicle is full
        return false;
    }
}

function update_vehicle_status($ctx, $vehicle_id, $status)
{
    $ctx->db->where('vehicle_id', $vehicle_id);
    if ($ctx->db->update('vehicle', ['vehicle_status' => $status])) {
        return true;
    } else {
        return false;
    }
}
function fetch_vehicle_list($ctx, $status = 1)
{
    // $ctx context of current object
    // $staus if 1 active vehicle if 0 inactive vehicle
    $ctx->db->where('vehicle_status', $status);
    $query = $ctx->db->get('vehicle');
    return $query->result();
}

function vehicle_data($ctx)
{
    // function used for get vahicle last trip and last maintainance
    // and all details about vehicle
    // active vahicles

    // $ctx->db->where('vehhicle.vehicle_status',1);
    // $ctx->db->get('vehicle');
    // $ctx->db->join('trip', 'trip.vehicle_id = vehicle.vehicle_id', 'left');
    // $ctx->db->join('expense');
}

// Fetch All Trip Data In List For The Main Table
// Added By Afroz Khan 28-02-2019

function fetch_trip_list($ctx)
{
    // $ctx context of current object
    // $staus if 1 active vehicle if 0 inactive vehicle
    $ctx->db->select('trip.*,trip_details.*');
    $ctx->db->select('route.route_id,route.route_origin,route.route_destination,route.route_distance');
    $ctx->db->select('loads.load_name,consignee_name,trip_stop_date');
    $ctx->db->select('driver.driver_name');
    $ctx->db->select('consignors.consignor_name');
	$ctx->db->select('vehicle.vehicle_id,vehicle.vehicle_number');

	$ctx->db->order_by('trip.trip_status', 'asc');
	
    $ctx->db->join('trip_details', 'trip.trip_id = trip_details.trip_id', 'left');
    $ctx->db->join('routes as route', 'trip_details.route_id = route.route_id', 'left');
    $ctx->db->join('consignors', 'trip.consignor_id =consignors.consignor_id');
    $ctx->db->join('vehicle', 'trip.vehicle_id= vehicle.vehicle_id', 'left');
    $ctx->db->join("loads", 'trip_details.load_id = loads.load_id', 'left');
    $ctx->db->join('driver', 'trip_details.driver_id = driver.driver_id');
    $ctx->db->join('consignees', 'trip.consignee_id = consignees.consignee_id', 'left');
    $ctx->db->from('trip');
    $query = $ctx->db->get();
    return $query->result();
}

function fetch_identity_doc($ctx)
{
    // get list of all identity proof doc like adhar pan voting id and other
    $query = $ctx->db->get('identity_doc');
    return $query->result();
}

// Added By Afroz Khan On 28-02-2019

function fetch_status($ctx)
{
    // get list of all identity proof doc like adhar pan voting id and other
    $query = $ctx->db->get('trip_status');
    return $query->result();
}

// Added By Afroz Khan On 28-02-2019

function fetch_load($ctx, $consignor_id)
{

    if (!empty($consignor_id)) {
        $ctx->db->where("consignor_id", $consignor_id);
    }

    $query = $ctx->db->get('loads');
    return $query->result();
}

// Added By Afroz Khan On 28-02-2019

function fetch_route($ctx)
{
    // fetch route data
    $ctx->db->order_by('route_origin', 'asc');
    $query = $ctx->db->get('routes');
    return $query->result();
}

// Added By Afroz Khan

function fetch_driver($ctx, $status = "")
{
    // fetch route data
    $ctx->db->where('driver_running_status', $status);
    $query = $ctx->db->get('driver');
    return $query->result();
}

function fetch_consignor($ctx)
{
    // load clients list
    $ctx->db->order_by('consignor_name', 'asc');
    $ctx->db->select('consignor_id,consignor_name');
    $query = $ctx->db->get('consignors');
    return $query->result();
}
function fetch_consignee($ctx, $consignor_id = "")
{

    if (!empty($consignor_id)) {
        $ctx->db->where('consignor_id', $consignor_id);
    }
    // load clients list
    $ctx->db->order_by('consignee_name', 'asc');
    $ctx->db->select('consignee_id,consignee_name');
    $query = $ctx->db->get('consignees');
    return $query->result();
}

function fetch_drivers($ctx, $status)
{
    /*
     * $ctx is context
     * $status select Active or deactive drives
     */
    $ctx->db->order_by('driver_name', 'asc');
    $ctx->db->select('driver_id,driver_name');
    $query = $ctx->db->get('driver');
    return $query->result();
}

function fetch_routes($ctx, $client_id)
{
    // $client id compulsory for select rout for prticulare client
    $query = $ctx->db->get('route');
    return $query->result();
}
