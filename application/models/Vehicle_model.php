<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehicle_model extends CI_Model
{
    public function get_vehicle_details($filter)
    {
        $this->db->select('vehicle.vehicle_id,vehicle.vehicle_number,vehicle.vehicle_purchase_date,vehicle.vehicle_status,vehicle_body_type,vehicle_registration_date');
    
        // 1 is active, 2 is running , 0 is deactivated
        if ($filter == 1 || $filter == 2 || $filter == 0) {
            $this->db->where('vehicle_status =', $filter);
        }

        $query = $this->db->get('vehicle');
        return $query->result();
    }

    public function add_vehicle_info($vehicle_data)
    {
        // add update vehicle
        $responce = false; // failed;

        if (isset($vehicle_data["vehicle_id"])) {
            $this->db->where('vehicle_id', $vehicle_data['vehicle_id']);
            unset($vehicle_data['vehicle_id']);
            if ($this->db->update('vehicle', $vehicle_data)) {
                    $responce = 2; //'updated';
             }
            }else{
                if ($this->db->insert('vehicle',$vehicle_data)) {
                    $responce = 1; //'new_added';
                }
            }
        

        return $responce;
    }

    public function delete_vehicle_info($vehicle_id)
    {
        $this->db->where('vehicle_id', $vehicle_id);
        if ($this->db->update('vehicle', ['vehicle_status' => 0])) {
            return true;
        }
    }

    public function reactive_vehicle($vehicle_id)
    {
        $this->db->where('vehicle_id', $vehicle_id);
        if ($this->db->update('vehicle', ['vehicle_status' => 1])) {
            return true;
        }
    }

    public function fetch_single_vehicle_info($vehicle_id)
    {
        $this->db->where(['vehicle_id' => $vehicle_id]);
        $query = $this->db->get('vehicle');
        return $query->result_array();
    }

}

/* End of file vehicle */
/* Location: ./application/models/vehicle */
