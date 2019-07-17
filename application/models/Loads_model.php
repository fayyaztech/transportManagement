<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loads_model extends CI_Model {

	public function add_load($post){
		if($this->db->insert('load_type', $post)){
			return true;
		}else{
			return false;
		}
	}

	public function fetch_load_records(){
		$this->db->select('load_type.*');
		$this->db->select('routes.route_id,routes.route_origin,routes.route_destination,routes.route_distance,consignors.consignor_id,consignors.consignor_name');
		$this->db->join('routes', 'load_type.route_id = routes.route_id', 'left');
		$this->db->join('consignors', 'load_type.consignor_id = consignors.consignor_id', 'left');
		$this->db->from('load_type');
		$query= $this->db->get();
		return $query->result();
		
	 }

}

/* End of file Loads_model.php */
/* Location: ./application/models/Loads_model.php */