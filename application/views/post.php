<?php $this->load->view('header'); ?>
<div id="cp-main-content">
    <section class="cp-blog-section pd-tb60">
        <div class="container">
            <div class="row">
                <div class="col-md-9">

                    <div class="cp-video-detail-outer">
                        <div class="cp-video-outer2">
                            <?php
                            $userdetails = userdetails();
                            $post = get_post_details($post['id']);
//                            pr($post);
                            if ($post['media_type'] == 'image')
                                echo'<img class="img-responsive" src="' . base_url('uploads/' . $post['path']) . '">';
                            elseif ($post['media_type'] == 'youtube') {
                                $string = explode('?v=', $post['path']);
                                echo $string[1];
                                echo'<iframe class="img-responsive" src="https://www.youtube-nocookie.com/embed/' . $string[1] . '?rel=0"></iframe>';
                            } elseif ($post['media_type'] == 'video')
                                echo'<video class="img-responsive" controls>
                                            <source src="' . base_url('uploads/' . $post['path']) . '" type="video/mp4">
                                            Your browser does not support HTML5 video.
                                          </video>';
                            ?>
                        </div>
                        <div class="cp-text-holder">
                            <div class="cp-top">
                                <h4><?php echo $post['post_title']; ?> </h4>
                                <span class="viewer"><?php echo $post['votes']['vote_count']; ?> Views</span>
                            </div>
                            <div class="cp-watch-holer mb-0">
                                <!--                                <ul class="cp-watch-listed">
                                                                    <li><a href="video.html#"><i class="fa fa-plus"></i> Add to</a></li>
                                                                    <li><a href="video.html#"><i class="fa fa-share"></i> Share</a>
                                                                        <ul class="cp-social-links">
                                                                            <li><a href="video.html#"><i class="fa fa-facebook-square"></i></a></li>
                                                                            <li><a href="video.html#"><i class="fa fa-pinterest-p"></i></a></li>
                                                                            <li><a href="video.html#"><i class="fa fa-twitter"></i></a></li>
                                                                            <li><a href="video.html#"><i class="fa fa-rss"></i></a></li>
                                                                        </ul>
                                                                    </li>
                                                                    <li class="dropdown">
                                                                        <button class="btn btn-default dropdown-toggle" type="button" id="cp-dropdown-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                            More
                                                                        </button>
                                                                        <ul class="dropdown-menu" aria-labelledby="cp-dropdown-menu">
                                                                            <li><a href="video.html#">Report</a></li>
                                                                            <li><a href="video.html#">Transcript</a></li>
                                                                            <li><a href="video.html#">Statistics</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>-->
                                <div class="cp-viewer-outer">
                                    <?php
                                    $post = get_post_details($post['id']);
                                    $votes = $post['votes']['post_votes'];
                                    foreach ($votes as $vote) {
                                        $like = ($post['my_vote'] == $vote['type']) ? '<i class="fa fa-fw fa-check"></i>' : '';
//                                        echo'<li class="list-group-item">
//                                    <b>' . $vote['name'] . '</b> <a class="pull-right">' . $like . $vote['count'] . '</a>
//                                </li>'; 
                                        echo'<a href="video.html#">' . $vote['name'] . ' ' . $vote['count'] . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="cp-watch-holer">
                                <ul class="cp-meta-list">
                                    <li>Monday, Jan 26, 2016</li>
                                    <li>by <?php echo $post['username']; ?> , <span><?php echo $post['votes']['vote_count']; ?>  Views</span></li>
                                </ul>
                                <a class="cp-show-more">Show More</a>
                            </div>

                            <article class="cp-comments-holder">
                                <?php
                                $comments = (get_post_comments(encrypt($post['id'])));
                                echo'<h4>All Comments (' . count($comments) . ')</h4>';
                                ?>

                                <ul class="cp-comments-listed" >
                                    <li>
                                        <div class="cp-author-info-holder">
                                            <form action="<?php echo base_url('post/add_post_comment'); ?>" id="commnetform" method="post">
                                                <div class="cp-author-info-holder">
                                                    <div class="cp-thumb">
                                                        <img src="<?php echo base_url('uploads/' . $userdetails['image']); ?>" style="height:70px; width:90px;" alt="">
                                                    </div>
                                                    <div class="cp-text">
                                                        <input type="hidden" name="post_id" value="<?php echo encrypt($post['id']); ?>">
                                                        <input type="text" name="comment" class="form-control input-sm" id="commentbox" placeholder="Press enter to post comment" required="required">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                    <div id="commentlist">

                                        <?php
//                                    pr($comments);
                                        foreach ($comments as $comment) {
                                            $icon = $comment['user_id'] == $userdetails['id'] ? '<i class="fa fa-fw fa-trash-o commenttrash" data-id="' . encrypt($comment['id']) . '"></i><i class="fa fa-fw fa-edit commentedit"  data-id="' . encrypt($comment['id']) . '"></i>' : '';
                                            echo'<li>
                                        <div class="cp-author-info-holder">
                                            <div class="cp-thumb">
                                                <img src="' . base_url('uploads/' . $comment['image']) . '" style="height:70; width:90px;" alt="">
                                            </div>
                                            <div class="cp-text">
                                                <h4><a href="#">' . $comment['username'] . '</a></h4>
                                                <p>' . $comment['comment'] . '﻿ </p>';
                                            echo'<div class="cp-viewer-outer">' . $icon . '</div>';
                                            if ($comment['user_id'] == $userdetails['id']) {
                                                echo'<div class="commnetupdform" style="display:none;">'
                                                . '<input type="text" class="form-control commentbox" placeholder="" value="' . $comment['comment'] . '"/>'
                                                . '<button type="button" class="hideupdcommentbox btn-success" data-post_id="' . encrypt($post['id']) . '" data-id="' . encrypt($comment['id']) . '">Update</button>'
                                                . '</div>';
                                            }
                                            echo'</div>
                                        </div>
                                    </li>';
//                                        echo'<div class="box-comment">
//                                            <img class="img-circle img-sm" src="' . base_url('uploads/' . $comment['image']) . '" alt="User Image">
//                                            <div class="comment-text">
//                                                <span class="username">' . $comment['username'] . '
//                                                    <span class="text-muted pull-right">' . calculate_time_span($comment['created_at']) . '</span>
//                                                </span>' . $comment['comment'];
//                                        echo $icon . '</div>';
//                                        if ($comment['user_id'] == $userdetails['id']) {
//                                            echo'<div class="commnetupdform" style="display:none;">'
//                                            . '<input type="text" class="form-control commentbox" placeholder="" value="' . $comment['comment'] . '"/>'
//                                            . '<button type="button" class="hideupdcommentbox btn-success" data-post_id="' . encrypt($post['id']) . '" data-id="' . encrypt($comment['id']) . '">Update</button>'
//                                            . '</div>';
//                                        }
//                                        echo '</div>';
                                        }
                                        ?>
                                    </div>

                                </ul>
                            </article>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <aside class="cp_sidebar-outer">

                        <div class="widget widget-recent-post">
                            <ul>
                                <?php
                                foreach ($category_posts as $category_post) {

                                    //pr($category_post); 
                                    echo'<li>
                                    <div class="cp-holder">
                                        <div class="cp-thumb2">';
                                    if ($category_post['media_type'] == 'image')
                                        echo'<img class="img-responsive" style="height:65px; width:70px;" src="' . base_url('uploads/' . $category_post['path']) . '">';
                                    elseif ($category_post['media_type'] == 'youtube')
                                        echo'<img src="https://media.tenor.com/images/6d7761cb85acdb185ca243821e1b7339/tenor.gif"  style="height:65px; width:70px;" >';
                                    elseif ($category_post['media_type'] == 'video')
                                        echo'<img class="img-responsive" style="height:65px; width:70px;" src="' . base_url('assets/images//logo1.png') . '">';

                                    echo'</div> 
                                        <div class="cp-text">
                                            <h5><a href="' . base_url('Post/view/' . encrypt($category_post['id'])) . '">' . $category_post['post_title'] . ' </a></h5>
                                            <ul class="cp-meta-list">
                                                <li>' . get_date($category_post['created_at']) . '</li>
                                                <li>By ' . $category_post['username'] . ' </li>
                                                <li>' . $category_post['count'] . ' Views </li>
                                                <li>' . $category_post['media_type'] . ' </li>
                                                <li>' . $category_post['path'] . ' </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li> 
                                '; 
                                }
                                ?>
                            </ul>
                            <!--                            <div class="cp-show-more-outer">
                                                            <a href="video.html#">Show More</a>
                                                        </div>-->
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('footer'); ?>
<script>
//    $(document).on('click'.'.cp-show-more',function(){
//        $('.cp-comments-listed').toggle('slow')
//    });
    $(document).on('submit', '#commnetform', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function (response) {
            if (response.success == 1) {
                $('#commentlist').html(response.html);
                toastr.success(response.message);
                $('#commentbox').val('');
            } else
                toastr.error(response.message);
        }, 'json');
    });
    $(document).on('click', '.commenttrash', function () {
        var id = $(this).data('id');
        var div = $(this).closest('.cp-author-info-holder');
        $.post('<?php echo base_url('Post/delete_comment/'); ?>' + id, function (response) {
            if (response.success == 1) {
                toastr.success(response.message);
                div.remove();
            } else {
                toastr.error(response.message);
            }
        }, 'json');
    });
    $(document).on('click', '.commentedit', function () {
        var div = $(this).closest('.cp-author-info-holder');
        div.find('.commnetupdform').css('display', 'block');
        div.find('.comment-text').css('display', 'none');
    });
    $(document).on('click', '.hideupdcommentbox', function () {
        var div = $(this).closest('.cp-author-info-holder');
        div.find('.commnetupdform').css('display', 'none');
        div.find('.comment-text').css('display', 'block');
        var comment = div.find('.commentbox').val();
        var id = $(this).data('id');
        var formdata = 'comment=' + comment + '&post_id=' + $(this).data('post_id');
        var url = '<?php echo base_url('Post/update_comment/'); ?>' + id;
        $.post(url, formdata, function (response) {
            if (response.success == 1) {
                $('#commentlist').html(response.html);
                toastr.success(response.message);
            } else
                toastr.error(response.message);
        }, 'json');
    });

</script>