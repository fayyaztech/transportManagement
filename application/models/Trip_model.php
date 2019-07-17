<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trip_model extends CI_Model {
	// Add Trip Function

public function save_trip_info($data)
{
	if(
		$this->db->insert(
			'trip',
			[
				'trip_start_date'=>$data['trip_start_date'],
				'vehicle_id'=>$data['vehicle_id'],
				'consignor_id'=>$data['consignor_id'],
				'consignee_id'=>$data['consignee_id'],
				'allowance'=>$data['allowance']
			]
		)
	)
	{
	     return $this->db->insert_id();
	     // $data['trip_id']=$trip_id;
	     // if($this->db->insert('trip_details',['trip_id'=>$data['trip_id'],'trip_type'=>$data['trip_type'],'load_id'=>$data['load_id'],'driver_id'=>$data['driver_id'],'route_id'=>$data['route_id'],'trip_status'=>2,'trip_start_date'=>$data['trip_start_date']]))
	     // {
	     // 	return true;
	     // }
	}else{
		return false;
	}
}

public function add_trip_step($data){
	if($this->db->insert('trip_details', $data)){
		return true;
	}
}
public function add_advance($data){
	if($this->db->insert('advances', $data)){
		return true;
	}
}
// // Update Trip Function

public function update_trip_info($info)
{
	//print_r($info);
	$trip_id = $info['trip_id'];
	unset($info['trip_id']);
	$this->db->where('trip_id', $trip_id);
	if($this->db->set(['driver_id' => $info['driver_id'],'route_id' => $info['route_id']]))
	{
		$this->db->update('trip_details');
	}
	if($this->db->set(['allowance'=>$info['allowance']]))
	{
		$this->db->update('trip');
	}
	
	return true;	
}

// // Stop Trip Function

public function stop_trip_info($info)
{
	$trip_id = $info['trip_id'];
	unset($info['trip_id']);
	$this->db->set($info);
	$this->db->where('trip_id', $trip_id);
	$this->db->update('trip');
	return true;
}

// // Fetch Trip Data For Update

public function fetch_trip_info($trip_id)
{
		$this->db->select('trip.*');
	    // 
		 $this->db->select('routes.route_id,routes.route_origin,routes.route_destination,routes.route_distance');
		 $this->db->select('trip_details.route_id,trip_details.driver_id,trip_details.trip_id,trip_details.trip_start_date,trip_details.trip_status');
		 
		 $this->db->select('trip.*');
	    // 
		 $this->db->select('routes.route_id,routes.route_origin,routes.route_destination,routes.route_distance');
		 $this->db->select('load_type.load_name,trip_details.route_id,trip_details.trip_id,trip_details.trip_start_date,trip_details.trip_status');
			$this->db->select('driver.driver_name');
		 	 $this->db->select('consignors.consignor_name');
		 	 $this->db->select('vehicle.vehicle_id,vehicle.vehicle_number');
			 $this->db->join('trip_details','trip.trip_id = trip_details.trip_id', 'left');
			 $this->db->join('routes', 'trip_details.route_id = routes.route_id', 'left');
			 $this->db->join('consignors','trip.consignor_id = consignors.consignor_id');
			 $this->db->join('vehicle', 'trip.vehicle_id= vehicle.vehicle_id', 'left');
			 $this->db->join("load_type",'trip_details.load_id = load_type.load_id','left');
			 $this->db->join('driver','trip_details.driver_id = driver.driver_id');
	    	 $this->db->from('trip');
		$query= $this->db->get();
		return $query->result();
		
		$query= $this->db->get();
		return $query->result();
}

}