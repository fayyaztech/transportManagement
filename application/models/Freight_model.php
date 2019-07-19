<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freight_model extends CI_Model
{

    public function get_loads($consignor_id)
    {
        $this->db->select('loads.*');
        $this->db->where(["loads.consignor_id" => $consignor_id, "loads.load_status" => 0]);
        return $this->db->get('loads')->result();

    }

    public function get_routes()
    {
        return $this->db->get('routes')->result();
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
        $id = $this->db->get('routes')->row()->route_id;
        if (empty($id)) {
            $this->db->insert('routes', $data);
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
        echo $date = date("d-m-Y", strtotime($new_freights['freight_effected_date']));
        // $query = "INSERT IGNORE INTO freights (load_routes_id,freight_effected_date,freight) VALUE (" . $new_freights['load_routes_id'] . "," . $date . "," . $new_freights['freight'] . ")";
        $query = $this->db->insert_string('freights', $new_freights);
        $query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $query);
        echo $query;
        $this->db->query($query);
    }

}

/* End of file freight_model.php */
/* Location: ./application/models/freight_model.php */
