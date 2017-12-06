<?php $this->load->view('dashboard/header'); ?>
<style>
    img#result {
        max-width: 50%;
        height: auto;
    }
</style>
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
        <div class="col-md-6">
            <div class="box box-danger box-solid">
                <div class="box-header">
                    <h3 class="box-title">Add Cover Photo</h3>
                </div>
                <div class="box-body">
                    <form method="POST" action="<?php echo base_url('post/add_image'); ?>" id="add_post_image" enctype="multipart/form-data">
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
                            <select name="parent_id" id="level1category" class="form-control" required>
                                <option disabled selected value> -- select an option -- </option>
                                <?php
                                $categories = get_post_categories();
                                foreach ($categories as $category) {
                                    echo'<option value=' . $category['id'] . '">' . $category['category_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div id="cropImage">
                                <input id="file" type="file" name="image_file" onchange="readURL(this);"  accept="image/jpeg" required>
                                <span class="mailbox-attachment-icon has-img"><img src="<?php echo base_url('assets/images/img_not_available.png') ?>" id="result" alt="Attachment"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" id="image_category_id">
                            <button type="submit" class="btn btn-primary" id="image_button">Upload Photo</button>
                        </div>

                    </form>
                </div>
                <!-- /.box-body -->
                <!-- Loading (remove the following to stop the loading)-->
                <div class="overlay" id="image_overlay" style="display:none;">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>
                <!-- end loading -->
            </div>
            <!-- /.box -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('dashboard/footer'); ?>
<script>
    $(document).on('submit', '#add_post_image', function (e) {
        e.preventDefault();
        var image = $('#result').attr('src');
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
                     location.reload();
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
</script>