<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver_model extends CI_Model
{

    public function delete_driver_info($driver_id)
    {
        $responce = 0; //default failed
        $this->db->where('driver_id', $driver_id);
        if ($this->db->update('driver', ['driver_status' => '0'])) {
            $responce = 1;
        }
        return $responce;
    }

    public function reactive_driver($driver_id)
    {
        $responce = 0; //default failed
        $this->db->where('driver_id', $driver_id);
        if ($this->db->update('driver', ['driver_status' => '1'])) {
            $responce = 1;
        }
        return $responce;
    }

    public function save_diver_info($driver_info)
    {
        $responce = 0; //operation failed
        // save and update driver info 
        if (isset($driver_info['driver_id'])) {
            $this->db->where('driver_id', $driver_info['driver_id']);
            unset($driver_info['driver_id']);
            if ($this->db->update('driver', $driver_info)) {
                $responce = 2; //uodated
            }
        }else{
            if ($this->db->insert('driver', $driver_info)) {
                $responce = 1; //new added
            }

        }

        return $responce;
    }

    public function fetch_driver_info($driver_id)
    {

        $this->db->where('driver_id', $driver_id);
        $query = $this->db->get('driver');
        return $query->result_array();
    }

    public function driverManagement($filter)
    {
        $this->db->select('driver.*');
        if ($filter == 1 || $filter == 2 || $filter == 0) {
            $this->db->where('driver_status', $filter);
        }
        $query = $this->db->get('driver');
        return $query->result();
    }
}

/* End of file driver_model.php */
/* Location: ./application/models/driver_model.php */
