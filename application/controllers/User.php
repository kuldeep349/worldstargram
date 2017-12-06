<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|mp4';
        $config['max_size'] = 0;
        $config['file_name'] = 'image' . time();
        $this->load->library('upload', $config);
        $this->load->library(array('session', 'encrypt', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('user_model', 'category_model', 'activity_model'));
    }

    public function index() {
        if (is_loggedin() && is_admin()) {
            $data = array();
            $data['users'] = $this->user_model->get_users();
            $this->load->view('dashboard/users', $data);
        } else {
            redirect('/User/login');
        }
    }

    public function login() {
        if (is_loggedin() === true) {
            redirect('/Dashboard');
        } else {
            if ($this->input->is_ajax_request()) {
                $response = array();
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Email', 'Email', 'required');
                $this->form_validation->set_rules('Password', 'Password', 'required');
                if ($this->form_validation->run() === false) {
                    $response['error'] = 'Please fill proper email/password';
                    $response['success'] = 0;
                } else {
                    $email = $this->input->post('Email');
                    $password = $this->input->post('Password');
                    //echo'<pre>';print_r($this->input->post());echo'</pre>';
                    if ($this->user_model->check_login($email, $password) == TRUE) {
                        $userinfo = $this->user_model->check_login($email, $password);
                        $_SESSION['user_id'] = encrypt($userinfo['id']);
                        $_SESSION['logged_in'] = (bool) true;
                        $redirect_to = $this->input->post('redirect_url');
                        $response['user_info'] = $userinfo;
                        $response['success'] = 1;
                        if ($userinfo['role'] == 'A')
                            $response['url'] = base_url('Dashboard');
                        else
                            $response['url'] = base_url('User/home');
                    } else {
                        $response['success'] = 0;
                        $response['error'] = 'Incorrect Email/Password';
                    }
                }
                echo json_encode($response);
            } else {
                $this->load->view('login');
            }
        }
    }

    public function register() {
        if (is_loggedin() === true) {
            redirect('/Dashboard');
        } else {
            if ($this->input->is_ajax_request()) {
                $response = array();
                $this->load->library('form_validation');
                $this->form_validation->set_rules('Email', 'Email', 'required|valid_email|is_unique[tbl_users.email]');
                $this->form_validation->set_rules('Password', 'Password', 'required');
                $this->form_validation->set_rules('Username', 'Username', 'required');
                $this->form_validation->set_rules('Name', 'Name', 'required');
                $this->form_validation->set_rules('role', 'role', 'required');
                if ($this->form_validation->run() === false) {
                    $response['message'] = 'Please fill all Fields correctly';
                    $response['array'] = $this->form_validation->run();
                    $response['success'] = 0;
                } else {
                    $data = array(
                        'username' => $this->input->post('Username'),
                        'email' => $this->input->post('Email'),
                        'password' => $this->input->post('Password'),
                        'name' => $this->input->post('Name'),
                        'status' => 1,
                        'role' => $this->input->post('role'),
                        'created_at' => date("Y-m-d h:i:sa")
                    );
                    //echo'<pre>';print_r($this->input->post());echo'</pre>';
                    $res = $this->user_model->add($data);
                    if ($res == FALSE) {
                        $response['success'] = 0;
                        $response['message'] = 'Error while registration Please try again';
                    } else {

                        $response['success'] = 1;
                        $response['message'] = 'Registered successfully';
                        $_SESSION['user_id'] = encrypt($res);
                        $_SESSION['logged_in'] = (bool) true;
                    }
                }
                echo json_encode($response);
            } else {
                $this->load->view('register');
            }
        }
    }

    public function Signout() {
        if (is_loggedin() === true) {
            foreach ($_SESSION as $key => $value) {
                unset($_SESSION[$key]);
            }
            redirect('/Dashboard');
        } else {
            redirect('/User/login');
        }
    }

//    public function update_profile(){
//        
//    }
    public function Profile() {
        if (is_loggedin() === true) {
            $data = array();
            if ($this->input->post('name')) {
                $data = array('name' => $this->input->post('name'), 'profile_video' => $this->input->post('profile_video'));
                $userdetails = userdetails();
                $res = $this->user_model->update($userdetails['id'], $data);
                if ($res == FALSE) {
                    $this->session->set_flashdata('update_message', 'Error while updating details');
                } else {
                    $activty_data = array(
                        'type' => 'user',
                        'user_id' => decrypt($_SESSION['user_id']),
                        'remark' => ' Updates details',
                        'post_id' => $res,
                        'created_at' => date("Y-m-d h:i:sa")
                    );
                    $activity = $this->activity_model->add($activty_data);
                    $this->session->set_flashdata('update_message', 'Details Updated successfully');
                }
            }
            $activities = $this->activity_model->get_user_posts();
            $templevel = 0;
            $newkey = 0;
            $grouparr[$templevel] = "";
            foreach ($activities as $key => $val) {
                if ($templevel == $val['date']) {
                    $grouparr[$templevel][$newkey] = $val;
                } else {
                    $grouparr[$val['date']][$newkey] = $val;
                }
                $newkey++;
            }
            $data['activities'] = $grouparr;

            $activities1 = $this->activity_model->get_user_posts('user');
            $templevel1 = 0;
            $newkey1 = 0;
            $grouparr1[$templevel] = "";
            foreach ($activities1 as $key1 => $val1) {
                if ($templevel1 == $val1['date']) {
                    $grouparr1[$templevel1][$newkey1] = $val1;
                } else {
                    $grouparr1[$val1['date']][$newkey1] = $val1;
                }
                $newkey1++;
            }
            $data['user_activities'] = $grouparr1;

            $this->load->view('dashboard/profile', $data);
        } else {
            redirect('/User/login');
        }
    }

    public function update_status($id = false) {
        if (is_loggedin() === true && is_admin()) {
            $response = array();
            $status = $this->input->post('status');
            $data = array('status' => $status);
            $res = $this->user_model->update($id, $data);
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while Upating status Please try again';
            } else {
                $html = '';
                if ($status == 0) {
                    $html .= '<button id = "btn' . $id . '" type="button" class="btn btn-success stsbtn" data-url=' . base_url('User/update_status/' . $id) . ' data-status=1 > Allow</button>';
                } else {
                    $html .= '<button  id = "btn' . $id . '"type="button" class="btn btn-danger stsbtn" data-url=' . base_url('User/update_status/' . $id) . ' data-status=0 > Block</button>';
                }
                $response['success'] = 1;
                $response['message'] = 'User Updated successfully';
                $response['html'] = $html;
            }
            $response['id'] = decrypt($id);

            echo json_encode($response);
        } else {
            redirect('/User/login');
        }
    }

    public function update_password($id = false) {
        if (is_loggedin() === true) {
            $response = array();
            $password = $this->input->post('npassword');
            $data = array('password' => $password);
            $res = $this->user_model->update(decrypt($id), $data);
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while Upating Pasword Please try again';
            } else {
                $activty_data = array(
                    'type' => 'user',
                    'user_id' => decrypt($_SESSION['user_id']),
                    'remark' => ' Updated password',
                    'post_id' => $res,
                    'created_at' => date("Y-m-d h:i:sa")
                );
                $activity = $this->activity_model->add($activty_data);
                $response['success'] = 1;
                $response['message'] = 'Password Updated successfully';
            }

            echo json_encode($response);
            exit();
        } else {
            redirect('/User/login');
        }
    }

    public function update_profile_video($id = false) {
        if (is_loggedin() === true) {
            $response = array();
            $profile_video = $this->input->post('profile_video');
            $data = array('profile_video' => $profile_video);
            $res = $this->user_model->update(decrypt($id), $data);
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while Upating Your profile video';
            } else {
                $response['success'] = 1;
                $response['message'] = 'Your Profile updated successfully';
            }
            echo json_encode($response);
        } else {
            redirect('/User/login');
        }
    }

    public function update_user_image($id = false) {
        if (is_loggedin() === true) {
            if ($this->input->is_ajax_request()) {
                $response = array();
                $this->form_validation->set_rules('user_image', 'text', 'required');
//                $this->form_validation->set_rules('post_description', 'text', 'required');

                if ($this->upload->do_upload('user_image')) {
//                pr($this->upload->data());
                    $image_data = array('upload_data' => $this->upload->data());
                    $data['image'] = $image_data['upload_data']['file_name'];
                    $data = array(
                        'image' => $image_data['upload_data']['file_name']
                    );
                    $res = $this->user_model->update(decrypt($id), $data);
                    if ($res == FALSE) {
                        $response['success'] = 0;
                        $response['message'] = 'Error while uploding image Please try again';
                    } else {
                        $activty_data = array(
                            'type' => 'user',
                            'user_id' => decrypt($_SESSION['user_id']),
                            'remark' => ' Updated profile image',
                            'post_id' => $res,
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $activity = $this->activity_model->add($activty_data);
                        $response['success'] = 1;
                        $response['message'] = 'image uploaded successfully';
                        $response['image'] = $image_data['upload_data']['file_name'];
                    }
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    $response['success'] = 0;
                    $response['message'] = $error;
                }
                echo json_encode($response);
            } else {
                $this->load->view('dashboard/add_video');
            }
        } else {
            redirect('/User/login');
        }
    }

    public function home() {
        if (is_loggedin() === true) {
            $data = array();
            if ($this->input->post('name')) {
                $data = array('name' => $this->input->post('name'), 'profile_video' => $this->input->post('profile_video'));
                $userdetails = userdetails();
                $res = $this->user_model->update($userdetails['id'], $data);
                if ($res == FALSE) {
                    $this->session->set_flashdata('update_message', 'Error while updating details');
                } else {
                    $activty_data = array(
                        'type' => 'user',
                        'user_id' => decrypt($_SESSION['user_id']),
                        'remark' => ' Updates details',
                        'post_id' => $res,
                        'created_at' => date("Y-m-d h:i:sa")
                    );
                    $activity = $this->activity_model->add($activty_data);
                    $this->session->set_flashdata('update_message', 'Details Updated successfully');
                }
            }
            $activities = $this->activity_model->get_user_posts();
            $templevel = 0;
            $newkey = 0;
            $grouparr[$templevel] = "";
            foreach ($activities as $key => $val) {
                if ($templevel == $val['date']) {
                    $grouparr[$templevel][$newkey] = $val;
                } else {
                    $grouparr[$val['date']][$newkey] = $val;
                }
                $newkey++;
            }
            $data['activities'] = $grouparr;
            $data['users'] = $this->user_model->get_users();
            $this->load->view('home', $data);
        } else {
            redirect('/User/login');
        }
    }

    public function timeline($id = false) {
        if (is_loggedin() === true) {
            $data = array();
            $data['other_user_id'] = $id;
//            pr($data,true);
            $activities = $this->activity_model->get_user_posts(0,5,'post',decrypt($id));
            $templevel = 0;
            $newkey = 0;
            $grouparr[$templevel] = "";
            foreach ($activities as $key => $val) {
                if ($templevel == $val['date']) {
                    $grouparr[$templevel][$newkey] = $val;
                } else {
                    $grouparr[$val['date']][$newkey] = $val;
                }
                $newkey++;
            }
            $data['activities'] = $grouparr;
            //pr($data);
            $data['users'] = $this->user_model->get_users();
            $this->load->view('timeline', $data);
        } else {
            redirect('/User/login');
        }
    }

}
