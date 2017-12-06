<?php $this->load->view('header'); ?>

<style>.cp_banner_full_width h1 {
        background: #d52b3f;
        color: #fff;
        margin: 0px;
        padding: 20px 0px;
        text-align: center;
    }

    .propicss {
        margin: 0 auto;
        width: 145px;
        padding: 3px;
        border: 3px solid #d2d6de;
        position: absolute;
        top: 73%;
        left: 10%;
    }
    .covertext {
        margin: 0 auto;
        padding: 3px;
        border: 3px solid #d2d6de;
        position: absolute;
        top: 60%;
        left: 10%;
        background: cornsilk;
    }
    .my li {
        padding: 0px 6px;
    }
    .new1 
    {
        padding-right:5px; 
    } 
    .btn2 {
        position: absolute;
        right:0px;
        top: 65px;
    } 
    .rbutton11{
        background: #fff;
    }
    .rbutton ul
    {
        float:left;

    }
    .rbutton ul li {
        list-style: none;
        padding: 7px 7px;
        float: right;
        text-align: center;

    }
    .boder > li
    {

        border: 1px solid #6666;
    }
    .card {
        background: #fff;
        padding: 20px 10px;
        border-radius: 10px;
    }
    .card-header span
    {
        font-size: 12px;
        color: #d52b3f;
    }
    .timeline-item {
        background: #f8f8f8;
        padding: 20px;
        border: 1px #ccc solid;
    }


    .clscat {
        margin: 21px 0px;
    }
    .clsvcomment {
        margin: 10px 0px;
    }
    .clspdes {
        margin: 18px 0px;
    }
    .clspostv {
        position: absolute;
        right: 38px;
        margin-top: -73px;
    }
    li.time-label {
        background: #5cb85c;
        width: 24%;
        padding: 16px;
        margin: 10px 0px;
        color: #fff;
    }
    .my ul {
        background: #000;
        padding: 10px 8px;
    }
    .bg-none {
        background: #f0f2f1 !important;

    }
    .my li {
        padding: 0px 6px;
        color: #fff;
    }
    .bg-none li {
        color: #000 !important;
    }
</style>

<?php
$userinfo = userinfo(($other_user_id));
//pr($userinfo)
?>

<div class="cp_banner_full_width">
    <div class="item">
        <div class="propicss">
            <img class="img-responsive pull-left " style="" src="<?php echo base_url('uploads/' . $userinfo['image']); ?>" alt="User profile picture">
            <br>
        </div>
        <?php
        $string = explode('?v=', $userinfo['profile_video']);
        if (isset($string[1]))
            echo'<iframe  allowfullscreen="allowfullscreen"
        mozallowfullscreen="mozallowfullscreen" 
        msallowfullscreen="msallowfullscreen" 
        oallowfullscreen="oallowfullscreen" 
        webkitallowfullscreen="webkitallowfullscreen" width="100%" height="450" src="https://www.youtube-nocookie.com/embed/' . $string[1] . '?rel=0"></iframe>';
        ?>
    </div>

</div>
<div class="row">
    <div class="container">
        <div class="col-md-3" style="margin-top:50px;">
            <h1><?php echo $userinfo['name']; ?></h1>
            <h4><?php echo $userinfo['username']; ?></h4>
            <address><?php echo $userinfo['email']; ?></address>
            <p>
                this is user description there 
            </p>
            <b>Joining Date</b><?php echo get_date($userinfo['created_at']); ?>
        </div>
        <div class="col-md-6">
            <div class="box box-default" style="    margin-top: 20px;">
                <!--                <div class="box-header with-border">
                                    <div class="rbutton rbutton11">
                                        <ul class="boder "> 
                                            <button class="btn">Favorites</button>
                                            <button class="btn">Favorites</button>
                                            <button class="btn">Favorites</button>
                                            <button class="btn">Favorites</button>
                                            <button class="btn">Favorites</button>
                                        </ul>
                
                                    </div>
                                </div>-->
                <div class="box-body">
                    <div class="form-group">
                        <form action="<?php echo base_url('Post/add_status'); ?>" method="post" id="statusform">
                            <textarea class="form-control" name="status" id="sharebox" rows="3" placeholder="Enter your Details what you have in your Mind.."></textarea>
                            <button class="btn btn-info sharebtn pull-right" type="submit" style="">Share</button>
                        </form>
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


            <ul class="timeline" id="timeline">
                <!-- timeline time label -->
                <?php
                unset($activities[0]);
                foreach ($activities as $key => $a) {
                    ?> 
                    <li class="time-label">
                        <span class="bg-red clsdat">
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
//                                    pr($activity);
                                    if ($activity['type'] == 'post') {
                                        $post = get_post_details($activity['post_id']);
//                                    pr($post);
                                        if ($post['media_type'] != 'status') {
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
                                        } else {
                                            echo'<i>' . $post['post_description'] . '</i><br><strong class="pull-right">' . $activity['username'] . '</strong>';
                                        }
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
                    <button href="#" data-url="<?php echo base_url('Dashboard/load_more/5'); ?>" class="btn btn-xs bg-maroon loadmore">Load More...</button>
                </li>
            </ul>
        </div> 
        <div class="col-md-3">
            <div class="card my-4">
                <h4 class="card-header">WorldStarGram <span>Constents</span></h4>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        foreach ($users as $user)
                            echo'<li class="list-group-item"><img class="img-circle" style="width: 15%; height: 15%;" src="' . base_url('uploads/' . $user['image']) . '"><a href="'.base_url('User/timeline/'.encrypt($user['id'])).'"><b>' . $user['name'] . ' </b><span class="badge">' . $user['post_count'] . '</span></li>';
                        ?>
                    </ul>
                </div>
                <?php
//                pr($users);
                ?>
            </div>
        </div>

    </div> 
</div>

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
        </div>
    </div>
</div>



<div class="modal modal-success fade" id="profileupdate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Success Modal</h4>
            </div>
            <div class="modal-body">
                <div class="tab-pane" id="settings">
                    <strong class="text-center">Update General Settings</strong>
                    <form class="form-horizontal" action="<?php echo base_url('User/profile'); ?>" name="profileForm" method="POST">
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Username</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" value="<?php echo $userinfo['username'] ?>" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" value="<?php echo $userinfo['email'] ?>" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="inputName" value="<?php echo $userinfo['name'] ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                    </form> <hr>

                    Reset Password
                    <form class="form-horizontal" id="updpwdform" action="<?php echo base_url('User/update_password/' . encrypt($userinfo['id'])); ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-6 text-center">Current Password</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="cpassword" required>
                                <input type="hidden" value="<?php echo $userinfo['password']; ?>" name="password"/>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-6 text-center">New Password</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="npassword" required>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label for="inputEmail" class="col-sm-6 text-center">Confirm New Password</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="cnpassword" required>
                            </div>
                        </div>  
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.tab-pane -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal modal-warning fade" id="profileimagepopup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Warning Modal</h4>
            </div>
            <div class="modal-body">
                Update Profile Image
                <form class="form-horizontal" id="userImageForm" action="<?php echo base_url('User/update_user_image/' . encrypt($userinfo['id'])); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Profile Image</label>

                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="user_image" onchange="readURL(this);"  accept="image/jpeg" required>
                            <img src="<?php echo base_url('assets/images/img_not_available.png') ?>" id="result" alt="Attachment">
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-warning fade" id="profilevideopopup">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Warning Modal</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?php echo base_url('User/update_profile_video/' . encrypt($userinfo['id'])); ?>" name="profileForm" id="videoform" method="POST">
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="col-sm-2 control-label">Profile Video</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="profile_video" id="youtube_url" value="<?php echo $userinfo['profile_video']; ?>" type="text"required>
                            <?php
                            $string = explode('?v=', $userinfo['profile_video']);
                            echo'<iframe class="img-responsive" src="https://www.youtube-nocookie.com/embed/' . $string[1] . '?rel=0"></iframe>';
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('footer'); ?> 
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
    $(document).on('submit', '#videoform', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            if (data.success === 1)
            {
                toastr.success(data.message);
                setTimeout(function () {
                    location.reload();
                }, 3000);

            } else {
                toastr.error(data.message);
            }
        }, 'json');
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

    $(document).on('submit', '#userImageForm', function (e) {
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

    $(document).on('submit', '#updpwdform', function (e) {
        e.preventDefault();
        console.log($(this).serialize());
        var password, cpassword, npassword, cnpassword;
        password = $("#updpwdform input[name=password]").val();
        cpassword = $("#updpwdform input[name=cpassword]").val();
        npassword = $("#updpwdform input[name=npassword]").val();
        cnpassword = $("#updpwdform input[name=cnpassword]").val();
        if (password != cpassword)
        {
            toastr.error('your current password is not correct');
            return;
        }
        if (npassword != cnpassword)
        {
            toastr.error('Your new password did not match');
            return;
        }

        if (npassword.length < 6) {
            toastr.error('Password Minimun length 6 letters');
            return;
        }
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            if (data.success == 1)
            {
                toastr.success(data.message);
            } else {
                toastr.error(data.message);
            }

        }, 'json');
    });

    $(document).on('submit', '#statusform', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize(), function (data) {
            if (data.success == 1)
            {
                toastr.success(data.message);
                setTimeout(function () {
                    location.reload();
                }, 3000);
            } else {
                toastr.error(data.message);
            }

        }, 'json');
    });
//    $(document).on('focus', '#sharebox', function () {
//        $('.sharebtn').show();
//    });
//    $(document).on('blur', '#sharebox', function () {
//        $('.sharebtn').hide();
//    });
</script>