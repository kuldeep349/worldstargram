<?php $this->load->view('dashboard/header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                            elseif ($post['media_type'] == 'youtube')
                                echo'<iframe class="img-responsive" src="' . $post['path'] . '"></iframe>';
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

                                <?php
                                if ($userdetails['id'] == $post['user_id']) {

                                    echo'<a type="button" class="btn btn-danger" href=' . base_url('Post/Update/' . encrypt($post['id'])) . ' > Edit</a>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="modal-body">
                        <?php
                        if ($post['media_type'] == 'image')
                            echo'<form method="POST" action="' . base_url('post/update_image/'. encrypt($post['id'])) . '" id="update_post" type="post" enctype="multipart/form-data">';
                        elseif ($post['media_type'] == 'youtube')
                            echo'<form method="POST" action="' . base_url('post/update_youtube_video/'. encrypt($post['id'])) . '" id="update_post" type="post" enctype="multipart/form-data">';
                        elseif ($post['media_type'] == 'video')
                            echo'<form method="POST" action="' . base_url('post/update_image/'. encrypt($post['id'])) . '" id="update_post" type="post" enctype="multipart/form-data">';
                        ?>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Post Title</label>
                            <input type="text" class="form-control" name="post_title" id="exampleInputEmail1" value="<?php echo $post['post_title'] ?>" placeholder="Enter Post title" required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Post Description</label>
                            <textarea class="form-control" name="post_description"><?php echo $post['post_description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Post Category</label>
                            <select name="level1category" id="level1category" class="form-control">
                                <option disabled selected value> -- select an category -- </option>
                            </select>
                        </div>
                        <div class="form-group" style="display:none;" id="level2dropdown">
                            <label for="exampleInputPassword1">Post Level2 Category</label>
                            <select name="level2category" id="level2category" class="form-control">
                            </select>
                        </div>
                        <div class="form-group" style="display:none;" id="level3dropdown">
                            <label for="exampleInputPassword1">Post Level3 Category</label>
                            <select name="level3category" id="level3category" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Selected  Category</label>
                            <input type="text" class="form-control" id="category_name" value="<?php echo$post['category_name']; ?>" readonly required>             
                            <input type="hidden" class="form-control" id="parent_id" name="parent_id" value="<?php echo $post['category_id']; ?>">             
                        </div>
                        <div class="form-group" id="form_type">
                            <?php
                            if ($post['media_type'] == 'image')
                                echo '<div id="cropImage">' .
                                '<input id="file" type="file" name="image_file" onchange="readURL(this);"  accept="image/jpeg">' .
                                '<span class="mailbox-attachment-icon has-img"><img src="' . base_url('uploads/' . $post['path']) . '" id="result" alt="Attachment"></span>' .
                                '</div>';
                            if ($post['media_type'] == 'video')
                                echo '<div id="cropImage">' .
                                '<input id="file" type="file" name="image_file" onchange="readURL(this);"  accept="video/mp4">' .
                                '<video class="img-responsive" controls>
                                            <source src="' . base_url('uploads/' . $post['path']) . '" type="video/mp4">
                                            Your browser does not support HTML5 video.
                                          </video>' .
                                '</div>';
                            if ($post['media_type'] == 'youtube')
                                echo '<label for="exampleInputPassword1">Paste url here</label>' .
                                '<input type="text" class="form-control" name="youtube_url" value="' . $post['path'] . '" id="youtube_url" type="text"required>' .
                                '<iframe id="youtube_frame" width="420" height="315" src="' . $post['path'] . '"></iframe>';
                            ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="image_button">Update</button>
                        </div>
                        </form>
                        <div class="overlay" id="image_overlay" style="display:none;">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('dashboard/footer'); ?>
<script>
    var categories = JSON.parse('<?php echo json_encode(get_all_categories()); ?>');
    $.each(categories, function (key, value) {
        if (value.level == 1) {
            $('#level1category').append('<option value=' + value.id + '>' + value.category_name + '</option>');
        }
    });

    $(document).on('change', '#level1category', function () {
        $('#level2category').html('<option disabled selected value> -- select an category -- </option>');
        var show = 0;
        var parent_id = $(this).val();
        $.each(categories, function (key, value) {
            if (value.parent_id == parent_id) {
                show = 1;
                $('#level2category').append('<option value="' + value.id + '">' + value.category_name + '</option>')
            }
        });
        if (show == 1) {
            $('#parent_id').val('');
            $('#category_name').val('');
            $('#level2dropdown').show();
        } else {

            $('#parent_id').val(parent_id);
            $('#category_name').val($('#level1category :selected').text());
            $('#level2dropdown').hide();
        }

    });
    $(document).on('change', '#level2category', function () {
        $('#level3category').html('<option disabled selected value> -- select an category -- </option>');
        var show = 0;
        var parent_id = $(this).val();
        $.each(categories, function (key, value) {
            if (value.parent_id == parent_id) {
                show = 1;
                $('#level3category').append('<option value="' + value.id + '">' + value.category_name + '</option>')
            }
        });
        if (show == 1) {
            $('#parent_id').val('');
            $('#category_name').val('');
            $('#level3dropdown').show();
        } else {

            $('#parent_id').val(parent_id);
            $('#category_name').val($('#level2category :selected').text());
            $('#level3dropdown').hide();
        }
    });
    $(document).on('change', '#level3category', function () {
        $('#parent_id').val($(this).val());
        $('#category_name').val($('#level3category :selected').text());
    });

    $(document).on('submit', '#update_post', function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var action = $(this).attr('action');
        $('#image_overlay').css('display', 'block');
        $.ajax({
            url: action,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                data = JSON.parse(data);
                if (data.success === 1)
                {
                    toastr.success(data.message);
                    setTimeout(function () {
                        location.reload();
                    }, 3000);

                } else {
                    toastr.error(data.message.error);
                }
                $('#image_overlay').css('display', 'none');
            }
        });
    });
    $(document).on('blur', '#youtube_url', function () {
        var url = $(this).val();
        $('#youtube_frame').attr('src', url);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#result')
                        .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
