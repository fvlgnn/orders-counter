<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * User model
     * @author @fvlgnn <fvlgnn@gmail.com>
     * @date 28th Aug, 2018
     */

class User_model extends CI_Model {
    
    public function getUser($id)
    {
        $query = $this->db->where('id', $id)->get('users');
        return $query->row();
    }

    public function getUsers()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function getLogin($email)
    {
        $query = $this->db->where('email', $email)->get('users');
        return $query->row();
    }

    public function insertUser($data)
    {
        $this->db->insert('users', $data);
    }

    public function updateUser($data){
        $this->db->where('email', $data['email']);
        $this->db->update('users', $data);
        if($this->db->affected_rows()){
            return $this->db->get('users')->row()->id;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $this->db->delete('users', array('id' => $id));
        return true;
    }

}