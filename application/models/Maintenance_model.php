<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maintenance_model extends CI_Model
{

    public function delete_expense($expense_id)
    {
        $this->db->where('expense_id', $expense_id);
        if ($this->db->delete('expenses')) {
            return true;
        }
    }

    public function get_expense()
    {
        $this->db->select('expenses.expense_id,expenses.expense_date,expenses.expense_amount,expense_vendar_name,expenses_details.ed_name,expenses.expense_bill_no,expenses.note');
        $this->db->where('expenses.product_purchase_id IS NULL');
        $this->db->join('expenses_details', 'expenses.expense_name = expenses_details.ed_id', 'left');
        $query = $this->db->get('expenses');
        return $query->result();

    }
    public function add_expenses($post)
    {
        if ($this->db->insert('expenses', $post)) {
            return true;
        }
    }

    public function fetch_vehicle_details($vehicle_id)
    {
        $this->db->select('vehicle.vehicle_current_reading');
        $this->db->select('expenses_details.ed_name');
        $this->db->select('product_purchase.*,expenses.*');
        $this->db->where('product_purchase.vehicle_id', $vehicle_id);
        $this->db->where('product_purchase.pp_status', 1);
        $this->db->join('expenses', 'product_purchase.pp_id = expenses.product_purchase_id', 'left');
        $this->db->join('expenses_details', 'expenses_details.ed_id = product_purchase.expense_details_id', 'left');
        $this->db->join('vehicle', 'product_purchase.vehicle_id = vehicle.vehicle_id');
        $query = $this->db->get('product_purchase');
        return $query->result();
    }

    public function fetch_tyre_info_by_vid($vehicle_id)
    {
        $this->db->where(['pp_id' => '1', 'vehicle_id' => $vehicle_id]);
        $query = $this->db->get('vehicle_maintenance');
        return $query->result();
    }

    public function fetch_battery_info($vm_id)
    {
        $this->db->where(['pp_id' => '3', 'vm_id' => $vm_id]);
        $query = $this->db->get('vehicle_maintenance');
        return $query->result();
    }

// aadd product and expense
    public function add_product($data)
    {

        if ($data['expense_details_id'] == 2) {
            // if expenses are oil then older oil status replase with 0
            $this->db->where(['vehicle_id' => $data['vehicle_id'], 'expense_details_id' => 2]);
            $this->db->update('product_purchase', ['pp_status' => 0]);

        } elseif ($data['expense_details_id'] == 3) {
            // if expenses are battery then older oil status replase with 0
            $this->db->where(['vehicle_id' => $data['vehicle_id'], 'expense_details_id' => 3]);
            $this->db->update('product_purchase', ['pp_status' => 0]);
        } elseif ($data['expense_details_id'] == 13) {
            // if stepny added
            $this->db->where(['vehicle_id' => $data['vehicle_id'], 'pp_id' => $data['pp_id']]);
            unset($data['pp_id']);
            $this->db->update('product_purchase', ['pp_status' => 0]);
        }

        if ($this->db->insert('product_purchase', $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function delete_product($id)
    {
        $this->db->where('pp_id', $id);
        $this->db->delete('product_purchase');
    }

    public function insert_expenses($expense)
    {
        if ($this->db->insert('expenses', $expense)) {
            return true;
        } else {
            return false;
        }
    }

    // ***************** add product and expenses END*****************//

    public function add_oil_maintenance_info($data)
    {
        $vehicle_id = $data['vehicle_id'];
        $pp_id = $data['pp_id'];
        $this->db->set('vm_product_status', '0');
        $this->db->where(['vehicle_id' => $vehicle_id, 'pp_id' => $pp_id]);
        $this->db->update('vehicle_maintenance');
        if ($this->db->insert('vehicle_maintenance', $data)) {
            return true;
        }
    }

    public function add_battery_maintenance_info($data)
    {
        if ($this->db->insert('vehicle_maintenance', $data)) {
            return true;
        }
    }

    public function add_recharge_battery_info($data)
    {
        if ($this->db->insert('vehicle_maintenance', $data)) {
            return true;
        }
    }

    public function assign_battery($old_id, $data)
    {
        $this->db->set('vehicle_id', $data['vehicle_id']);
        $this->db->where(['vehicle_id' => $old_id, 'pp_id' => '3']);
        if ($this->db->update('vehicle_maintenance')) {
            return true;
        }
    }

    public function update_battery_maintenance_info($vm_id, $data)
    {
        $this->db->where(['vm_id' => $vm_id, 'pp_id' => '3']);
        if ($this->db->update('vehicle_maintenance', $data)) {
            return true;
        }
    }

    public function add_misc_maintenance_info($data)
    {
        if ($this->db->insert('vehicle_maintenance', $data)) {
            return true;
        }
    }

    public function add_permit_maintenance_info($data)
    {
        if ($this->db->insert('vehicle_maintenance', $data)) {
            return true;
        }
    }
}

/* End of file maintenance_model.php */
/* Location: ./application/models/maintenance_model.php */
