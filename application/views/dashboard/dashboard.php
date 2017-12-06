<?php $this->load->view('dashboard/header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php
        $userinfo = userdetails();
        ?>
        <h1>
            Welcome, <?php echo $userinfo['username']; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>

        <div class="col-md-12">
            <div class="col-xs-12">
                <div class="box box-default" style="    margin-top: 20px;">
                    <div class="box-header with-border">
                        <h3 class="box-title">What you Have in your Mind</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group">

                            <textarea class="form-control" rows="3" placeholder="Enter your Details what you have in your Mind.."></textarea>
                        </div>
<!--                        <button type="button" class="btn btn-default addpost" data-type="text" data-url="<?php echo base_url('post/add_image'); ?>" data-toggle="modal" data-target="#modal-danger">
                            Update Status
                        </button>-->
                        <button type="button" class="btn btn-info addpost" data-type="video"  data-url="<?php echo base_url('post/add_video'); ?>" data-toggle="modal" data-target="#modal-danger">
                            Upload Video
                        </button>
                        <button type="button" class="btn btn-danger addpost" data-type="youtube"  data-url="<?php echo base_url('post/add_youtube_video'); ?>" data-toggle="modal" data-target="#modal-danger">
                            Upload YouTube Video
                        </button>
                        <button type="button" class="btn btn-warning addpost" data-type="image"  data-url="<?php echo base_url('post/add_image'); ?>"  data-toggle="modal" data-target="#modal-danger">
                            Upload Picture or Image
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <!-- The time line -->
            <ul class="timeline" id="timeline">
                <!-- timeline time label -->
                <?php
                unset($activities[0]);
                foreach ($activities as $key => $a) {
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
                            <i class="fa fa-camera bg-purple"></i>

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
                                        foreach ($votes as $vote) {
                                            echo'<span class="label label-danger">' . $vote['name'] . ' ' . $vote['count'] . '</span>&nbsp;&nbsp;&nbsp;';
                                        }
                                        echo '<br>Category : ' . $post['category_name'];
                                        echo $post['post_description'] . '<br>';
                                        echo '<a href="' . base_url('Post/view/' . encrypt($post['id'])) . '" class="btn btn-success">View</a>';
                                    }
                                    ?> 
                                </div> 
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
                <li>
                    <i class="fa fa-clock-o bg-gray"></i>
                </li>
            </ul>
            <div class="timeline-footer text-center">
                <button href="#" data-url="<?php echo base_url('Dashboard/load_more/5'); ?>" class="btn btn-xs bg-maroon loadmore">Load More...</button>
            </div>
        </div>
        <!-- Your Page Content Here -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Default Modal</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-primary fade" id="modal-primary">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Primary Modal</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-info fade" id="modal-info">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Info Modal</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-warning fade" id="modal-warning">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Warning Modal</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-success fade" id="modal-success">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Success Modal</h4>
                    </div>
                    <div class="modal-body">
                        <p>One fine body&hellip;</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline">Save changes</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal modal-danger fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Danger Modal</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?php echo base_url('post/add_image'); ?>" id="add_post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Post Title</label>
                                <input type="text" class="form-control" name="post_title" id="exampleInputEmail1" placeholder="Enter Post title" required="">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Post Description</label>
                                <textarea class="form-control" name="post_description"></textarea>
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
                                <input type="text" class="form-control" id="category_name" readonly required>             
                                <input type="hidden" class="form-control" id="parent_id" name="parent_id">             
                            </div>
                            <div class="form-group" id="form_type">

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="image_button">Add</button>
                            </div>

                        </form>
                        <div class="overlay" id="image_overlay" style="display:none;">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                    <!--                    <div class="modal-footer">
                                            <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-outline">Save changes</button>
                                        </div>-->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
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




    $(document).on('submit', '#add_post', function (e) {
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
                    toastr.error(data.message);
                }
                $('#image_overlay').css('display', 'none');
            }
        });
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
    $(document).on('click', '.addpost', function () {
        var url = $(this).data('url');
        var youtube_div = '<label for="exampleInputPassword1">Paste url here</label>' +
                '<input type="text" class="form-control" name="youtube_url" id="youtube_url" type="text"required>' +
                '<iframe id="youtube_frame" width="420" height="315" src="">' +
                '</iframe>';
        var video_div = '<div id="cropImage">' +
                '<input id="vfile" type="file" name="image_file" accept="video/mp4" required>' +
                '<span class="mailbox-attachment-icon has-img"><img src="<?php echo base_url('assets/images/img_not_available.png') ?>" id="result" alt="Attachment"></span>' +
                '</div>';
        var image_div = '<div id="cropImage">' +
                '<input id="file" type="file" name="image_file" onchange="readURL(this);"  accept="image/jpeg" required>' +
                '<span class="mailbox-attachment-icon has-img"><img src="<?php echo base_url('assets/images/img_not_available.png') ?>" id="result" alt="Attachment"></span>' +
                '</div>';
        var type = $(this).data('type');
        if (type == 'youtube') {
            $('#form_type').html(youtube_div);
        } else if (type == 'video') {
            $('#form_type').html(video_div);
        } else if (type == 'image') {
            $('#form_type').html(image_div);
        }
        $('#add_post').attr('action', url);
    });
    $(document).on('blur', '#youtube_url', function () {
        var url = $(this).val().split("?v=");
        url = url[1];
        $('#youtube_frame').attr('src', 'https://www.youtube-nocookie.com/embed/' + url + '?rel=0');
    });
    var vid = document.createElement('video');
    $(document).on('change', '#vfile', function () {
        var fileURL = URL.createObjectURL(this.files[0]);
        vid.src = fileURL;
        vid.ondurationchange = function () {
            if (this.duration > 30) {
                toastr.error('Your video is too long Please choose another video');
                $('#vfile').val('');
            }
        };
    });
    $(document).on('click', '.loadmore', function () {
        var url = $(this).data('url');
        $(this).remove();
        $.post(url, function (response) {
            $('#timeline').append(response);
        });
    });
</script>