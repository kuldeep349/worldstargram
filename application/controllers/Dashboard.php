<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array('encrypt', 'parser'));
        $this->load->helper(array('form', 'url'));
        $this->load->model(array('user_model', 'activity_model'));
    }

    public function index() {
        $data = array();
        if (is_loggedin()) {
            $data = array();
            $activities = $this->activity_model->get(0, 5);
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
            $this->load->view('dashboard/dashboard', $data);
        } else {
            redirect('/User/login');
        }
    }

    public function load_more($rec = 0, $limit = 5) {
        $data = array();
        if (is_loggedin()) {
            $data = array();
            $activities = $this->activity_model->get($rec, $limit);
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
            unset($grouparr[0]);
            foreach ($grouparr as $key => $a) {
                ?> 
                <li class="time-label">
                    <span class="bg-red">
                        <?php echo $key; ?>
                    </span>
                </li>
                <?php
                foreach ($a as $activity) {
                    ?>
                    <li>


                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> <?php echo calculate_time_span($activity['created_at']); ?></span>

                            <h3 class="timeline-header"><a href="#"></a><?php echo $activity['username'] . ' ' . $activity['remark']; ?></h3>

                            <div class="timeline-body">
                                <?php
                                if ($activity['type'] == 'post') {
                                    $post = get_post_details($activity['post_id']);
//                                    pr($post);
                                    echo'<h3>' . $post['post_title'] . '</h3>';
                                    if ($post['media_type'] == 'image')
                                        echo'<img class="img-responsive" src="' . base_url('uploads/' . $post['path']) . '">';
                                    elseif ($post['media_type'] == 'youtube') {
                                        $string = explode('?v=', $post['path']);
                                        echo'<iframe class="img-responsive" src="https://www.youtube-nocookie.com/embed/' . $string[1] . '?rel=0"></iframe>';
                                    } elseif ($post['media_type'] == 'video')
                                        echo'<video class="img-responsive" controls>
                                            <source src="' . base_url('uploads/' . $post['path']) . '" type="video/mp4">
                                            Your browser does not support HTML5 video.
                                          </video>';

                                    $votes = $post['votes']['post_votes'];
                                    echo'<div class="clsvcomment">';
                                    foreach ($votes as $vote) {
                                        echo'<span class="label label-danger">' . $vote['name'] . ' ' . $vote['count'] . '</span>';
                                    }
                                    echo'</div>';
                                    echo '<div class="clscat">Category : ' . $post['category_name'] . '</div>';
                                    echo '<div class="clspdes">' . $post['post_description'] . '</div>';
                                    echo '<a href="' . base_url('Post/view/' . encrypt($post['id'])) . '" class="btn btn-success clspostv">View</a>';
                                }
                                ?> 
                            </div> 
                        </div>
                    </li>

                    <?php
                }
            }
            if (count($activities) == $limit) {
                $sum = $rec + $limit;
                echo' <li>
                    <button href="#" data-url="' . base_url('Dashboard/load_more/' . $sum) . '" class="btn btn-xs bg-maroon loadmore">Load More...</button>
                </li>';
            }
            exit();
        } else {
            redirect('/User/login');
        }
    }

    public function dragdrop() {
        $this->load->view('dashboard/dragdrop');
    }

}
