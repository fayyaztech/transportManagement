<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Routes_model extends CI_Model
{

    public function delete_route($id)
    {
        $this->db->where('route_id', $id);
        if ($this->db->delete('routes')) {
            return true;
        }
    }

    public function add_route($data)
    {

        if ($this->db->insert('routes', ['route_origin' => $data['route_origin'], 'route_destination' => $data['route_destination'], 'route_distance' => $data['route_distance']])) {
            return true;
        }

    }
    public function update_freight($data)
    {

        $this->db->where('freight_id', $data['freight_id']);
        if (!$this->db->update('freight_rate', ['freight_status' => 0])) {
            die();
        }
        unset($data['freight_id']);

        if ($this->db->insert('freight_rate', ['route_id' => $data['route_id'], 'freight_affect_date' => $data['freight_affect_date'], 'freight_rate' => $data['freight_rate'], 'freight_cmvr' => $data['freight_cmvr']])) {
            return true;
        }
    }

    public function fetch_route()
    {

        $this->db->order_by('route_origin', 'asc');
        $query = $this->db->get("routes");
        return $query->result_array();

    }

    public function single_route($route_id)
    {
        $this->db->select('route.*');
        $this->db->select('freight_rate.*');
        $this->db->where('route.route_id', $route_id);
        $this->db->where(['freight_rate.route_id' => $route_id, 'freight_status' => 1]);
        $this->db->from('route');
        $this->db->join('freight_rate', 'route.route_id = freight_rate.route_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }
}
