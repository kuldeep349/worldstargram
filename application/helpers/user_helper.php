<?php

if (!function_exists('is_loggedin')) {

    function is_loggedin() {
        if (isset($_SESSION['user_id']) && $_SESSION['logged_in'] === true) {
            return true;
        } else {
            return false;
        }
    }

}
if (!function_exists('get_redirect_url')) {

    function get_redirect_url() {
        $fullUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $hostUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        if ($fullUrl === $hostUrl) {
            $res = '';
        } else {
            $res = "?url=$fullUrl";
        }
        return $res;
    }

}

if (!function_exists('encrypt')) {

    function encrypt($id) {
        $key = md5('worldstargram', true);
        $id = base_convert($id, 10, 36);
        $data = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $id, 'ecb');
        $data = bin2hex($data);

        return $data;
    }

}
if (!function_exists('decrypt')) {

    function decrypt($encrypted_id) {
        $key = md5('worldstargram', true);
        $data = pack('H*', $encrypted_id);
        $data = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $data, 'ecb');
        $data = base_convert($data, 36, 10);

        return $data;
    }

}
if (!function_exists('timeConvert')) {

    function timeConvert($time) {
        $date = new DateTime($time);
        return $date->format('Y-m-d');
    }

}
if (!function_exists('formatSizeUnits')) {

    function formatSizeUnits($filename) {
        $bytes = filesize($filename);
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

}
if (!function_exists('get_categories')) {

    function get_categories() {


        $ci = & get_instance();
        $ci->load->model('category_model');

        $categories = $ci->category_model->get_categories();
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
        return $level1;
    }

}
//if (!function_exists('get_post_categories')) {
//
//    function get_post_categories() {
//        $ci = & get_instance();
//        $ci->load->model('PostCategory_model');
//        $categories = $ci->PostCategory_model->get_post_categories();
//        return $categories;
//    }
//
//}
if (!function_exists('get_post_details')) {

    function get_post_details($post_id) {
        $ci = & get_instance();
        $ci->load->model('Post_model');
        $postdetails = $ci->Post_model->get_post_details($post_id);
        $postdetails['votes'] = get_post_votes($post_id);
        return $postdetails;
    }

}
if (!function_exists('get_post_count')) {

    function get_post_count($post_id, $votetype = false) {
        $ci = & get_instance();
        $ci->load->model('post_model');
        $votes = $ci->post_model->count_votes($post_id);
        $data = array();
        foreach ($votes as $key => $vote) {
            $data[$vote['vote_type']] = $vote['vote_count'];
        }
        if ($votetype == 5) {
            return array_sum($data);
        } else {
            if (array_key_exists($votetype, $data)) {
                return $data[$votetype];
            } else {
                return 0;
            }
        }
    }

}
if (!function_exists('get_post_votes')) {

    function get_post_votes($post_id) {
        $ci = & get_instance();
        $ci->load->model('post_model');
        $votes = $ci->post_model->count_votes($post_id);
        $votecount = 0;
        $votetype = array(1 => 'ONFIRE', 2 => 'HITS', 3 => 'MISSED');
        $k = array();
        foreach ($votes as $vo) {
            if ($vo['vote_type'] == 3)
                $k['ONFIRE'] = $vo['vote_count'];
            if ($vo['vote_type'] == 2)
                $k['HITS'] = $vo['vote_count'];
            if ($vo['vote_type'] == 1)
                $k['MISSED'] = $vo['vote_count'];


            $votecount = $votecount + $vo['vote_count'];
        }
        $all_votes = array();
        foreach ($votetype as $key => $type) {
            $count = (array_key_exists($type, $k) ? $k[$type] : '0');
            $all_votes[$key] = array('count' => $count, 'name' => $type, 'type' => $key);
        }
        $post_votes['post_votes'] = $all_votes;
        $post_votes['vote_count'] = $votecount;
        return $post_votes;
    }

}
if (!function_exists('check_voting_status')) {

    function check_voting_status($post_id) {
        $user_id = (is_loggedin() ? decrypt($_SESSION['user_id']) : '0');
        $ci = & get_instance();
        $ci->load->model('post_model');
        $voting_status = $ci->post_model->check_voting_status($user_id, $post_id);
        return $voting_status['vote_type'];
    }

}
if (!function_exists('pr')) {

    function pr($array, $die = false) {
        echo'<pre>';
        print_r($array);
        echo'</pre>';
        if ($die)
            die();
    }

}
if (!function_exists('userdetails')) {

    function userdetails() {
        $ci = & get_instance();
        $ci->load->model('user_model');

        $userdetails = $ci->user_model->get_user(decrypt($_SESSION['user_id']));
        return $userdetails;
    }

}
if (!function_exists('userinfo')) {

    function userinfo($id) {
        $ci = & get_instance();
        $ci->load->model('user_model');

        $userdetails = $ci->user_model->get_user(decrypt($id));
        return $userdetails;
    }

}
if (!function_exists('is_admin')) {

    function is_admin() {
        $userdetails = userdetails();
        if ($userdetails['role'] === 'A')
            return true;
        else
            return false;
    }

}
if (!function_exists('get_date')) {

    function get_date($datetime) {
        $date = new DateTime($datetime);
        return $new_date_format = $date->format('Y-m-d');
    }

}
if (!function_exists('calculate_time_span')) {

    function calculate_time_span($date) {
       $seconds = strtotime(date('Y-m-d H:i:s')) - strtotime($date);

        $months = floor($seconds / (3600 * 24 * 30));
        $day = floor($seconds / (3600 * 24));
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - ($hours * 3600)) / 60);
        $secs = floor($seconds % 60);

        if ($seconds < 60)
            $time = $secs . " seconds ago";
        else if ($seconds < 60 * 60)
            $time = $mins . " min ago";
        else if ($seconds < 24 * 60 * 60)
            $time = $hours . " hours ago";
        else if ($seconds < 24 * 60 * 60)
            $time = $day . " day ago";
        else
            $time = $months . " month ago";

        return $time;
    }

}
//to get all categories with all levels
if (!function_exists('get_all_categories')) {

    function get_all_categories() {


        $ci = & get_instance();
        $ci->load->model('category_model');

        $categories = $ci->category_model->get_categories();
        return $categories;
    }

}
//get post comments
if (!function_exists('get_post_comments')) {

    function get_post_comments($post_id) {
        $ci = & get_instance();
        $ci->load->model('post_model');
        $comments = $ci->post_model->get_post_comments(decrypt($post_id));
        return $comments;
    }

}