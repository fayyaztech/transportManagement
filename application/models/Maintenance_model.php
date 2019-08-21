<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance_model extends CI_Model
{
    public function add_maintenance($data)
    {
        $responce = 0; //faild opration
        if($this->db->insert('maintainance', $data)){
            $responce = 1; // new record
        }

        return $responce;
    }
}

/* End of file maintenance_model.php */
/* Location: ./application/models/maintenance_model.php */
