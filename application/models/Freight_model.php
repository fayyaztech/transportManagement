<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freight_model extends CI_Model
{
    public function get_freights()
    {
        /**get freight 
         * all freights
         */
        $this->db->select('l.load_name,r.route_origin,r.route_destination,f.freight_id,f.freight_effected_date,f.freight,c.consignor_name,lr.load_routes_id');        
        $this->db->join('routes as r', 'r.route_id = lr.route_id', 'left');
        $this->db->join('freights as f', 'f.load_routes_id = lr.load_routes_id', 'right');
        $this->db->join('loads as l', 'l.load_id = lr.load_id', 'left');        
        $this->db->join('consignors as c', 'c.consignor_id = l.consignor_id', 'left');
        
        return $this->db->get('load_routes as lr')->result_array();
        
    }
    public function get_load_id($load, $consignor_id)
    {
        $this->db->where(['load_name' => $load, "consignor_id" => $consignor_id, "load_status" => 0]);
        return $this->db->get('loads')->row()->load_id;

    }

    public function getRouteId($origin, $destination, $km)
    {
        $data = ['route_origin' => $origin, "route_destination" => $destination, "route_distance" => $km];
        $this->db->where($data);

        $query = $this->db->get('routes');

        if ($query->num_rows() == 0) {
            $id = "";
        } else {
            $id = $query->row()->route_id;
        }

        if (empty($id)) {
            $this->db->insert('routes', $data);
            echo custom_log("new route added " . implode(" ", $data));
            return $this->db->insert_id();
        } else {
            return $id;
        }
        print_r($data);

    }

    public function getLoadRoutsId($load_route_data)
    {
        $this->db->where($load_route_data);
        $query = $this->db->get('load_routes');

        if ($query->num_rows() == 0) {
            $id = "";
        } else {
            $id = $query->row()->load_routes_id;
        }

        if (empty($id)) {
            $this->db->insert('load_routes', $load_route_data);
            return $this->db->insert_id();

        } else {
            return $id;
        }

    }

    public function insert_new_load($new_freights)
    {

        $this->db->where($new_freights);
        if ($this->db->get('freights')->num_rows() == 0) {
            $query = $this->db->insert('freights', $new_freights);
            $status = "new freight rate updated for ";
        } else {
            $status = "freight alreday exist for same date and value ";
        }

        custom_log($status . implode(" ", $new_freights));

    }

}

/* End of file freight_model.php */
/* Location: ./application/models/freight_model.php */
