<?php

class Activity_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function add($data) {
        $this->db->insert('tbl_activities', $data);
        return $this->db->insert_id();
    }

    public function get($startrec = false,$limit  = false,$type = 'post') {
        $user_id = decrypt($_SESSION['user_id']);
        $this->db->select('tbl_activities.*,date(tbl_activities.created_at) as date,tbl_users.username');
        $this->db->order_by("date", "desc");
        $this->db->from('tbl_activities');
        $this->db->join('tbl_users', 'tbl_activities.user_id = tbl_users.id');
        $this->db->limit($limit, $startrec);
        $this->db->where(array('type' => $type));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user_posts($startrec = 0,$limit  = 5,$type = 'post',$id = false) {
        if($id == false){
            $id = decrypt($_SESSION['user_id']);            
        }
        $this->db->select('tbl_activities.*,date(tbl_activities.created_at) as date,tbl_users.username');
        $this->db->order_by("tbl_activities.id", "desc");;
        $this->db->from('tbl_activities');
        $this->db->join('tbl_users', 'tbl_activities.user_id = tbl_users.id');
        $this->db->limit($limit, $startrec);
        $this->db->where(array('tbl_activities.user_id'=> $id,'type' => $type));
        $query = $this->db->get();
        return $query->result_array();
    }

}
