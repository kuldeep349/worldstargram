<?php

class PostCategory_model extends CI_Model {

    public function __construct() { 
        $this->load->database();
    }

    public function get_post_categories() {
        $this->db->select('id,category_name');
        $query = $this->db->get('tbl_post_categories');
        return $query->result_array();
    }
    public function get_post_categories_details($id) {
        $this->db->select('id,category_name');
        $query = $this->db->get_where('tbl_post_categories',array('id'=> $id));
        return $query->row_array();
    }
    
}
