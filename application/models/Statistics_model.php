<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Statistics model
     * @author @fvlgnn <fvlgnn@gmail.com>
     * @date 28th Aug, 2018
     */

class Statistics_model extends CI_Model {

    public function getLastOrders() {
        $past_date = date('Y-m-d', strtotime('-14 days'));
        $query = $this->db->where('date >',$past_date)->order_by('date')->get('orders');
        return $query->result();
        // return $query->result_array();
    }

    public function getDayOrders($date) {
        $query = $this->db
            ->select('orders.*, items.name', false)
            ->where('date',$date)
            ->join('items', 'orders.item = items.id')
            ->order_by('orders.item, orders.destination, orders.shift')
            ->get('orders');
        return $query->result();
    }


    public function getOrders($destination, $shift, $date) {
        $query = $this->db
            ->where('destination', $destination)
            ->where('shift',$shift)
            ->where('date',$date)
            ->get('orders');
        return $query->result();
    }

}