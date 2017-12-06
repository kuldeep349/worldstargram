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
                    <form method="POST" action="<?php echo base_url('post/add_youtube_video'); ?>" id="add_youtube_video">
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
                        <div class="form-group">
                            <label for="exampleInputPassword1">Paste url here</label>
                            <input type="text" class="form-control" name="youtube_url" id="youtube_url" type="text"required>
                            <iframe id="youtube_frame" width="420" height="315" src="">
                            </iframe>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="">Upload video</button>
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
    $(document).on('submit', '#add_youtube_video', function (e) {
        e.preventDefault();
        var url, formData;
        url = $(this).attr('action');
        formData = $(this).serialize();
        $('#image_overlay').css('display', 'block');
        $.post(url, formData, function (data) {
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
                $('#youtube_frame')
                        .attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).on('blur', '#youtube_url', function () {
        var url = $(this).val();
        $('#youtube_frame').attr('src', url);
    });

</script>