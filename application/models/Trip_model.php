<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trip_model extends CI_Model
{
    public function fetch_step_details($step_id)
    {
        $this->db->select('td.trip_details_id,td.trip_id,td.load_id,td.route_id,td.step_start_date,td.trip_detail_freight');
        $this->db->where('trip_details_id', $step_id);
        return $this->db->get('trip_details as td')->row_array();
    }
    // public function get_incomplete_trips($trip_id)
    // {
    //     $this->db->select('trip_details_id,driver_id');
    //     $this->db->where('trip_id', $trip_id);
    //     $this->db->where('trip_detail_status', 2);
    //     return $this->db->get("trip_details")->result();
    // }

    public function fetch_trip_details($trip_id)
    {
        $this->db->select('td.trip_id,td.route_id,t.driver_id,t.consignor_id,allowance,t.vehicle_id,t.driver_id');
        $this->db->where('td.trip_id', $trip_id);
        $this->db->order_by('td.trip_details_id', 'desc');
        $this->db->join('trip as t', 't.trip_id = td.trip_id', 'left');
        return $this->db->get("trip_details as td")->row();
    }

    public function end_step($data)
    {
        $r = false; //default false
        $this->db->where('trip_details_id', $data['trip_details_id']);
        $data['trip_detail_status'] = 3;
        unset($data['trip_details_id']);
        if ($this->db->update('trip_details', $data)) {
            $r = true;
        }

        return $r;

    }
    // Add Trip Function

    public function save_trip_info($data)
    {
        if (
            $this->db->insert(
                'trip',
                [
                    'trip_start_date' => $data['trip_start_date'],
                    'vehicle_id' => $data['vehicle_id'],
                    'consignor_id' => $data['consignor_id'],
                    'consignee_id' => $data['consignee_id'],
                    'allowance' => $data['allowance'],
                    'driver_id'=>$data['driver_id'],
                    'opening_diesel'=>$data['opening_diesel'],
                    'trip_opening_km'=>$data['trip_opening_km']
                ]
            )
        ) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }
    // Fetch All Trip Data In List For The Main Table
    // Added By Afroz Khan 28-02-2019

    public function fetch_trip_list()
    {
        // $ctx context of current object
        // $status if 1 active vehicle if 0 inactive vehicle
        $this->db->select('trip.*,trip_details.*');
        $this->db->select('route.route_id,route.route_origin,route.route_destination,route.route_distance');
        $this->db->select('loads.load_name,consignee_name,step_end_date');
        $this->db->select('driver.driver_name');
        $this->db->select('consignors.consignor_name');
        $this->db->select('vehicle.vehicle_id,vehicle.vehicle_number');
        $this->db->order_by('trip.trip_start_date', 'desc');
        $this->db->join('trip_details', 'trip.trip_id = trip_details.trip_id', 'left');
        $this->db->join('routes as route', 'trip_details.route_id = route.route_id', 'left');
        $this->db->join('consignors', 'trip.consignor_id = consignors.consignor_id');
        $this->db->join('vehicle', 'trip.vehicle_id = vehicle.vehicle_id', 'left');
        $this->db->join("loads", 'trip_details.load_id = loads.load_id', 'left');
        $this->db->join('driver', 'trip.driver_id = driver.driver_id');
        $this->db->join('consignees', 'trip.consignee_id = consignees.consignee_id', 'left');
        $this->db->from('trip');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_trip_step($data)
    {
        if ($this->db->insert('trip_details', $data)) {
            return true;
        }
    }
    public function add_advance($data)
    {
        if ($this->db->insert('advances', $data)) {
            return true;
        }
    }
// // Update Trip Function

    public function update_trip_info($info)
    {
        $r = false;
        $trip_id = $info['trip_id'];
        unset($info['trip_id']);
        $this->db->where('trip_id', $trip_id);
        if ($this->db->update('trip', $info)) {
            $r = true;
        }

        return $r;
    }

// // Stop Trip Function

    public function stop_trip($data)
    {
        $stop_date = $data['step_end_date'];
        $trip_id = $data['trip_id'];
        unset($data['trip_id']);
        $this->db->where('trip_id', $trip_id);
        if ($this->db->update('trip', ['trip_end_date' => $stop_date, "trip_status" => 1])) {
            $this->db->insert('trip_expenses', ['trip_id' => $trip_id, "trip_expense_name" => "Extra Expense", "trip_expense_amount" => $data['trip_total_expense']]);
            return true;
        }
    }
    public function update_step($data)
    {
        $resp = false;
        $this->db->where('trip_details_id', $data['trip_details_id']);
        if ($this->db->update('trip_details', $data)) {
            $resp = true;
        }
        return $resp;
    }

    public function get_driver_by_trip_id($trip_id)
    {
        $r = false;
        $this->db->select('driver_id');
        $this->db->where('trip_id', $trip_id);
        $query = $this->db->get('trip');
        if ($query->num_rows() != 0) {
            $r = $query->row()->driver_id;
        }
        return $r;
    }

    public function receive_payment($post)
    {
        if ($this->db->insert('payment_received', $post)) {
            return true;
        }
    }

    public function is_any_active_step($trip_id)
    {
        $this->db->where('trip_id', $trip_id);
        $this->db->where('trip_detail_status', 2);
        if ($this->db->get('trip_details')->num_rows() == 0) {
            return true;
        }
    }

    public function add_trip_expenses($data)
    {
        $r = false;
        if ($this->db->insert('trip_expenses', $data)) {
            $r = true;
        }

        return $r;
    }

    public function add_diesel($object)
    {
        if($this->db->insert('diesel', $object)){
            return true;
        }
    }

    public function end_trip($post)
    {
        $post['trip_status'] = 1;
        $this->db->where('trip_id', $post['trip_id']);
        if($this->db->update('trip', $post)){
            return true;
        }       
        
    }

    public function carry_forward_diesel($vehicle_id)
    {
        // $this->db->select('closing_diesel');        
        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->order_by('trip_end_date', 'desc');
        return $this->db->get('trip')->row_array()['closing_diesel'];
    }

    public function closing_bal($vehicle_id)
    {
        // $this->db->select('closing_bal');        
        $this->db->where('vehicle_id', $vehicle_id);
        $this->db->order_by('trip_end_date', 'desc');
        return $this->db->get('trip')->row_array()['closing_bal'];
    }

}
