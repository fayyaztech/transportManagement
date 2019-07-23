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
        if ($this->db->insert('consignors', $post)) {
            return true;
        } else {
            return false;
        }
    }

    public function add_consignee($post)
    {
        if ($this->db->insert('consignees', $post)) {
            return true;
        } else {
            return false;
        }
    }

    public function update_client_info($post, $client_id)
    {
        $this->db->where('client_id', $client_id);
        if ($this->db->update('client', $post)) {
            return true;
        } else {
            return false;
        }
    }

    public function fetch_client_info($client_id)
    {
        $this->db->where('client_id', $client_id);
        $query = $this->db->get('client');
        return $query->result();
    }

}

/* End of file client_model.php */
/* Location: ./application/models/client_model.php */
