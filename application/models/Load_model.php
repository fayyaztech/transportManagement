<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Load_model extends CI_Model
{

    public function add_load($post)
    {
        $responce = 0; //operation failed
        if (!empty($post['load_id'])) {
            $this->db->where('load_id', $post['load_id']);
            if($this->db->update('loads',$post)){
                $responce = 2; //update
            }
            
        } else {

            if ($this->db->insert('loads', $post)) {
                $responce = 1; // new added;
            }
        }
        return $responce;
    }

    public function delete_load($load_id)
    {
        $this->db->where('load_id', $load_id);
        if($this->db->update('loads', ['load_status'=>1])){
            return true;
        }
    }

    public function fetch_load($load_id)
    {
        $this->db->where('load_id', $load_id);
        return $this->db->get('loads')->row_array();
    }

    public function fetch_load_records()
    {
        $this->db->select('loads.*');
        $this->db->select('consignors.consignor_name');
        $this->db->where('loads.load_status', 0);
        $this->db->join('consignors', 'loads.consignor_id = consignors.consignor_id', 'left');
        $this->db->from('loads');
        $query = $this->db->get();
        return $query->result();

    }

}

/* End of file Loads_model.php */
/* Location: ./application/models/Loads_model.php */
