<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loads_model extends CI_Model {

	public function add_load($post){
		if($this->db->insert('loads', $post)){
			return true;
		}else{
			return false;
		}
	}

	public function fetch_load_records(){
		$this->db->select('loads.*');
		$this->db->select('consignors.consignor_name');
		$this->db->where('loads.load_status', 0);
		$this->db->join('consignors', 'loads.consignor_id = consignors.consignor_id', 'left');
		$this->db->from('loads');
		$query= $this->db->get();
		return $query->result();
		
	 }

}

/* End of file Loads_model.php */
/* Location: ./application/models/Loads_model.php */