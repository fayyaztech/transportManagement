<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_model extends CI_Model
{

    public function fetch_vehicle_list($status)
    {
        $this->db->select('vehicle_id,vehicle_number');
        if ($status !== "") {
            $this->db->where('vehicle_status', $status);
        }

        $query = $this->db->get('vehicle');
        return $query->result_array();
    }

    public function get_consignor_name($consignor_id)
    {
        $this->db->select('consignor_name');
        $this->db->where('consignor_id', $consignor_id);
        return $this->db->get('consignors')->row_array()['consignor_name'];
    }

    public function fetch_assigned_routes($consignor_id)
    {
        $this->db->select('r.route_id,r.route_origin,r.route_destination,r.route_distance');
        $this->db->join('routes as r', 'r.route_id = as_r.route_id', 'left');
        $this->db->where('as_r.consignor_id', $consignor_id);
        return $this->db->get('assigned_routes as as_r')->result_array();
    }

    public function fetch_route()
    {
        $this->db->order_by('route_origin', 'asc');
        $query = $this->db->get("routes");
        return $query->result_array();
    }

    public function get_loads($consignor_id)
    {
        $this->db->select('loads.*');
        $this->db->where(["loads.consignor_id" => $consignor_id, "loads.load_status" => 0]);
        return $this->db->get('loads')->result_array();
    }

    public function driver_unavailable($driver_id)
    {
        /**make driver busy */
        $this->db->where('driver_id', $driver_id);
        $this->db->update('driver', ['driver_status' => 2]);
    }

    public function driver_available($driver_id)
    {
        /**make driver free */
        $this->db->where('driver_id', $driver_id);
        $this->db->update('driver', ['driver_status' => 1]);
    }

    public function vehicle_unavailable($vehicle_id)
    {
        /**set as vehicle running */
        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->update('vehicle', ['vehicle_status' => 2]);
    }

    public function vehicle_available($vehicle_id)
    {
        /**set as vehicle free */
        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->update('vehicle', ['vehicle_status' => 1]);
    }

    public function get_consignor_id($trip_id)
    {
        /**get consignor id by trip id */
        $this->db->select('consignor_id');
        $this->db->where('trip_id', $trip_id);
        return $this->db->get('trip')->row_array()['consignor_id'];
    }

    public function get_drivers()
    {
        /**get active driver */
        $this->db->select('driver_id,driver_name');
        $this->db->where('driver_status', 1);
        $query = $this->db->get('driver');
        return $query->result_array();
    }

    public function get_driver_name($driver_id)
    {
        $this->db->select('driver_name');
        $this->db->where('driver_id', $driver_id);
        return $this->db->get('driver')->row_array()['driver_name'];
    }

    public function get_active_driver_id($step_id)
    {
        # active driver on trip step
        $this->db->select('driver_id');
        $this->db->where('trip_details_id', $step_id);
        return $this->db->get('trip_details')->row_array()['driver_id'];
    }

    public function get_active_vehicle_id($trip_id)
    {
        $this->db->select('vehicle_id');
        $this->db->where('trip_id', $trip_id);
        return $this->db->get('trip')->row_array()['vehicle_id'];
    }

    public function get_km_by_route($route_id)
    {
        $this->db->select('route_distance');
        $this->db->where('route_id', $route_id);
        return $this->db->get('routes')->row_array()['route_distance'];
    }

    public function get_active_maintenance($vehicle_id)
    {
        $this->db->select('mnt_id');
        $this->db->where(['vehicle_id' => $vehicle_id, 'mnt_status' => 1]);
        $this->db->where('mnt_type <> ', 3);
        return $this->db->get('maintenance')->result_array();
    }

    public function update_maintenance($update_maintenance)
    {
        $r = false; //default false
        if ($this->db->insert_batch('maintenanance_run', $update_maintenance)) {
            $r = true;
        }
        return $r;
    }
    public function get_consignors()
    {
        $query = $this->db->get('consignors');
        return $query->result_array();
    }

    public function get_consignees($consignor_id)
    {
        $this->db->where('consignor_id', $consignor_id);
        return $this->db->get('consignees')->result_array();
    }

    public function get_vehicle_number($vehicle_id)
    {
        $this->db->select('vehicle_number');
        $this->db->where('vehicle_id', $vehicle_id);
        return $this->db->get('vehicle')->row_array()['vehicle_number'];
    }

}

/* End of file common_model.php */
/* Location: ./application/models/common_model.php */
