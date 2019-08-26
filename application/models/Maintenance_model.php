<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance_model extends CI_Model
{
    public function add_maintenance($data)
    {
        /**save new entry
         * update if received mnt_id
         * scrap old product if receved same id for recycled
         */
        $responce = 0; //faild opration
        if (isset($data['mnt_id'])) {
            $this->db->where('mnt_id', $data['mnt_id']);
            unset($data['mnt_id']);
            if ($this->db->update('maintenance', $data)) {
                $responce = 2; // 2 for form updated
            }

        } else {
            if($data['mnt_type'] == 4 || $data['mnt_type'] == 5 || $data['mnt_type'] == 6){
                /**if mnt type 
                 * 4 body work
                 * 5 engin work
                 * 6 misc work
                 * work status is done 3;
                 */
                $data['mnt_status'] = 3;
            }
            if ($this->db->insert('maintenance', $data)) {
                if (isset($data['mnt_type_renewed_id'])) {
                    $this->make_mnt_scrap($data['mnt_type_renewed_id']);
                }

                $responce = 1; // 1 for new record
            }
        }

        return $responce;
    }

    public function make_mnt_scrap($id)
    {
        $this->db->where('mnt_id', $id);
        return ($this->db->update('maintenance', ['mnt_status' => 2])) ? TRUE : FALSE ;

    }

    public function save_forward_mnt($post)
    {
        $this->db->where('mnt_id', $post['mnt_id']);
        if ($this->db->update('maintenance', $post)) {
            return 1;
        }
    }

    public function maintenance_records($vehicle_id)
    {     
        // if record filter applied select perticular vehicle records
        if ($vehicle_id !== "") {$this->db->where('mnt.vehicle_id', $vehicle_id);}
        $this->db->select('mnt.mnt_id,mnt.mnt_type,mnt.mnt_date,mnt.mnt_name,mnt.mnt_shop_name,mnt.mnt_amount,mnt.mnt_warranty,v.vehicle_number,mntt.mnt_type_name,mnt_status');
        $this->db->order_by('mnt.mnt_date', 'DESC');
        $this->db->join('maintenance_type as mntt', 'mnt.mnt_type = mntt.mnt_type_id', 'left');
        $this->db->join('vehicle as v', 'mnt.vehicle_id = v.vehicle_id', 'left');
        return $this->db->get('maintenance as mnt')->result_array();

    }

    public function get_mnt_types()
    {
        return $this->db->get('maintenance_type')->result_array();
    }

    public function delete_record($mnt_id)
    {
        $this->db->where('mnt_id', $mnt_id);
        if ($this->db->delete('maintenance')) {return true;}
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
