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
        return $query->result();
    }

}

/* End of file common_model.php */
/* Location: ./application/models/common_model.php */
