<?php $this->load->view('dashboard/header'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            This is page Content
            <small>Optional description</small>
        </h1>
        <?php
        userdetails();
        ?>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Create Post</a></li>
            <li class="active">Add Image</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">  
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Responsive Hover Table</h3>

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
                        <table class="table table-hover">
                            <tr>
                                <th>Sr.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            foreach ($users as $key => $user) {
                                $num = $key + 1;
                                $html = '';
                                $html .= '<tr>';
                                $html .= '<td>' . $num . '</td>';
                                $html .= '<td>' . $user['username'] . '</td>';
                                $html .= '<td>' . $user['email'] . '</td>';
                                $html .= '<td>' . get_date($user['created_at']) . '</td><td>';
                                if ($user['status'] == 0) {
                                    $html .= '<button id = "btn' . encrypt($user['id']) . '" type="button" class="btn btn-success stsbtn" data-url=' . base_url('User/update_status/' . encrypt($user['id'])) . ' data-id=' . encrypt($user['id']) . ' data-status=1 > Allow</button>';
                                } else {
                                    $html .= '<button id = "btn' . encrypt($user['id']) . '"  type="button" class="btn btn-danger stsbtn" data-url=' . base_url('User/update_status/' . encrypt($user['id'])) . ' data-id=' . encrypt($user['id']) . ' data-status=0 > Block</button>';
                                }
                                $html .= '</td></tr>';
                                echo $html;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>
<?php $this->load->view('dashboard/footer'); ?>
<script>
    $(document).on('click', '.stsbtn', function () {
        var id, url, formData;
        url = $(this).data('url');
        id = '#' + $(this).attr('id');
        formData = 'status=' + $(this).data('status');
        $.post(url, formData, function (response) {
            if (response.success == 1) {
                $(id).replaceWith(response.html);
                toastr.success(response.message);
            }else
                toastr.errorss(response.message);
        }, 'json');
    });
</script>