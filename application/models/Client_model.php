<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client_model extends CI_Model
{

    public function get_list()
    {
        $query = $this->db->get('consignors');
        return $query->result();
    }

    public function add_client($post)
    {
        $responce = 0; //operation failed
        if (isset($post['consignor_id'])) {
            $this->db->where('consignor_id', $post['consignor_id']);
            unset($post["consignor_id"]);
            if ($this->db->update('consignors', $post)) {
                $responce = 2; //uodated
            }
        } elseif ($this->db->insert('consignors', $post)) {
            $responce = 1; //new added
        }
        return $responce;
    }

    public function add_consignee($post)
    {
        if ($this->db->insert('consignees', $post)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_consignor($consignor_id)
    {
        $this->db->where('consignor_id', $consignor_id);
        $this->db->delete('consignees');

        $this->db->where('consignor_id', $consignor_id);
        if ($this->db->delete('consignors')) {
            return true;
        }
    }

    public function delete_consignee($consigee_id)
    {
        $this->db->where('consignee_id', $consigee_id);
        if($this->db->delete('consignees')){
            return TRUE;
        }
    }

    public function fetch_consignee_list($consignor_id)
    {
        $this->db->where('consignor_id', $consignor_id);
        return $this->db->get('consignees')->result_array();
    }

    public function fetch_client_info($client_id)
    {
        $this->db->where('consignor_id', $client_id);
        $query = $this->db->get('consignors');
        return $query->row_array();
    }

}

/* End of file client_model.php */
/* Location: ./application/models/client_model.php */
