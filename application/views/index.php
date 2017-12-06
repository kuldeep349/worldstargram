<?php $this->load->view('header'); ?>
<div class="col-md-12 mainbg">
    <div class="container">

        <div class="row">
            <div class="center">
                <div class="col-md-1 col-md-offset-2  color-white text-center padding32">
                    <a class="sub-menu" href="store.html"><i class="fa fa-home font-40" aria-hidden="true"></i>
                        <p class="color-white font-13">STORE</p></a>
                </div>
                <div class="col-md-1  color-white text-center">
                    <a class="sub-menu" href="radio.html">
                        <img src="assets/images//radio.png">
                        <p class="color-white font-13">RADIO</p>
                    </a>
                </div>
                <div class="col-md-1  color-white text-center">
                    <a class="sub-menu" href="television.html">
                        <i class="fa fa-television font-40" aria-hidden="true"></i>
                        <p class="color-white font-13">TELEVISION</p>
                    </a>
                </div>
                <div class="col-md-1  color-white text-center">
                    <a class="sub-menu" href="concerts.html">
                        <i class="fa fa-users font-40" aria-hidden="true"></i>

                        <p class="color-white font-13">CONCERTS</p>
                    </a>
                </div>
                <div class="col-md-1  color-white text-center">
                    <a class="sub-menu" href="Wall of fame.html">
                        <i class="fa fa-mobile font-40" aria-hidden="true"></i>

                        <p class="color-white font-13">WALL OF FAME</p>
                    </a>
                </div>
                <div class="col-md-1  color-white text-center">
                    <a class="sub-menu" href="prizes.html">
                        <i class="fa fa-gift font-40" aria-hidden="true"></i>

                        <p class="color-white font-13">PRIZES</p>
                    </a>
                </div>
                <div class="col-md-1  color-white text-center">
                    <a class="sub-menu" href="fund me.html">
                        <i class="fa fa-money font-40" aria-hidden="true"></i>

                        <p class="color-white font-13">FUNDME</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="cp_banner_full_width">
    <div class="cp-slider-block">
        <div class="cp_banner">
            <div class="owl-carousel" id="cp-video-slider">
                <div class="item"> <img src="assets/images//grid-slide1.jpg" alt="">
                    <div class="cp-banner-caption">
                        <div class="inner-holder">
                            <div class="banner-top-text"> <strong class="banner-title">Fashion</strong>
                                <p>Experience 100 Years of American Fashion in This 2-Minute Video</p>
                            </div>
                            <a href="index.html#" class="cp-btn-style1">Watch Video</a>
                        </div>
                    </div>

                </div>
                <div class="item"> <img src="assets/images//grid-slide2.jpg" alt="">

                    <div class="cp-banner-caption">
                        <div class="inner-holder">
                            <div class="banner-top-text"> <strong class="banner-title">Music</strong>
                                <p>Experience 100 Years of American Fashion in This 2-Minute Video</p>
                            </div>
                            <a href="index.html#" class="cp-btn-style1">Watch Video</a>
                        </div>
                    </div>
                </div>
                <div class="item"> <img src="assets/images//grid-slide3.jpg" alt="">
                    <div class="cp-banner-caption">
                        <div class="inner-holder">
                            <div class="banner-top-text"> <strong class="banner-title">Trailer</strong>
                                <p>Experience 100 Years of American Fashion in This 2-Minute Video</p>
                            </div>
                            <a href="index.html#" class="cp-btn-style1">Watch Video</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="cp-video-grid-block">
        <ul class="cp-video-grid-listing">
            <li class="cp-vgl-holder m2 p2">
                <div class="cp-thumb">
                    <img src="assets/images//grid-slide4.jpg" alt="">
                    <div class="cp-caption">
                        <a class="play-video" href="video.html">Play</a>
                        <h4>Casual & Dressy Fashion Outfits</h4>
                        <strong>by Jiana Smith</strong>
                    </div>
                </div>
            </li>
            <li class="cp-vgl-holder m2 p2">
                <div class="cp-thumb">
                    <img src="assets/images//grid-slide5.jpg" alt="">
                    <div class="cp-caption">
                        <a class="play-video" href="video.html">Play</a>
                        <h4>Blacker than black: Custom Motorcycles </h4>
                        <strong>by Jiana Smith</strong>
                    </div>
                </div>
            </li>
            <li class="cp-vgl-holder p2">
                <div class="cp-thumb">
                    <img src="assets/images//grid-slide6.jpg" alt="">
                    <div class="cp-caption">
                        <a class="play-video" href="video.html">Play</a>
                        <h4>The best nightlife for dancing.</h4>
                        <strong>by Jiana Smith</strong>
                    </div>
                </div>
            </li>
            <li class="cp-vgl-holder p2">
                <div class="cp-thumb">
                    <img src="assets/images//grid-slide7.jpg" alt="">
                    <div class="cp-caption">
                        <a class="play-video" href="video.html">Play</a>
                        <h4>MISSED with my best friend</h4>
                        <strong>by Jiana Smith</strong>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div id="cp-main-content">
    <section class="cp-section pd-tb60">
        <div class="container">
            <section>
                <div class="row">
                    <!--code starts here-->
                    <?php
                    foreach ($categories as $category) {
                        if (is_array($category['posts'])) {
                            ?>
                            <div class="col-md-12 text-center margin-top50 fullb"><h3 class="fullb"></h3></div>
                            <div class="col-md-12 cp-heading-outer margin-top50">
                                <h2><?php echo $category['category_name']; ?></h2>
                                <ul class="cp-listed">
                                    <li class="view-all"><a href="<?php echo base_url('site/posts/' . $category['id']); ?>">View All:</a></li>
                                </ul>
                            </div> 
                            <div class="carousel">
                                <?php
                                foreach ($category['posts'] as $post) {
                                    echo'<div class="item margin-top10">';

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
                                    echo'</div>';
                                }
                                ?>
                            </div>
                            <div class="col-md-12 text-center margin-top30">
                                <a class="bigbtn" href="<?php echo base_url('site/posts/' . $category['id']); ?>">CLICK HERE FOR MORE</a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <!---code ends here-->
                </div>
            </section>
            <div class="cp-outer-holder pd-t60">
                <div class="row">
                    <div class="col-md-9">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="cp-today-video">
        <div class="container">
            <div class="row">
                <div class="cp-heading-outer">
                    <h2>WORLDSTARGRAM VIDEOS OF THE DAY</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <ul class="today-videos">
                        <li>
                            <iframe src="https://player.vimeo.com/video/116214074"></iframe>
                        </li>
                        <li>
                            <iframe src="https://player.vimeo.com/video/63344039"></iframe>
                        </li>
                        <li>
                            <iframe src="https://player.vimeo.com/video/90840341"></iframe>
                        </li>
                        <li>
                            <iframe src="https://player.vimeo.com/video/116214074"></iframe>
                        </li>
                        <li>
                            <iframe src="https://player.vimeo.com/video/63344039"></iframe>
                        </li>
                    </ul>
                    <div id="bx-pager">
                        <a data-slide-index="0" href="index.html"><img src="assets/images//tv-1.jpg" alt=""> <strong>Always something good </strong> </a>
                        <a data-slide-index="1" href="index.html"><img src="assets/images//tv-2.jpg" alt=""> <strong> Olly Murs – Heart Skips a Beat</strong> </a>
                        <a data-slide-index="2" href="index.html"><img src="assets/images//tv-3.jpg" alt=""> <strong> What Is Stressing hese People Out?</strong> </a>
                        <a data-slide-index="3" href="index.html"><img src="assets/images//tv-4.jpg" alt=""> <strong> Waters Fourth Winged</strong> </a>
                        <a data-slide-index="4" href="index.html"><img src="assets/images//tv-5.jpg" alt=""> <strong> You should FIRE Designspiration </strong> </a> </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </div>
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