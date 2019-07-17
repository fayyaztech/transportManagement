<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver_model extends CI_Model {

	public function save_diver_info($driver_info)
	{
		if ($this->db->insert('driver', $driver_info)) {
			return $this->db->insert_id();
		}else{
			return false;
		}
	}
	public function fetch_driver_info($driver_id)
	{
		$this->db->where('driver_id', $driver_id);
		$query= $this->db->get('driver');
		return $query->result();
	}
	public function update_driver_info($driver_info)
	{
		$driver_id = $driver_info['driver_id'];
		$this->db->where('driver_id', $driver_info['driver_id']);
		unset($driver_info['driver_id']);
		$driver_info['driver_form_status'] = 2;
		if ($this->db->update('driver', $driver_info)) {
			return true;
		}else{
			return false;
		}
	}

	public function driverManagement()
	{
		$this->db->select('driver.*');
		$query = $this->db->get('driver');
		return $query->result();
	}

	public function get_driver_records($driver_id = "")
	{
		$this->db->select('trip_details.trip_start_date,trip_details.driver_id,trip.allowance,trip_details.trip_stop_date,route.route_origin,route.route_destination,trip.incentive');
		$this->db->select('vehicle.vehicle_number');
		$this->db->where('trip_details.driver_id', $driver_id);
		$this->db->join('trip_details', 'trip.trip_id = trip_details.trip_id', 'left');
		$this->db->join('vehicle', 'trip.vehicle_id = vehicle.vehicle_id', 'left');
		$this->db->join('route', 'trip_details.route_id = route.route_id', 'left');
		$this->db->from('trip');
		$this->db->limit(1);
		$this->db->order_by('trip.trip_id', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

	public function driver_trip_count($driver_id)
	{
		$this->db->where('driver_id', $driver_id);
		$query = $this->db->get('trip_details');
		return $query->num_rows();

	}
}

/* End of file driver_model.php */
/* Location: ./application/models/driver_model.php */