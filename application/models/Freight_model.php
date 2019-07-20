<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Freight_model extends CI_Model
{
    public function getConsignorNameById($consignor_id)
    {
        $this->db->where('consignor_id', $consignor_id);
        return $this->db->get('consignors')->row()->consignor_name;
    }

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
        
        $query = $this->db->get('routes');

        if ($query->num_rows() == 0) {
            $id = "";
        } else {
            $id = $query->row()->route_id;
        }

        if (empty($id)) {
            $this->db->insert('routes', $data);
            echo custom_log("new route added ".implode(" ", $data));
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
        }else{
            $status = "freight alreday exist for same date and value ";
        }

        custom_log($status.implode(" ",$new_freights));
        
    }

}

/* End of file freight_model.php */
/* Location: ./application/models/freight_model.php */
