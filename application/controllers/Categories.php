<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('encrypt', 'parser', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model('category_model');
    }

    public function index() {
        if (is_loggedin() && is_admin()) {
            $data = array();
            $categories = $this->category_model->get_categories();
            $level1 = array();
            $level2 = array();
            $level3 = array();

            foreach ($categories as $key => $category) {
                if ($category['level'] == 1) {
                    $level1[$key] = $category;
                }
                if ($category['level'] == 2) {
                    $level2[$key] = $category;
                }
                if ($category['level'] == 3) {
                    $level3[$key] = $category;
                }
            }

            foreach ($level2 as $key => $l2) {
                foreach ($categories as $k => $category) {
                    if ($category['parent_id'] == $l2['id']) {
                        $level2[$key]['level3'][$k] = $category;
                    }
                }
            }

            foreach ($level1 as $key => $l1) {
                foreach ($level2 as $k => $l2) {
                    if ($l2['parent_id'] == $l1['id']) {
                        $level1[$key]['level2'][$k] = $l2;
                    }
                }
            }
            $data['categories'] = $level1;
            $this->load->view('dashboard/categories', $data);
        } else {
            redirect('/User/login');
        }
    }

    public function create_level1() {
        $data = array();
        if (is_loggedin() && is_admin()) {
            if ($this->input->is_ajax_request()) {
                $this->form_validation->set_rules('menu_name', 'text', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {

                    $slug = url_title($this->input->post('menu_name'), 'underscore', TRUE);
                    $slug_available = $this->category_model->check_slug($slug);
                    if ($slug_available) {
                        $response['success'] = 0;
                        $response['message'] = 'This Category is Already Exists';
                    } else {
                        $data = array(
                            'category_name' => ucwords($this->input->post('menu_name')),
                            'category_slug' => $slug,
                            'level' => 1,
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $res = $this->category_model->add_level1($data);
                        if ($res == FALSE) {
                            $response['success'] = 0;
                            $response['message'] = 'Error while adding Menu Please try again';
                        } else {

                            $response['success'] = 1;
                            $response['message'] = 'Menu added successfully';
                            $response['menu_id'] = encrypt($res);
                        }
                    }
                }
                echo json_encode($response);
            }
        } else {
            redirect('/User/login');
        }
    }
    public function create_level2() {
        $data = array();
        if (is_loggedin() && is_admin()) {
            if ($this->input->is_ajax_request()) {
                $this->form_validation->set_rules('menu_name', 'text', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {

                    $slug = url_title($this->input->post('menu_name'), 'underscore', TRUE);
                    $slug_available = $this->category_model->check_slug($slug);
                    if ($slug_available) {
                        $response['success'] = 0;
                        $response['message'] = 'This Category is Already Exists';
                    } else {
                        $data = array(
                            'category_name' => ucwords($this->input->post('menu_name')),
                            'category_slug' => $slug,
                            'level' => 2,
                            'parent_id' => $this->input->post('parent_id'),
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $res = $this->category_model->add_level1($data);
                        if ($res == FALSE) {
                            $response['success'] = 0;
                            $response['message'] = 'Error while adding Menu Please try again';
                        } else {

                            $response['success'] = 1;
                            $response['message'] = 'Menu added successfully';
                            $response['menu_id'] = encrypt($res);
                        }
                    }
                }
                echo json_encode($response);
            }
        } else {
            redirect('/User/login');
        }
    }
    public function create_level3() {
        $data = array();
        if (is_loggedin() && is_admin()) {
            if ($this->input->is_ajax_request()) {
                $this->form_validation->set_rules('menu_name', 'text', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {

                    $slug = url_title($this->input->post('menu_name'), 'underscore', TRUE);
                    $slug_available = $this->category_model->check_slug($slug);
                    if ($slug_available) {
                        $response['success'] = 0;
                        $response['message'] = 'This Category is Already Exists';
                    } else {
                        $data = array(
                            'category_name' => ucwords($this->input->post('menu_name')),
                            'category_slug' => $slug,
                            'level' => 3,
                            'parent_id' => $this->input->post('parent_id'),
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $res = $this->category_model->add_level1($data);
                        if ($res == FALSE) {
                            $response['success'] = 0;
                            $response['message'] = 'Error while adding Menu Please try again';
                        } else {

                            $response['success'] = 1;
                            $response['message'] = 'Menu added successfully';
                            $response['menu_id'] = encrypt($res);
                        }
                    }
                }
                echo json_encode($response);
            }
        } else {
            redirect('/User/login');
        }
    }
    
    public function get_level2_categories($id = false){
        $response = array();
//        echo decrypt($id);
        $sub_categories = $this->category_model->search_categories(($id));
        echo json_encode($sub_categories);
        exit();
        
    }
    public function delete_category($id = false) {
        $response = array();
        $sub_categories = $this->category_model->check_parent($id);
        if ($sub_categories['sub_categories'] > 0) {
            $response['success'] = 0;
            $response['message'] = 'This menu have ' . $sub_categories['sub_categories'] . ' Submenu ! Please delete these menus first';
        } else {
            $res = $this->category_model->delete_category(($id));
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while deleting category Please try again';
            } else {
                $response['response'] = $res;
                $response['success'] = 1;
                $response['message'] = 'category deleted successfully';
            }
        }
        echo json_encode($response);
    }

    public function get_categories() {
        if (is_loggedin()) {
            $data = array();
            $categories = $this->category_model->get_categories();
            $level1 = array();
            $level2 = array();
            $level3 = array();

            foreach ($categories as $key => $category) {
                if ($category['level'] == 1) {
                    $level1[$key] = $category;
                }
                if ($category['level'] == 2) {
                    $level2[$key] = $category;
                }
                if ($category['level'] == 3) {
                    $level3[$key] = $category;
                }
            }

            foreach ($level2 as $key => $l2) {
                foreach ($categories as $k => $category) {
                    if ($category['parent_id'] == $l2['id']) {
                        $level2[$key]['level3'][$k] = $category;
                    }
                }
            }

            foreach ($level1 as $key => $l1) {
                foreach ($level2 as $k => $l2) {
                    if ($l2['parent_id'] == $l1['id']) {
                        $level1[$key]['level2'][$k] = $l2;
                    }
                }
            }
            $data['categories'] = $level1;
            echo json_encode($data, TRUE);
            exit();
        }
    }
    public function update_menu(){
        if (is_loggedin() && is_admin()) {
            if ($this->input->is_ajax_request()) {
                $this->form_validation->set_rules('menu_name', 'text', 'required');
                $homeview =  ($this->input->post('homeview') == 'on' ? 1 : 0);
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {

                    $slug = url_title($this->input->post('menu_name'), 'underscore', TRUE);
//                    $slug_available = $this->category_model->check_slug($slug);
//                    if ($slug_available) {
//                        $response['success'] = 0;
//                        $response['message'] = 'This Category is Already Exists';
//                    } else {
                        $data = array(
                            'category_name' => ucwords($this->input->post('menu_name')),
                            'category_slug' => $slug,
                            'homeview' => $homeview,
                            'youtube_url' => $this->input->post('youtube_url'),
                            'parent_id' => $this->input->post('parent_id'),
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $id = $this->input->post('id');
                        $res = $this->category_model->update($id,$data);
                        if ($res == FALSE) {
                            $response['success'] = 0;
                            $response['message'] = 'Error while adding Menu Please try again';
                        } else {

                            $response['success'] = 1;
                            $response['message'] = 'Menu updated successfully';
                            $response['menu_id'] = ($res);
                        }
//                    }
                }
                echo json_encode($response);
            }
        } else {
            redirect('/User/login');
        }
    }
}
