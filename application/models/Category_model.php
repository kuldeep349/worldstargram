<?php

class Category_model extends CI_Model {

    public function __construct() { 
        $this->load->database();
    }

    public function get_categories() {
        $this->db->select('id,level,parent_id,category_name,category_slug,homeview,youtube_url');
        $query = $this->db->get('tbl_categories');
        return $query->result_array();
    }
    public function get_homepage_categories() {
        $this->db->select('id,level,parent_id,category_name,category_slug,homeview');
        $query = $this->db->get_where('tbl_categories', array('homeview' => 1));
        return $query->result_array();
    }
    public function search_categories($id) {
        $this->db->select('id,level,parent_id,category_name,category_slug,homeview');
        $query = $this->db->get_where('tbl_categories', array('parent_id'=> $id));
        return $query->result_array();
    }

    public function add_level1($data) {
        $this->db->insert('tbl_categories', $data);
        return $this->db->insert_id();
    }
    public function check_slug($category_slug) {
        $this->db->select('category_slug');
        $query = $this->db->get_where('tbl_categories', array('category_slug' => $category_slug));
        return $query->row_array();
    }
    public function check_parent($category_id) {
        $this->db->select('count(*) as sub_categories');
        $query = $this->db->get_where('tbl_categories', array('parent_id' => $category_id));
        return $query->row_array();
    }
     public function delete_category($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_categories');
        return $this->db->affected_rows() > 0;
    }
    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_categories', $data);
        
    }
    public function get_categories_details($id) {
        $this->db->select('id,category_name,youtube_url');
        $query = $this->db->get_where('tbl_categories',array('id'=> $id));
        return $query->row_array();
    }
}
