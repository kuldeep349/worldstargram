<?php $userinfo = userdetails();
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>World Star Gram</title> 
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <link rel="stylesheet" href="<?php echo base_url('assets/dashboard/bootstrap/css/bootstrap.min.css'); ?>">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/css/AdminLTE.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/css/skins/skin-red.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/dashboard/plugins/toastr/toastr.css'); ?>">
    </head>

    <body class="hold-transition skin-red sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <a href="<?php echo base_url(); ?>" class="logo">
                    <span class="logo-mini"><b>W</b>S<b>G</b></span>
                    <span class="logo-lg"><img style="height: -webkit-fill-available;" src="<?php echo base_url('assets/images/logo1.png') ?>"></span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <?php if ($userinfo['role'] == 'A') {
                        ?>
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>
                    <?php } ?>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('uploads/' . $userinfo['image']); ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?php echo $userinfo['username']; ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo base_url('uploads/' . $userinfo['image']); ?>" class="img-circle" alt="User Image">
                                        <p><?php echo $userinfo['username']; ?>
                                            <small><?php echo $userinfo['email']; ?></small>
                                        </p>
                                    </li>
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo base_url('User/Profile'); ?>" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url('User/Signout'); ?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>
            <?php if ($userinfo['role'] == 'A') {
                ?>
                <aside class="main-sidebar">
                    <section class="sidebar">
                        <ul class="sidebar-menu">
                            <li class="active"><a href="<?php echo base_url('Dashboard'); ?>"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>

                            <li class="active"><a href="<?php echo base_url('Categories'); ?>"><i class="fa fa-link"></i> <span>Categories</span></a></li>
                            <li><a href="<?php echo base_url('User'); ?>"><i class="fa fa-link"></i> <span>Users</span></a></li>
                            <li class="treeview">
                                <a href="#"><i class="fa fa-link"></i> <span>Contestants</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $categories = get_all_categories();
                                    foreach ($categories as $category) {
                                        echo'<li><a href="' . base_url('Post/posts_list/' . encrypt($category['id'])) . '">' . $category['category_name'] . '</a></li>';
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                        <!-- /.sidebar-menu -->
                    </section>
                    <!-- /.sidebar -->
                </aside>
                <?php
            }
            ?>