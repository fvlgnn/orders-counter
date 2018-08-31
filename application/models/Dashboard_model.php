<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Dashboard model
     * @author @fvlgnn <fvlgnn@gmail.com>
     * @date 28th Aug, 2018
     */

class Dashboard_model extends CI_Model {

    public function getOrders() {
        $query = $this->db->order_by("type ASC, name ASC")->get('orders');
        return $query->result(); 
    }

    public function getOrder($item, $destination, $shift, $date) {
        $query = $this->db
            ->where('item',$item)
            ->where('destination', $destination)
            ->where('shift',$shift)
            ->where('date',$date)
            ->get('orders');
        return $query->row();
    }

    public function getItems() {
        $query = $this->db->order_by("type ASC, name ASC")->get('items');
        return $query->result(); 
    }

    public function getItem($id) {
        $query = $this->db->where('id',$id)->get('items');
        return $query->row(); 
    }

    public function getTypes() {
        $query = $this->db->order_by("name ASC")->get('types');
        return $query->result(); 
    }

    public function getItemsType(){
        $this->db->select('items.id, items.name, items.type, types.name as typeName', false);
        $this->db->from('items');
        $this->db->join('types', 'items.type = types.id');
        $this->db->order_by('types.name ASC, items.name ASC');
        $query = $this->db->get();
        return $query->result(); 
    }

    public function submitOrder($data) {
        if(isset($data->total)) {
            $this->db->where('id', $data->id);
            $this->db->update('orders', $data);
        } 
        else {
            $this->db->insert('orders', $data);
        }
        return true;
    }

}