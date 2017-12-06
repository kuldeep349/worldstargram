<?php $this->load->view('dashboard/header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <section class="content">  
        <div class="row"> 
            <div class="col-xs-12">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <?php
                            $userdetails = userdetails();
                            if ($post['media_type'] == 'image')
                                echo'<img class="img-responsive" src="' . base_url('uploads/' . $post['path']) . '">';
                            elseif ($post['media_type'] == 'youtube'){
                                $string = explode('?v=',$post['path']);
echo $string[1];                echo'<iframe class="img-responsive" src="https://www.youtube-nocookie.com/embed/' . $string[1] . '?rel=0"></iframe>';
                            }
                            elseif ($post['media_type'] == 'video')
                                echo'<video class="img-responsive" controls>
                                            <source src="' . base_url('uploads/' . $post['path']) . '" type="video/mp4">
                                            Your browser does not support HTML5 video.
                                          </video>';
                            ?>
                            <h3 class="profile-username text-center"><?php echo $post['post_title']; ?></h3>
                            <p class="text-muted text-center"><?php echo $post['post_description']; ?></p>
                            <ul class="list-group list-group-unbordered">
                                <?php
                                $post = get_post_details($post['id']);
                                $votes = $post['votes']['post_votes'];
                                foreach ($votes as $vote) {
                                    $like = ($post['my_vote'] == $vote['type']) ? '<i class="fa fa-fw fa-check"></i>' : '';
                                    echo'<li class="list-group-item">
                                    <b>' . $vote['name'] . '</b> <a class="pull-right">' . $like . $vote['count'] . '</a>
                                </li>';
                                }
                                ?>
                                <li class="list-group-item">
                                    <b>Total</b> <a class="pull-right"><?php echo $post['votes']['vote_count']; ?></a>
                                </li>
                                <div class="box-footer">
                                    <form action="<?php echo base_url('post/add_post_comment'); ?>" id="commnetform" method="post">
                                        <img class="img-responsive img-circle img-sm" src="<?php echo base_url('uploads/' . $userdetails['image']); ?>" alt="Alt Text">
                                        <!-- .img-push is used to add margin to elements next to floating images -->
                                        <div class="img-push">
                                            <input type="hidden" name="post_id" value="<?php echo encrypt($post['id']); ?>">
                                            <input type="text" name="comment" class="form-control input-sm" id="commentbox" placeholder="Press enter to post comment" required="required">
                                        </div>
                                    </form>
                                </div>
                                <div class="box-footer box-comments" id="commentlist">
                                    <?php
                                    $comments = (get_post_comments(encrypt($post['id'])));
//                                    pr($comments);
                                    foreach ($comments as $comment) {
                                        $icon = $comment['user_id'] == $userdetails['id'] ? '<i class="fa fa-fw fa-trash-o commenttrash" data-id="' . encrypt($comment['id']) . '"></i><i class="fa fa-fw fa-edit commentedit"></i>' : '';
                                        echo'<div class="box-comment">
                                            <img class="img-circle img-sm" src="' . base_url('uploads/' . $comment['image']) . '" alt="User Image">
                                            <div class="comment-text">
                                                <span class="username">' . $comment['username'] . '
                                                    <span class="text-muted pull-right">' . calculate_time_span($comment['created_at']) . '</span>
                                                </span>' . $comment['comment'];
                                        echo $icon . '</div>';
                                        if ($comment['user_id'] == $userdetails['id']) {
                                            echo'<div class="commnetupdform" style="display:none;">'
                                            . '<input type="text" class="form-control commentbox" placeholder="" value="' . $comment['comment'] . '"/>'
                                            . '<button type="button" class="hideupdcommentbox btn-success" data-post_id="' . encrypt($post['id']) . '" data-id="' . encrypt($comment['id']) . '">Update</button>'
                                            . '</div>';
                                        }
                                        echo '</div>';
                                    }
                                    ?>

                                </div> 

                                <?php
                                if (is_admin()) {

                                    if ($post['status'] == 0) {
                                        echo'<a type="button" class="btn btn-success" href=' . base_url('Post/update_status/' . encrypt($post['id']) . '/1') . ' > Allow</a>';
                                    } else {
                                        echo'<a type="button" class="btn btn-danger" href=' . base_url('Post/update_status/' . encrypt($post['id']) . '/0') . ' > Block</a>';
                                    }
                                }
                                if ($userdetails['id'] == $post['user_id']) {

                                    echo'<a type="button" class="btn btn-danger" href=' . base_url('Post/Update/' . encrypt($post['id'])) . ' > Edit</a>';
                                    echo'<button type="button" class="btn btn-danger deletepost" data-url =' . base_url('Post/Delete/' . encrypt($post['id'])) . ' > Delete</button>';
                                }
                                ?>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('dashboard/footer'); ?>
<script>

    $(document).on('click', '.deletepost', function () {
       var r = confirm("Are you sure to delete this post!");
        if (r == true) {
            var url = $(this).data('url');
            $.post(url, function (response) {
                if (response.success == 1) {
                    toastr.success(response.message);
                    window.location.href = "<?php echo base_url('Dashboard');?>";
                } else
                    toastr.error(response.message);
            }, 'json');
        }
    });
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
        var div = $(this).closest('.box-comment');
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
        var div = $(this).closest('.box-comment');
        div.find('.commnetupdform').css('display', 'block');
        div.find('.comment-text').css('display', 'none');
    });
    $(document).on('click', '.hideupdcommentbox', function () {
        var div = $(this).closest('.box-comment');
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