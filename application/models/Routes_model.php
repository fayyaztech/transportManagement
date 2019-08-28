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

    public function add_route($post)
    {

        $response = 0; //operation failed
        if (isset($post['route_id'])) {
            $this->db->where('route_id', $post['route_id']);
            unset($post["route_id"]);
            if ($this->db->update('routes', $post)) {
                $response = 2; //uodated
            }
        } elseif ($this->db->insert('routes', $post)) {
            $response = 1; //new added
        }
        return $response;

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

    public function fetch_route_info($route_id)
    {
        
         $this->db->where('route_id', $route_id);
        $query = $this->db->get('routes');
        return $query->row_array();
    }
}
