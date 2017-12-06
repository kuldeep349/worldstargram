<?php $this->load->view('dashboard/header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">  
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Manage Posts</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <?php if (count($posts)) {
                            ?>
                            <table class="table table-hover">
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Title</th>
                                    <th>Cover</th>
                                    <th>Category</th>
                                    <th>Views</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                                <?php
                                rsort($posts);
                                foreach ($posts as $key => $post) {
                                    $post = get_post_details($post['id']);
                                    $votes = $post['votes']['post_votes'];
                                    ?>
                                    <tr>
                                        <td><? echo $key + 1 ; ?></td>
                                        <td><? echo $post['post_title']; ?></td>
                                        <td>
                                            <?php
                                            if ($post['media_type'] == 'image')
                                                echo'<img src="' . base_url('uploads/' . $post['path']) . '" height="50px" width="50px">';
                                            elseif ($post['media_type'] == 'youtube')
                                                echo'<img src="https://media.tenor.com/images/6d7761cb85acdb185ca243821e1b7339/tenor.gif" height="50px" width="50px">';
                                            ?>

                                        </td>
                                        <td><? echo $post['category_name']; ?></td>
                                        <td>
                                            <?php
                                            foreach ($votes as $vote) {
//                                                pr($vote);
                                                echo'<span class="label label-danger">' . $vote['name'] . '</span>'.$vote['count'] .'<br>';
                                            }
                                        
                                        ?>

                                    </td>
                                        <td><? echo $post['username']; ?></td>
                                    <td><a type="button" class="btn btn-warning" href="<?php echo base_url('Post/view/' . encrypt($post['id'])); ?>">View</a></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                            <?php
                        } else {
                            echo'No posts yet';
                        }
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('dashboard/footer'); ?>