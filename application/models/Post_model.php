<?php

class Post_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function add_image($data) {
        $this->db->insert('tbl_posts', $data);
        return $this->db->insert_id();
    }

    public function get_posts($category_id) {
        $this->db->select('tbl_posts.*, (IF(tbl_voting.post_id IS NOT NULL,1,0)) as postlike,tbl_voting.vote_type,tbl_users.username, count(tbl_voting.vote_type) as views,');
        $this->db->group_by('tbl_posts.id');
        $this->db->from('tbl_posts');
        $this->db->join('tbl_users', 'tbl_posts.user_id = tbl_users.id');
        $this->db->join('tbl_voting', 'tbl_posts.id=tbl_voting.post_id and tbl_voting.user_id=1', 'LEFT');
        $this->db->where(array('tbl_posts.category_id' => $category_id, 'tbl_posts.status' => 1));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_posts($category_id) {
        $this->db->select('tbl_posts.*, count(tbl_voting.post_id) as count,tbl_categories.category_name,tbl_users.username');
        $this->db->group_by('tbl_posts.id');
        $this->db->from('tbl_posts');
        $this->db->join('tbl_users', 'tbl_posts.user_id = tbl_users.id');
        $this->db->join('tbl_voting', 'tbl_posts.id = tbl_voting.post_id', 'LEFT');
        $this->db->join('tbl_categories', 'tbl_posts.category_id = tbl_categories.id', 'INNER');
        $this->db->where('tbl_posts.category_id', $category_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user_post($user_id) {
        $this->db->select('tbl_posts.*,tbl_categories.category_name,tbl_users.username');
        $this->db->group_by('tbl_posts.id');
        $this->db->from('tbl_posts');
        $this->db->join('tbl_users', 'tbl_posts.user_id = tbl_users.id');
        $this->db->join('tbl_categories', 'tbl_posts.category_id = tbl_categories.id', 'INNER');
        $this->db->where('tbl_posts.user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function vote($data) {
        $this->db->insert('tbl_voting', $data);
        return $this->db->insert_id();
    }

    public function add_comment($data) {
        $this->db->insert('tbl_comments', $data);
        return $this->db->insert_id();
    }

    public function count_votes($post_id) {
        $this->db->select('count(tbl_voting.vote_type) as vote_count,tbl_voting.vote_type');
        $this->db->group_by('tbl_voting.vote_type');
        $this->db->from('tbl_posts');
        $this->db->join('tbl_voting', 'tbl_posts.id = tbl_voting.post_id', 'LEFT');
        $this->db->where('tbl_posts.id', $post_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_post_details($post_id) {
        $user_id = (is_loggedin() ? decrypt($_SESSION['user_id']) : '0');
        $this->db->select('tbl_posts.*,tbl_users.username,tbl_categories.category_name,,IF(`tbl_voting`.`id` IS NULL, 0, tbl_voting.vote_type) as `my_vote`');
        $this->db->from('tbl_posts');
        $this->db->join('tbl_users', 'tbl_posts.user_id = tbl_users.id');
        $this->db->join('tbl_categories', 'tbl_posts.category_id = tbl_categories.id');
        $this->db->join('tbl_voting', 'tbl_voting.post_id = tbl_posts.id AND tbl_voting.user_id = ' . $user_id, 'LEFT');
        $this->db->where('tbl_posts.id', $post_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_post_comments($post_id) {
        $this->db->select('tbl_comments.id,tbl_comments.comment,tbl_comments.user_id, tbl_comments.created_at ,tbl_users.username ,tbl_users.image');
        $this->db->from('tbl_comments');
        $this->db->join('tbl_users', 'tbl_comments.user_id = tbl_users.id');
        $this->db->where('tbl_comments.post_id', $post_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function check_voting_status($data) {
        $this->db->select('vote_type,id');
        $query = $this->db->get_where('tbl_voting', $data);
        return $query->row_array();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_posts', $data);
    }

    public function update_vote($id, $votetype) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_voting', array('vote_type' => $votetype));
    }

    public function update_comment($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('tbl_comments', $data);
    }

    public function delete_comment($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_comments');
    }

    public function delete_multiple_comments($id) {
        $this->db->where('post_id', $id);
        return $this->db->delete('tbl_comments');
    }

    public function delete_activity($id) {
        $this->db->where('post_id', $id);
        return $this->db->delete('tbl_activities');
    }

    public function delete_votes($id) {
        $this->db->where('post_id', $id);
        return $this->db->delete('tbl_voting');
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('tbl_posts');
    }

    public function delete_post($id) {
        $sql = "    delete tbl_posts.*,tbl_voting.*,tbl_comments.*,tbl_activities.* from tbl_posts
LEFT JOIN tbl_voting on tbl_posts.id = tbl_voting.post_id 
LEFT JOIN tbl_comments on tbl_posts.id = tbl_comments.post_id 
LEFT JOIN tbl_activities on tbl_posts.id = tbl_activities.remark_id where tbl_posts.id =" . $id;
        return $this->db->query($sql, array($id));
    }

}
