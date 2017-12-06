
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>World Stars Gram</title>

        <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" type="text/css">
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/assets/css/font-awesome.min.css">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/mega-menu.css'); ?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/theme-color.css'); ?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css'); ?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.css'); ?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.bxslider.css'); ?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/prettyPhoto.css'); ?>" type="text/css">

        <link rel="stylesheet" href="<?php echo base_url('assets/css/audioplayer.css'); ?>" type="text/css">

        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900' rel='stylesheet' type='text/css'>
        
        <link rel="stylesheet" href="<?php echo base_url('assets/dashboard/plugins/toastr/toastr.css');?>">
        <style>
            #wrapper #pop .owl-controls, #wrapper #hiphop .owl-controls, #wrapper .carousel .owl-controls {
                position: absolute;
                right: 8px;
                top: -42px;
            }
            #wrapper #pop .owl-controls .owl-nav [class*="owl-"], #wrapper #hiphop .owl-controls .owl-nav [class*="owl-"], #wrapper .carousel .owl-controls .owl-nav [class*="owl-"] {
                background: none;
                font-size: 0px;
                padding: 0 0 0 7px;
                margin: 0px;
            }
            .cp-heading-outer .view-all {
                margin-right: 50px;
            }
            #wrapper #pop .owl-nav .owl-prev:before,
            #wrapper #hiphop .owl-nav .owl-prev:before,
            #wrapper .carousel .owl-nav .owl-prev:before {
                font-family: 'FontAwesome';
                content: '\f191';
                font-size: 18px;
                color: #bbbbbb;
            }
            #wrapper #pop .owl-nav .owl-next:before,
            #wrapper #hiphop .owl-nav .owl-next:before,
            #wrapper .carousel .owl-nav .owl-next:before {
                content: '\f152';
                font-family: 'FontAwesome';
                font-size: 18px;
                color: #bbbbbb;
            }
            #pop .owl-controls {
                position: absolute;
                right: 8px;
                top: -42px;
            }
            #pop .owl-controls .owl-nav div {
                background: none;
                font-size: 0px;
                padding: 0 0 0 7px;
                margin: 0px;
            }
            .cp-nav-holder {
                width: auto;
                margin: 0px auto;
                float: none !important;
                display: table;
            }
        </style>

    </head>
    <body>
        <?php
        $categories = get_categories();
        ?>
        <div id="wrapper">

            <header class="cp_header">

                <div class="cp-navigation-row">

                    <div id="cp_side-menu"> <span id="cp-close-btn"><a href="<?php echo base_url();?>#"><i class="fa fa-times"></i></a></span>
                        <div class="cp_side-navigation">
                            <ul class="cp-social-links">
                                <li><a href="<?php echo base_url();?>#"><i class="fa fa-facebook-square"></i></a></li>
                                <li><a href="<?php echo base_url();?>#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="<?php echo base_url();?>#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="<?php echo base_url();?>#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="<?php echo base_url();?>#"><i class="fa fa-heart-o"></i></a></li>
                                <li><a href="<?php echo base_url();?>#"><i class="fa fa-envelope"></i></a></li>
                                <li><a href="<?php echo base_url();?>#"><i class="fa fa-rss"></i></a></li>
                            </ul>
                            <div class="cp-right-outer">
                                <ul class="navbar-nav">

                                    <li class="dropdown"><a href="category-fashion.html#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SERVICES <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#"> Digital Distribution </a></li>
                                            <li><a href="#">WorldStarGram Marketing Services </a></li>
                                            <li><a href="#">WorldStarGram Video Marketing</a></li>
                                            <li><a href="#">WorldStarGram Radio Marketing</a></li>
                                            <li><a href="#">SYNC Services</a></li>
                                            <li><a href="#">Social Media Push</a></li>

                                        </ul>
                                    </li>

                                    </li>
                                    <li><a href="<?php echo base_url();?>#">NEW RELEASES</a>

                                    </li>
                                    <li><a href="<?php echo base_url();?>#" >COMPETITIONS</a>

                                    </li>
                                    <li class="dropdown"><a href="home-v2.html#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">NEWS <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="post-blog.html">STREET NEWS </a></li>

                                        </ul>
                                    </li>
                                    <li><a href="<?php echo base_url();?>#">SPOTLIGHT</a>

                                    </li>
                                    <li><a href="<?php echo base_url();?>#">VOTE</a>

                                    </li>
                                    <li><a href="contact-us.html">SUBMIT YOUR AUDITIONS</a> </li>
                                </ul>
                                <form action="#" method="get" class="cp-search-form-outer">
                                    <div class="cp-search-form-outer">
                                        <input type="text" placeholder="Search..." required>
                                        <button class="btn-submit" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                    <label>... or choose a category on right.</label>
                                </form>
                                <div class="cp-upload-outer"> <a href="<?php echo base_url();?>#" class="file-btn">Upload</a>
                                    <ul class="cp-listed">
                                        <li class="login-btn"><i class="fa fa-sign-in"></i> <a href="/login">Log in</a></li>
                                        <li class="signup-btn"><a href="/register">Sign Up</a> <i class="fa fa-cart-plus"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-right:0px;">

                                <div id="cp_side-menu-btn" class="cp_side-menu"> <a href="<?php echo base_url();?>#" class=""><i class="fa fa-bars"></i></a> </div>


                                <strong class="cp-logo"> <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/images//logo1.png'); ?>" style="width:250px" alt=""></a> </strong>




                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12" style="padding-left:0px;">

                                <div class="cp-right-holder"> 
                                                                        
                                    <?
                                    if (!is_loggedin()) {
                                    ?>
                                    <a href="<?php echo base_url('User/login'); ?>" class="file-btn"><i class="fa fa-sign-in" style="margin-right:5px;" aria-hidden="true"></i>Signin</a>
                                    <a style="margin-left:5px;" href="<?php echo base_url('User/register'); ?>" class="file-btn"><i class="fa fa-user-plus" style="margin-right:5px;" aria-hidden="true"></i>Register</a>
                                    <?
                                    }else{?>
                                    <a href="<?php echo base_url('User/home'); ?>" class="file-btn"><?php $userinfo = userdetails(); echo $userinfo['username'];?>
                                    </a>
                                    <a href="<?php echo base_url('User/Signout'); ?>" class="file-btn"><i class="fa fa-sign-out" style="margin-right:5px;" aria-hidden="true"></i>SignOut                                    </a>
                                    <?
                                    
                                    }
                                    ?>





                                    <a style="margin-left:5px;" href="<?php echo base_url();?>#" class="file-btn">Voting</a>



                                    <ul class="cp-social-links">
                                        <li><a href="<?php echo base_url();?>#"><i class="fa fa-facebook-square"></i></a></li>
                                        <li><a href="<?php echo base_url();?>#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                                        <li><a href="<?php echo base_url();?>#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                        <li><a href="<?php echo base_url();?>#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="<?php echo base_url();?>#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                        <li><a href="<?php echo base_url();?>#"><i class="fa fa-google-plus"></i></a></li>

                                        <li class="cp-search-holder"><i class="fa fa-search"></i>
                                            <form action="" method="get" class="cp-search-form-outer">
                                                <input type="text" placeholder="Search..." required>
                                                <button class="btn-submit" type="submit"><i class="fa fa-search"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                    <a style="margin-left:5px;" href="<?php echo base_url();?>#" class="file-btn">SUBMIT VIDEOS </a>
                                    <a style="margin-left:5px;" href="<?php echo base_url();?>#" class="file-btn">FAQs </a>
                                </div>

                            </div>
                            <div class="col-md-12"><div class="cp-nav-holder">
                                    <div class="cp-megamenu">
                                        <div class="cp-mega-menu">
                                            <label for="mobile-button"> <img src="<?php echo base_url('assets/images//menu-bar.png');?>" alt=""> </label>

                                            <input id="mobile-button" type="checkbox">
                                            <ul class="main-menu">
                                                  <li><a href="<?php echo base_url();?>">Home</a></li>
                                                <?php
                                                foreach ($categories as $level1) {
                                                    echo'<li><a href="'.base_url('site/posts/'.encrypt($level1['id'])).'">' . $level1['category_name'];
                                                    if (isset($level1['level2'])) {
                                                        echo'<i class="fa fa-angle-down" aria-hidden="true"></i></a>';
                                                        echo'<ul class="drop-down one-column hover-fade">';
                                                        foreach ($level1['level2'] as $level2) {
                                                            echo'<li> <a href="'.base_url('site/posts/'.encrypt($level2['id'])).'">' . $level2['category_name'] . '</a>';

                                                            if (isset($level2['level3'])) {
                                                                echo'<i class="fa fa-angle-right"></i>';
                                                                echo'<ul class="drop-down one-column hover-fade">';
                                                                foreach ($level2['level3'] as $level3) {
                                                                    echo'<li> <a href="'.base_url('site/posts/'.encrypt($level3['id'])).'">' . $level3['category_name'] . '</a>' .
                                                                    '</li>';
                                                                }
                                                                echo'</ul>';
                                                            }
                                                            echo'<li>';
                                                        }
                                                        echo'</ul>';
                                                    } else {
                                                        echo'</a>';
                                                    }
                                                    echo'</li>';
                                                }
                                                ?>
                                                <!--                                                <li><a href="<?php echo base_url();?>#">Home</a></li>
                                                
                                                
                                                                                                <li> <a href="Charts.html#">Charts</a>
                                                
                                                                                                </li>
                                                                                                <li> <a href="music.html">Music <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                                                                                    <ul class="drop-down one-column hover-fade">
                                                
                                                                                                        <li> <a href="category-fashion.html#">INTERNATIONAL</a><i class="fa fa-angle-right"></i>
                                                                                                            <ul class="drop-down one-column hover-expand">
                                                
                                                                                                                <li><a href="CARIBBEAN.html"> CARIBBEAN </a></li>
                                                                                                                <li><a href="africa.html"> AFRICA </a></li>
                                                
                                                                                                            </ul>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </li>
                                                
                                                                                                </li>
                                                                                                <li> <a href="dance.html">Dance</a>
                                                
                                                                                                </li>
                                                                                                <li> <a href="fashion.html">Fashion</a>
                                                
                                                                                                </li>
                                                
                                                
                                                                                                <li> <a href="sports.html">Sports</a>
                                                                                                </li>
                                                
                                                
                                                                                                <li> <a href="comedy.html">Comedy</a> </li>
                                                
                                                                                                <li> <a href="movies.html">News</a> </li>
                                                
                                                
                                                                                                <li> <a href="students.html">Spotlight</a> </li>
                                                
                                                
                                                                                                <li> <a href="games.html">Services</a> </li>
                                                
                                                
                                                -->

                                            </ul>
                                        </div>
                                    </div>
                                </div></div>
                        </div>
                    </div>
                </div>

            </header>
           