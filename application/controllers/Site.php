<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('encrypt', 'parser', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('Category_model', 'Post_model'));
    }

    public function index() {
        $data = array();
        $postcategories = $this->Category_model->get_homepage_categories();
        foreach ($postcategories as $key => $postcategory) {
            $posts = $this->Post_model->get_posts($postcategory['id']);
            $data['categories'][$key]['id'] = encrypt($postcategory['id']);
            $data['categories'][$key]['category_name'] = $postcategory['category_name'];
            $data['categories'][$key]['posts'] = $posts;
        } 
        $this->load->view('index',$data);
    }
    
    public function posts($id = false){
        $data = array();
        $data['category'] = $this->Category_model->get_categories_details(decrypt($id));
        $data['posts'] = $this->Post_model->get_posts(decrypt($id));
        $this->load->view('posts',$data);
    }

    public function charts() {
        $this->load->view('charts');
    }

    public function comedy() {
        $this->load->view('comedy');
    }

}
