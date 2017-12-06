<?php

class User_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function check_login($email, $password) {
        $this->db->select('id,email,password,username,role');
        $query = $this->db->get_where('tbl_users', array('email' => $email, 'password' => $password));
        return $query->row_array();
    }
    public function add($data) {
        $this->db->insert('tbl_users', $data);
        return $this->db->insert_id();
    }
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_users', $data);
    }
    public function get_user($id){
        $this->db->select('*');
        $query = $this->db->get_where('tbl_users',array('id' => $id));
        return $query->row_array();
    }
    public function get_users(){
        //SELECT tbl_users.*,count(tbl_posts.id) as post_count FROM `tbl_users` LEFT JOIN tbl_posts on tbl_posts.user_id = tbl_users.id group by tbl_users.id
        $this->db->select('tbl_users.*,count(tbl_posts.id) as post_count');
        $this->db->group_by('tbl_users.id');
        $this->db->from('tbl_users');
        $this->db->join('tbl_posts', 'tbl_posts.user_id = tbl_users.id', 'LEFT');
        $this->db->where('tbl_users.role', 'C');
        $query = $this->db->get();
        return $query->result_array();
    }
    
}