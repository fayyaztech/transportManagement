<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehicle_model extends CI_Model
{

    public function get_vehicle_last_trip_details($vehicle_id)
    {
        $this->db->select('trip_details.trip_stop_date,trip_details.route_id,trip_details.driver_id,driver.driver_id,driver.driver_name,routes.route_origin,routes.route_destination');
        $this->db->where('trip.vehicle_id', $vehicle_id);
        $this->db->order_by('trip.trip_id', 'desc');
        $this->db->join('trip_details', 'trip.trip_id = trip_details.trip_id', 'left');
        $this->db->join('driver', 'trip_details.driver_id = driver.driver_id', 'left');
        $this->db->join('routes', 'trip_details.route_id = routes.route_id', 'left');
        $this->db->limit(1);
        $query = $this->db->get('trip');
        return $query->row();

    }

    public function get_vehicle_details()
    {
        $this->db->select('vehicle.vehicle_id,vehicle.vehicle_number,vehicle.vehicle_current_reading,vehicle.vehicle_status');
        $this->db->where('vehicle_status<>', 0);
        $query = $this->db->get('vehicle');
        return $query->result();
    }

    public function add_vehicle_info($vehicle_data)
    {
        $responce = false;
        if (isset($vehicle_data["vehicle_id"])) {
            $this->db->where('vehicle_id', $vehicle_data['vehicle_id']);
            unset($vehicle_data['vehicle_id']);
            if ($this->db->update('vehicle', $vehicle_data)) {
                    $responce = true;
            }else{
                if ($this->db->insert_batch('vehicle',$vehicle_data)) {
                    $responce = true;
                }
            }
        }

        return $responce;
    }

    public function update_vehicle_info($vehicle_id, $info)
    {
        //echo $vehicle_id;
        $this->db->where('vehicle_id', $vehicle_id);
        if ($this->db->update('vehicle', $info)) {
            return true;
        }
    }

    public function delete_vehicle_info($vehicle_id)
    {
        $this->db->where('vehicle_id', $vehicle_id);
        if ($this->db->update('vehicle', ['vehicle_status' => '0'])) {
            return true;
        }
    }

    public function fetch_single_vehicle_info($vehicle_id)
    {
        $this->db->where(['vehicle_id' => $vehicle_id, 'vehicle_status' => '1']);
        $query = $this->db->get('vehicle');
        return $query->result_array();
    }

}

/* End of file vehicle */
/* Location: ./application/models/vehicle */
