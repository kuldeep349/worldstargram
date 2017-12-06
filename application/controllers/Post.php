<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|mp4';
        $config['max_size'] = 0;
        $config['file_name'] = 'image' . time();
        $this->load->library('upload', $config);
        $this->load->library(array('session', 'encrypt', 'form_validation'));
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('post_model', 'activity_model'));
    }

    public function posts_list($id = false) {
        $data = array();
        if (is_loggedin()) {
            $data = array();
            $data['posts'] = $this->post_model->get_all_posts(decrypt($id));
            $this->load->view('dashboard/manage_posts', $data);
        } else {
            redirect('/User/login');
        }
    }

    public function posts($id = false) {
        $data = array();
        if (is_loggedin()) {
            $data = array();
            $data['posts'] = $this->post_model->get_user_post(decrypt($id));
            $this->load->view('dashboard/my_posts', $data);
        } else {
            redirect('/User/login');
        }
    }

    public function view($id = false) {
        if (is_loggedin() === true) {
            $data = array();
            $data['post'] = $this->post_model->get_post_details(decrypt($id));
            $data['category_posts'] = $this->post_model->get_all_posts($data['post']['category_id']);
            $this->load->view('post', $data);
        } else {
            redirect('/User/login');
        }
    }

//    public function view($id = false) {
//        if (is_loggedin() === true) {
//            $data = array();
//            $data['post'] = $this->post_model->get_post_details(decrypt($id));
//            $this->load->view('dashboard/postview', $data);
//        } else {
//            redirect('/User/login');
//        }
//    }

    public function Update($id = false) {
        if (is_loggedin() === true) {
            $data = array();
            $data['post'] = $this->post_model->get_post_details(decrypt($id));
            $this->load->view('dashboard/update_post', $data);
        } else {
            redirect('/User/login');
        }
    }

    public function update_status($id = false, $status) {
        $data = array(
            'status' => $status
        );
        $res = $this->post_model->update(decrypt($id), $data);
        if ($res == true) {
            redirect('Post/view/' . $id);
        }
    }

    public function add_image() {
        if (is_loggedin() === true) {
            if ($this->input->is_ajax_request()) {
                $response = array();
                $this->form_validation->set_rules('post_title', 'text', 'required');
                $this->form_validation->set_rules('post_description', 'text', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {
                    if ($this->upload->do_upload('image_file')) {
                        $image_data = array('upload_data' => $this->upload->data());
                        $data['image'] = $image_data['upload_data']['file_name'];
                        $data = array(
                            'post_title' => $this->input->post('post_title'),
                            'post_description' => $this->input->post('post_description'),
                            'post_type' => 'main',
                            'media_type' => 'image',
                            'path' => $image_data['upload_data']['file_name'],
                            'user_id' => decrypt($_SESSION['user_id']),
                            'category_id' => $this->input->post('parent_id'),
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $res = $this->post_model->add_image($data);
                        if ($res == FALSE) {
                            $response['success'] = 0;
                            $response['message'] = 'Error while uploding image Please try again';
                        } else {
                            $user_data = userdetails();
                            $activty_data = array(
                                'type' => 'post',
                                'user_id' => decrypt($_SESSION['user_id']),
                                'remark' => ' added a new image',
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
                }
                echo json_encode($response);
            } else {
                $this->load->view('dashboard/add_image');
            }
        } else {
            redirect('/User/login');
        }
    }

    public function update_image($id = false) {
        if (is_loggedin() === true) {
//            if ($this->input->is_ajax_request()) {
            $response = array();
            $this->form_validation->set_rules('post_title', 'text', 'required');
            $this->form_validation->set_rules('post_description', 'text', 'required');
            if ($this->form_validation->run() == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'PLease fill all fields';
            } else {
                if (($_FILES['image_file']['error'] == 0)) {
                    if ($this->upload->do_upload('image_file')) {
                        $image_data = array('upload_data' => $this->upload->data());
                        $data['image'] = $image_data['upload_data']['file_name'];
                        $data = array(
                            'post_title' => $this->input->post('post_title'),
                            'post_description' => $this->input->post('post_description'),
                            'path' => $image_data['upload_data']['file_name'],
                            'category_id' => $this->input->post('parent_id'),
                            'status' => 0
                        );
                        $res = $this->post_model->update(decrypt($id), $data);
                        if ($res == FALSE) {
                            $response['success'] = 0;
                            $response['message'] = 'Error while updarting post Please try again';
                        } else {
                            $response['success'] = 1;
                            $response['message'] = 'post updated successfully';
                            $response['image'] = $image_data['upload_data']['file_name'];
                        }
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        $response['success'] = 0;
                        $response['message'] = $error;
                    }
                } else {
                    $data = array(
                        'post_title' => $this->input->post('post_title'),
                        'post_description' => $this->input->post('post_description'),
                        'category_id' => $this->input->post('parent_id'),
                        'status' => 0
                    );
                    $res = $this->post_model->update(decrypt($id), $data);
                    if ($res == FALSE) {
                        $response['success'] = 0;
                        $response['message'] = 'Error while uploding image Please try again';
                    } else {
                        $response['success'] = 1;
                        $response['message'] = 'image uploaded successfully';
                    }
                }
            }
            echo json_encode($response);
//            } else {
//                $this->load->view('dashboard/add_image');
//            }
        } else {
            redirect('/User/login');
        }
    }

    public function add_video() {
        if (is_loggedin() === true) {
            if ($this->input->is_ajax_request()) {
                $response = array();
                $this->form_validation->set_rules('post_title', 'text', 'required');
                $this->form_validation->set_rules('post_description', 'text', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {
                    if ($this->upload->do_upload('image_file')) {
                        $image_data = array('upload_data' => $this->upload->data());
                        $data['image'] = $image_data['upload_data']['file_name'];
                        $data = array(
                            'post_title' => $this->input->post('post_title'),
                            'post_description' => $this->input->post('post_description'),
                            'post_type' => 'main',
                            'media_type' => 'video',
                            'path' => $image_data['upload_data']['file_name'],
                            'user_id' => decrypt($_SESSION['user_id']),
                            'category_id' => $this->input->post('parent_id'),
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $res = $this->post_model->add_image($data);
                        if ($res == FALSE) {
                            $response['success'] = 0;
                            $response['message'] = 'Error while uploding video Please try again';
                        } else {
                            $user_data = userdetails();
                            $activty_data = array(
                                'type' => 'post',
                                'user_id' => decrypt($_SESSION['user_id']),
                                'remark' => ' added a new Video',
                                'post_id' => $res,
                                'created_at' => date("Y-m-d h:i:sa")
                            );
                            $activity = $this->activity_model->add($activty_data);

                            $response['success'] = 1;
                            $response['message'] = 'video uploaded successfully';
                            $response['image'] = $image_data['upload_data']['file_name'];
                        }
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        $response['success'] = 0;
                        $response['message'] = $error;
                    }
                }
                echo json_encode($response);
            } else {
                $this->load->view('dashboard/add_video');
            }
        } else {
            redirect('/User/login');
        }
    }

    public function add_status() {
        if (is_loggedin() === true) {
            if ($this->input->is_ajax_request()) {
                $response = array();
                $this->form_validation->set_rules('status', 'text', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {
                    $data = array(
                        'post_title' => '',
                        'post_description' => $this->input->post('status'),
                        'post_type' => 'main',
                        'media_type' => 'status',
                        'user_id' => decrypt($_SESSION['user_id']),
                        'category_id' => 33,
                        'created_at' => date("Y-m-d h:i:sa")
                    );
                    $res = $this->post_model->add_image($data);
                    if ($res == FALSE) {
                        $response['success'] = 0;
                        $response['message'] = 'Error while adding status Please try again';
                    } else {
                        $user_data = userdetails();
                        $activty_data = array(
                            'type' => 'post',
                            'user_id' => decrypt($_SESSION['user_id']),
                            'remark' => ' Updated his status',
                            'post_id' => $res,
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $activity = $this->activity_model->add($activty_data);

                        $response['success'] = 1;
                        $response['message'] = 'status successfully';
                    }
                }
                echo json_encode($response);
                exit();
            } else {
                $this->load->view('dashboard/add_youtube_video');
            }
        } else {
            redirect('/User/login');
        }
    }

    public function add_youtube_video() {
        if (is_loggedin() === true) {
            if ($this->input->is_ajax_request()) {
                $response = array();
                $this->form_validation->set_rules('post_title', 'text', 'required');
                $this->form_validation->set_rules('post_description', 'text', 'required');
                $this->form_validation->set_rules('youtube_url', 'text', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {
                    $data = array(
                        'post_title' => $this->input->post('post_title'),
                        'post_description' => $this->input->post('post_description'),
                        'post_type' => 'main',
                        'media_type' => 'youtube',
                        'path' => $this->input->post('youtube_url'),
                        'user_id' => decrypt($_SESSION['user_id']),
                        'category_id' => $this->input->post('parent_id'),
                        'created_at' => date("Y-m-d h:i:sa")
                    );
                    $res = $this->post_model->add_image($data);
                    if ($res == FALSE) {
                        $response['success'] = 0;
                        $response['message'] = 'Error while uploding video Please try again';
                    } else {
                        $user_data = userdetails();
                        $activty_data = array(
                            'type' => 'post',
                            'user_id' => decrypt($_SESSION['user_id']),
                            'remark' => ' added a new youtube post',
                            'post_id' => $res,
                            'created_at' => date("Y-m-d h:i:sa")
                        );
                        $activity = $this->activity_model->add($activty_data);

                        $response['success'] = 1;
                        $response['message'] = 'video uploaded successfully';
                    }
                }
                echo json_encode($response);
                exit();
            } else {
                $this->load->view('dashboard/add_youtube_video');
            }
        } else {
            redirect('/User/login');
        }
    }

    public function update_youtube_video($id = false) {
        if (is_loggedin() === true) {
            if ($this->input->is_ajax_request()) {
                $response = array();
                $this->form_validation->set_rules('post_title', 'text', 'required');
                $this->form_validation->set_rules('post_description', 'text', 'required');
                $this->form_validation->set_rules('youtube_url', 'text', 'required');
                if ($this->form_validation->run() == FALSE) {
                    $response['success'] = 0;
                    $response['message'] = 'PLease fill all fields';
                } else {
                    $data = array(
                        'post_title' => $this->input->post('post_title'),
                        'post_description' => $this->input->post('post_description'),
                        'path' => $this->input->post('youtube_url'),
                        'category_id' => $this->input->post('parent_id'),
                        'status' => 0
                    );
                    $res = $this->post_model->update(decrypt($id), $data);
                    if ($res == FALSE) {
                        $response['success'] = 0;
                        $response['message'] = 'Error while updating post Please try again';
                    } else {
                        $response['success'] = 1;
                        $response['message'] = 'post updated successfully';
                    }
                }
                echo json_encode($response);
                exit();
            } else {
                $this->load->view('dashboard/add_youtube_video');
            }
        } else {
            redirect('/User/login');
        }
    }

    public function vote($post_id = false, $votetype = false) {
        if (is_loggedin() === true) {
            $data = array(
                'post_id' => decrypt($post_id),
                'vote_type' => $votetype,
                'user_id' => decrypt($_SESSION['user_id']),
                'created_at' => date("Y-m-d h:i:sa")
            );
            $res = $this->post_model->vote($data);
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while voting';
            } else {
                $response['success'] = 1;
                $response['message'] = 'vote successfully';
                $post = get_post_details(decrypt($post_id));
                $votes = $post['votes']['post_votes'];
                $html = '<button type="button" class="red">FANS</button>';
                $html .= ' <a href="' . base_url('Post/view/' . encrypt($post['id'])) . '"><button  class="ea0048">Comment</button></a>';
                foreach ($votes as $vote) {
                    if ($post['my_vote'] == $vote['type']) {

                        $html .= ' <button type="button" class="m00b243">' . $vote['name'] . '</button>';
                    }
                }
                $html .= '<p>by ' . $post['username'] . ' , ' . $post['votes']['vote_count'] . ' views</p>';

                $html .= '<div class="rbutton">';
                foreach ($votes as $vote) {
                    $voted = ($post['my_vote'] == $vote['type']) ? 'disabled' : '';
                    $html .= ' <button data-post_id = "' . encrypt($post['id']) . '" data-vote_status="' . $post['my_vote'] . '" data-votetype = "' . $vote['type'] . '" type="button" class="red postvote"' . $voted . '>' . $vote['name'] . '</button>';
                }
                $html .= '</div>';
                $response['html'] = $html;
            }
            echo json_encode($response);
            exit();
        } else {
            redirect('/User/login');
        }
    }

    public function update_vote($post_id = false, $votetype = false) {
        if (is_loggedin() === true) {
            $data = array(
                'post_id' => decrypt($post_id),
                'user_id' => decrypt($_SESSION['user_id'])
            );

            $v = $this->post_model->check_voting_status($data);
            $res = $this->post_model->update_vote($v['id'], $votetype);
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while changing voting';
            } else {
                $response['success'] = 1;
                $response['message'] = 'Your vote is changed successfully';
                $post = get_post_details(decrypt($post_id));
                $votes = $post['votes']['post_votes'];
                $html = '<button type="button" class="red">FANS</button>';
                foreach ($votes as $vote) {
                    if ($post['my_vote'] == $vote['type']) {

                        $html .= ' <button type="button" class="m00b243">' . $vote['name'] . '</button>';
                    }
                }
                $html .= '<p>by ' . $post['username'] . ' , ' . $post['votes']['vote_count'] . ' views</p>';

                $html .= '<div class="rbutton">';
                foreach ($votes as $vote) {
                    $voted = ($post['my_vote'] == $vote['type']) ? 'disabled' : '';
                    $html .= ' <button data-post_id = "' . encrypt($post['id']) . '" data-vote_status="' . $post['my_vote'] . '" data-votetype = "' . $vote['type'] . '" type="button" class="red postvote"' . $voted . '>' . $vote['name'] . '</button>';
                }
                $html .= '</div>';
                $response['html'] = $html;
            }
            echo json_encode($response);
            exit();
        } else {
            redirect('/User/login');
        }
    }

    public function add_post_comment() {

        if (is_loggedin() === true) {
            $data = array(
                'post_id' => decrypt($this->input->post('post_id')),
                'comment' => $this->input->post('comment'),
                'user_id' => decrypt($_SESSION['user_id']),
                'created_at' => date("Y-m-d h:i:sa")
            );
            $res = $this->post_model->add_comment($data);
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while commenting';
            } else {
                $response['success'] = 1;
                $response['message'] = 'comment added successfully';

                $comments = (get_post_comments($this->input->post('post_id')));
                $userdetails = userdetails();
                $html = '';
                foreach ($comments as $comment) {
                    $icon = $comment['user_id'] == $userdetails['id'] ? '<i class="fa fa-fw fa-trash-o commenttrash" data-id="' . encrypt($comment['id']) . '"></i><i class="fa fa-fw fa-edit commentedit"  data-id="' . encrypt($comment['id']) . '"></i>' : '';
                    $html .= '<li>
                                        <div class="cp-author-info-holder">
                                            <div class="cp-thumb">
                                                <img src="' . base_url('uploads/' . $comment['image']) . '" style="height:70; width:90px;" alt="">
                                            </div>
                                            <div class="cp-text">
                                                <h4><a href="#">' . $comment['username'] . '</a></h4>
                                                <p>' . $comment['comment'] . '﻿ </p>';
                    $html .= '<div class="cp-viewer-outer">' . $icon . '</div>';
                    if ($comment['user_id'] == $userdetails['id']) {
                        $html .= '<div class="commnetupdform" style="display:none;">'
                                . '<input type="text" class="form-control commentbox" placeholder="" value="' . $comment['comment'] . '"/>'
                                . '<button type="button" class="hideupdcommentbox btn-success" data-post_id="' . $this->input->post('post_id') . '" data-id="' . encrypt($comment['id']) . '">Update</button>'
                                . '</div>';
                    }
                    $html .= '</div>
                                        </div>
                                    </li>';
                }
                $response['html'] = $html;
            }
            echo json_encode($response);
            exit();
        } else {
            redirect('/User/login');
        }
    }

    public function delete_comment($id = false) {
        $data = array();
        if (is_loggedin()) {
            $response = array();
            $res = $this->post_model->delete_comment(decrypt($id));
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while removing comment';
            } else {
                $response['success'] = 1;
                $response['message'] = 'comment removed successfully';
            }
            echo json_encode($response);
            exit();
        } else {
            redirect('/User/login');
        }
    }

    public function update_comment($comment_id = false) {
        if (is_loggedin() === true) {
            $data = array(
                'comment' => $this->input->post('comment')
            );
            $res = $this->post_model->update_comment(decrypt($comment_id), $data);
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while Updating comment';
            } else {
                $response['success'] = 1;
                $response['message'] = 'Your comment is updated successfully';
                $comments = (get_post_comments($this->input->post('post_id')));
                $userdetails = userdetails();
                $html = '';
                foreach ($comments as $comment) {
                    $icon = $comment['user_id'] == $userdetails['id'] ? '<i class="fa fa-fw fa-trash-o commenttrash" data-id="' . encrypt($comment['id']) . '"></i><i class="fa fa-fw fa-edit commentedit"  data-id="' . encrypt($comment['id']) . '"></i>' : '';
                    $html .= '<li>
                                        <div class="cp-author-info-holder">
                                            <div class="cp-thumb">
                                                <img src="' . base_url('uploads/' . $comment['image']) . '" style="height:70; width:90px;" alt="">
                                            </div>
                                            <div class="cp-text">
                                                <h4><a href="#">' . $comment['username'] . '</a></h4>
                                                <p>' . $comment['comment'] . '﻿ </p>';
                    $html .= '<div class="cp-viewer-outer">' . $icon . '</div>';
                    if ($comment['user_id'] == $userdetails['id']) {
                        $html .= '<div class="commnetupdform" style="display:none;">'
                                . '<input type="text" class="form-control commentbox" placeholder="" value="' . $comment['comment'] . '"/>'
                                . '<button type="button" class="hideupdcommentbox btn-success" data-post_id="' . $this->input->post('post_id') . '" data-id="' . encrypt($comment['id']) . '">Update</button>'
                                . '</div>';
                    }
                    $html .= '</div>
                                        </div>
                                    </li>';
                }
                $response['html'] = $html;
            }
            echo json_encode($response);
            exit();
        } else {
            redirect('/User/login');
        }
    }

    public function Delete($id = false) {
        if (is_loggedin() === true) {
            $post = $this->post_model->get_post_details(decrypt($id));
            $delete_activities = $this->post_model->delete_activity(decrypt($id));
            $delete_comments = $this->post_model->delete_multiple_comments(decrypt($id));
            $delete_votes = $this->post_model->delete_votes(decrypt($id));
            $res = $this->post_model->delete(decrypt($id));
            if ($res == FALSE) {
                $response['success'] = 0;
                $response['message'] = 'Error while deleting Please try again';
            } else {
                if ($post['media_type'] == 'image' || $post['media_type'] == 'video') {
                    unlink('uploads/' . $post['path']);
                }

                $response['success'] = 1;
                $response['message'] = 'post deleted successfully';
            }
            echo json_encode($response);
        } else {
            redirect('/User/login');
        }
    }

}
