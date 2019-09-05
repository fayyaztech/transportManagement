<?php

function getCurrentFreight($ctx, $load_route_id)
{
    $ctx->db->where("load_routes_id", $load_route_id);
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

function getDriverIDByTripId($ctx, $trip_id)
{
    $ctx->db->where('trip_id', $trip_id);
    $ctx->db->select('driver_id');
    $q = $ctx->db->get('trip');
    $c = $q->row();
    return $c->driver_id;
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
    // function used for get vehicle last trip and last maintenance
    // and all details about vehicle
    // active vahicles

    // $ctx->db->where('vehhicle.vehicle_status',1);
    // $ctx->db->get('vehicle');
    // $ctx->db->join('trip', 'trip.vehicle_id = vehicle.vehicle_id', 'left');
    // $ctx->db->join('expense');
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
    $ctx->db->where('driver_status', $status);
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

function format_date($date)
{
    return date('d-m-Y', strtotime($date));
}
