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

}

/* End of file common_model.php */
/* Location: ./application/models/common_model.php */
