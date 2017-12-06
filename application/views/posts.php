<?php $this->load->view('header'); ?>
<style>.cp_banner_full_width h1 {
        background: #d52b3f;
        color: #fff;
        margin: 0px;
        padding: 20px 0px;
        text-align: center;
    }</style>
<div class="cp_banner_full_width">
    <h1><?php echo $category['category_name']; ?></h1>
    <div class="item">
        <?php
        if ($category['youtube_url'] != '') {
            $url = $category['youtube_url'];
        } else {
            $url = 'https://www.youtube-nocookie.com/embed/k8p4SDlY8S0?rel=0';
        }
        ?>
        <iframe width="100%" height="450" src="<?php echo $url ?>" frameborder="0" allowfullscreen=""></iframe>

    </div>

</div>
<div class="cp_inner-banner">
    <div class="container">
        <div class="cp-inner-banner-holder">
            <!--code starts here-->
            <div class="carousel">
                <?php
                foreach ($posts as $post) {
                    ?>
                    <div class="col-md-3">
                        <div class="item margin-top10">
                            <?php
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


                            $post = get_post_details($post['id']);
                            $votes = $post['votes']['post_votes'];

                            echo'<h4 class="margin-top10">' . $post['post_title'] . '</h4>';
                            echo'<div id="post' . encrypt($post['id']) . '">';
                            echo'<button type="button" class="red">FANS</button>';
                            echo' <a href="' . base_url('Post/view/' . encrypt($post['id'])) . '"><button  class="ea0048">Comment</button></a>';
                            foreach ($votes as $vote) {
                                if ($post['my_vote'] == $vote['type']) {

                                    echo' <button type="button" class="m00b243">' . $vote['name'] . '</button>';
                                }
                            }
                            echo'<p>by ' . $post['username'] . ' , ' . $post['votes']['vote_count'] . ' views</p>';

                            echo'<div class="rbutton">';
                            foreach ($votes as $vote) {
                                $voted = ($post['my_vote'] == $vote['type']) ? 'disabled' : '';
                                echo' <button data-post_id = "' . encrypt($post['id']) . '" data-vote_status="' . $post['my_vote']
                                . '" data-votetype = "' . $vote['type'] . '" type="button" class="postvote green"' . $voted
                                . '>' . $vote['name'] . '</button>';
                            }
                            echo'</div>';
                            echo'</div>';
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <!---code ends here-->
        </div>
        <?php $this->load->view('footer'); ?>
        <script>
            var logged_in = '<? echo is_loggedin();?>';
            $(document).on('click', '.postvote', function () {
                if (logged_in) {
                    var post_id, votetype, vote_status;
                    post_id = $(this).data('post_id');
                    var div_id = '#post' + post_id;
                    votetype = $(this).data('votetype');
                    vote_status = $(this).data('vote_status');
                    if (vote_status > 0) {
                        var r = confirm("You have already Voted on this post! You really want to change your status");
                        if (r == true) {
                            $.post('<?php echo base_url('post/update_vote'); ?>/' + post_id + '/' + votetype, function (response) {
                                if (response.success == 1) {
                                    toastr.success(response.message);
                                    $('#post' + post_id).html(response.html);
                                } else
                                    toastr.error(response.message);
                            }, 'json');
                        }
                    } else if (vote_status == "0")
                    {
                        $.post('<?php echo base_url('post/vote'); ?>/' + post_id + '/' + votetype, function (response) {
                            if (response.success == 1) {
                                toastr.success(response.message);
                                $('#post' + post_id).html(response.html);
                            } else
                                toastr.error(response.message);
                        }, 'json');
                    }

                } else
                    toastr.error('For voting please login first');

            });
        </script>