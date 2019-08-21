<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance_model extends CI_Model
{
    public function add_maintenance($data)
    {
        $responce = 0; //faild opration
        if ($this->db->insert('maintenance', $data)) {
            $responce = 1; // new record
        }

        return $responce;
    }

    public function maintenance_records($vehicle_id)
    {
        // if record filter applied select perticular vehicle records
        if ($vehicle_id !== "") {
            $this->db->where('mnt.vehicle_id', $vehicle_id);
        }

        $this->db->select('mnt.mnt_id,mnt.mnt_type,mnt.mnt_date,mnt.mnt_name,mnt.mnt_shop_name,mnt.mnt_amount,mnt.mnt_warranty,v.vehicle_number,mntt.mnt_type_name');
        $this->db->join('maintenance_type as mntt', 'mnt.mnt_type = mntt.mnt_type_id', 'left');        
        $this->db->join('vehicle as v', 'mnt.vehicle_id = v.vehicle_id', 'left');
        return $this->db->get('maintenance as mnt')->result_array();

    }

    public function get_mnt_types()
    {
        return $this->db->get('maintenance_type')->result_array();
    }

    public function single_maintenance_record($mnt_id)
    {
        $this->db->where('mnt.mnt_id', $mnt_id);        
        $this->db->select('v.vehicle_number,mntt.mnt_type_name,mnt.*');
        $this->db->join('maintenance_type as mntt', 'mnt.mnt_type = mntt.mnt_type_id', 'left');        
        $this->db->join('vehicle as v', 'mnt.vehicle_id = v.vehicle_id', 'left');
        return $this->db->get('maintenance as mnt')->row_array();        
    }
}

/* End of file maintenance_model.php */
/* Location: ./application/models/maintenance_model.php */
