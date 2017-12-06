<?php $this->load->view('dashboard/header'); ?>

<div class="content-wrapper" style="min-height: 1126px;">

    <!-- Content Header (Page header) -->
    <?php if (isset($_SESSION['update_message'])) { ?>
        <div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            <strong><?php echo $_SESSION['update_message']; ?>.</strong> 
        </div>
    <?php } ?>
    <section class="content-header">
        <h1>
            <?php
            $userdetails = userdetails();
            echo $userdetails['username'];
            ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">User profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <img class="img-responsive img-circle pull-left" style="margin: 0 auto;
             width: 145px;
             padding: 3px;
             border: 3px solid #d2d6de;
             position: absolute;
             top: 289px;" src="<?php echo base_url('uploads/' . $userdetails['image']); ?>" alt="User profile picture">
             <?php
             $string = explode('?v=', $userdetails['profile_video']);
             if (isset($string[1]))
                 echo'<iframe  allowfullscreen="allowfullscreen"
        mozallowfullscreen="mozallowfullscreen" 
        msallowfullscreen="msallowfullscreen" 
        oallowfullscreen="oallowfullscreen" 
        webkitallowfullscreen="webkitallowfullscreen" width="100%" height="300px" src="https://www.youtube-nocookie.com/embed/' . $string[1] . '?rel=0"></iframe>';
             ?>
        <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#activity" data-toggle="tab" aria-expanded="false">Activity</a></li>
                        <li class="active"><a href="#timeline" data-toggle="tab" aria-expanded="true">Timeline</a></li>
                        <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Settings</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="activity">
                            <ul class="timeline timeline-inverse">
                                <?php
                                unset($user_activities[0]);
                                foreach ($user_activities as $key => $a) {
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
                                                </div> 
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>

                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane  active" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
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
                                                            echo'<span class="label label-danger">' . $vote['name'] . '</span>' . $vote['count'] . '&nbsp;&nbsp;&nbsp;';
                                                        }
                                                        echo '<br>Category : <button type="button" class="btn btn-success">' . $post['category_name'] . '</button><br>';
                                                        echo '<a href="' . base_url('Post/view/' . encrypt($post['id'])) . '">View</a>';
                                                        echo $post['post_description'];
                                                    }
                                                    ?> 
                                                </div> 
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>

                                <!-- END timeline item -->
                                <li>
                                    <i class="fa fa-clock-o bg-gray"></i>
                                </li>
                            </ul>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="settings">
                            <strong class="text-center">Update General Settings</strong>
                            <form class="form-horizontal" action="<?php echo base_url('User/profile'); ?>" name="profileForm" method="POST">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Username</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName" value="<?php echo $userdetails['username'] ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" value="<?php echo $userdetails['email'] ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name" id="inputName" value="<?php echo $userdetails['name'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="col-sm-2 control-label">Profile Video</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="profile_video" id="youtube_url" value="<?php echo $userdetails['profile_video']; ?>" type="text"required>
                                        <?php
                                        $string = explode('?v=', $userdetails['profile_video']);
                                        echo'<iframe class="img-responsive" src="https://www.youtube-nocookie.com/embed/' . $string[1] . '?rel=0"></iframe>';
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Update</button>
                                    </div>
                                </div>
                            </form> <hr>
                            Update Profile Image
                            <form class="form-horizontal" id="userImageForm" action="<?php echo base_url('User/update_user_image/' . encrypt($userdetails['id'])); ?>" method="POST" enctype="multipart/form-data">
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
                            </form> <hr>
                            Reset Password
                            <form class="form-horizontal" id="updpwdform" action="<?php echo base_url('User/update_password/' . encrypt($userdetails['id'])); ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Current Password</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="cpassword" required>
                                        <input type="hidden" value="<?php echo $userdetails['password']; ?>" name="password"/>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">New Password</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="npassword" required>
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Confirm New Password</label>

                                    <div class="col-sm-10">
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
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<?php $this->load->view('dashboard/footer'); ?>
<script>
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

    $(document).on('blur', '#youtube_url', function () {
        var url = $(this).val().split("?v=");
        url = url[1];
        $('#youtube_frame').attr('src', 'https://www.youtube-nocookie.com/embed/' + url + '?rel=0');
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
                setTimeout(function () {
                    location.reload();
                }, 3000);

            } else {
                toastr.error(data.message);
            }

        }, 'json');
    });
</script>