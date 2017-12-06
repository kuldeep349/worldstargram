<?php $this->load->view('dashboard/header'); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/bootstrap/css/dragdrop.css') ?>">
<style type="text/css">
    i.fa.fa-fw.fa-trash-o.pull-right.deletemenu { margin: -27px -37px;}
    i.editmenu { margin: -26px -21px}

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage menu's
 <!--            <small>Optional description</small>-->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Menu's</a></li>
            <li class="active">Here</li>
        </ol>
<!--        <div class="col-md-8">
            <div class="alert alert-danger col-md-12 pull-right " role="alert">
                <strong>Well done!</strong> You successfully read this important alert message.
            </div>
            <div class="alert alert-danger col-md-12 pull-right" role="alert">
                <strong>Well done!</strong> You successfully read this important alert message.
            </div>
            <div class="alert alert-info col-md-11 pull-right" role="alert">
                <strong>Well done!</strong> You successfully read this important alert message.
            </div>
            <div class="alert alert-warning col-md-10 pull-right" role="alert">
                <strong>Well done!</strong> You successfully read this important alert message.
            </div>
        </div>-->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="col-md-8">
            <div id="listMenu">
            </div>
            <div class="cf nestable-lists">
                <div class="dd" id="nestable">
                    <?php
//                    $icons = '<i class="fa fa-fw fa-trash-o pull-right deletemenu"></i><i class="fa fa-fw fa-edit pull-right editmenu"></i>';
//                    if (count($categories)) {
//                        echo'<ol class="dd-list">';
//                        foreach ($categories as $level1) {
//                            echo' <li class="dd-item" data-id="1">
//                                     <div class="dd-handle">' . $level1['category_name'] . '</div>
//                                    </li>';
//                            if (isset($level1['level2'])) {
//                                echo'<ol class="dd-list">';
//                                foreach ($level1['level2'] as $level2) {
//                                    echo' <li class="dd-item" data-id="1">
//                                     <div class="dd-handle">' . $level2['category_name'] . '</div>
//                                    </li>';
//                                    if (isset($level2['level3'])) {
//                                        echo'<ol class="dd-list">';
//                                        foreach ($level2['level3'] as $level3) {
//                                            echo' <li class="dd-item cls"><div class="dd-handle" data-id="1">'.$level3['category_name'].'</div><div class="menu-icons"></div></li>';
//                                            echo'</ol>';
//                                        }
//                                    }
//                                    echo'</ol>';
//                                }
//                            }
//                        }
//                        echo'</ol>';
//                    }
//                    echo'<pre>';
//                    print_r($categories);
//                    echo'</pre>';
                    ?>
                    <!--                    <ol class="dd-list">
                                            <li class="dd-item" data-id="1">
                                                <div class="dd-handle">Item 1</div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">Item 2</div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="3"><div class="dd-handle">Item 3</div></li>
                                                    <li class="dd-item" data-id="4"><div class="dd-handle">Item 4</div></li>
                                                    <li class="dd-item" data-id="5">
                                                        <div class="dd-handle">Item 5</div>
                                                        <ol class="dd-list">
                                                            <li class="dd-item" data-id="6"><div class="dd-handle">Item 6</div></li>
                                                            <li class="dd-item" data-id="7"><div class="dd-handle">Item 7</div></li>
                                                            <li class="dd-item" data-id="8"><div class="dd-handle">Item 8</div></li>
                                                        </ol>
                                                    </li>
                                                    <li class="dd-item" data-id="9"><div class="dd-handle">Item 9</div></li>
                                                    <li class="dd-item" data-id="10"><div class="dd-handle">Item 10</div></li>
                                                </ol>
                                            </li>
                                            <li class="dd-item" data-id="11">
                                                <div class="dd-handle">Item 11</div>
                                            </li>
                                            <li class="dd-item" data-id="12">
                                                <div class="dd-handle">Item 12</div>
                                            </li>
                                        </ol>-->
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <button type="button" data-toggle="modal" data-target="#modalmenulevel1" class="btn btn-block btn-default btn-lg">Add Level 1 Menu</button>
            <button type="button" data-toggle="modal" data-target="#modalmenulevel2" class="btn btn-block btn-default btn-lg">Add Level 2 Menu</button>
            <button type="button" data-toggle="modal" data-target="#modalmenulevel3" class="btn btn-block btn-default btn-lg">Add Level 3 Menu</button>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modalmenulevel1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Level 1 Menu</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal AddMenuForm" method="post" action="<?php echo base_url('Categories/create_level1'); ?>" id="level1MenuForm" >
                    <div class="box-body">
                        <div class="form-group">
                            <label for="menuName1" class="col-sm-3 control-label">Menu Name</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="menu_name" placeholder="Menu">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Create</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<div class="modal fade" id="modalmenulevel2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Level 2 Menu</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal AddMenuForm" action="<?php echo base_url('Categories/create_level2'); ?>" method="post" id="level2MenuForm">
                    <div class="box-body">
                        <div class="form-group"> 
                            <label for="menuName1" class="col-sm-3 control-label">Menu 1</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="parent_id">
                                    <?php
                                    foreach ($categories as $category) {
                                        echo'<option value="' . $category['id'] . '">' . $category['category_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="menuName1" class="col-sm-3 control-label">Menu Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="" name="menu_name" placeholder="Menu">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Create</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<div class="modal fade" id="modalmenulevel3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Level 2 Menu</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal AddMenuForm" action="<?php echo base_url('Categories/create_level3'); ?>" method="post" id="level3MenuForm">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="menuName1" class="col-sm-3 control-label">Menu 1</label>
                            <div class="col-sm-9">
                                <select class="form-control level1categories">
                                    <?php
                                    foreach ($categories as $category) {
                                        if (isset($category['level2'])) {
                                            echo'<option value="' . ($category['id']) . '">' . $category['category_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="menuName1" class="col-sm-3 control-label">Menu 2</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="level2categories" name="parent_id">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="menuName1" class="col-sm-3 control-label">Menu Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="menu_name" id="" placeholder="Menu">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Create</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<div class="modal fade updatemenu" id="modalupdatemenu">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Menu</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal AddMenuForm" method="post" action="<?php echo base_url('Categories/Update_menu'); ?>" id="UpdateMenuForm" >
                    <div class="box-body">
                        <div class="form-group" id="updatemenu1">
                            <label for="menuName1" class="col-sm-3 control-label">Menu 1</label>
                            <div class="col-sm-9">
                                <select class="form-control level1categories" id="updatelevel1">
                                    <?php
                                    foreach ($categories as $category) {
                                        if (isset($category['level2'])) {
                                            //echo'<option value="'.encrypt($category['id']).'">'.$category['category_name'].'</option>';
                                            echo'<option value="' . ($category['id']) . '">' . $category['category_name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="updatemenu2">
                            <label for="menuName1" class="col-sm-3 control-label">Menu 2</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="updatelevel2categories">
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="menuName1" class="col-sm-3 control-label">Menu Name</label>
                            <div class="col-sm-9">
                                <input type="hidden" id="updateparent_id" name="parent_id">
                                <input type="hidden" id="updatelevel" name="level">
                                <input type="hidden" id="updatemenuid" name="id">
                                <input type="text" class="form-control" id="updatemenu_name" name="menu_name" placeholder="Menu">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="homeview" id="homecheckview"> Display On Homepage
                                    </label>
                                </div>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="menuName1" class="col-sm-3 control-label">Youtube Url</label>
                            <div class="col-sm-9">
                                 <input type="text" class="form-control" id="youtube_url" name="youtube_url" placeholder="Menu">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
<?php $this->load->view('dashboard/footer'); ?>
<script>
    $(document).on('click', '.editmenu', function ()
    {
        var id = $(this).parents('.menu-icons').siblings('.dd-handle').data('id');
        var level = $(this).parents('.menu-icons').siblings('.dd-handle').data('level');
        var homeview = $(this).parents('.menu-icons').siblings('.dd-handle').data('homeview');
        var youtube_url = $(this).parents('.menu-icons').siblings('.dd-handle').data('youtube_url');
        $('#youtube_url').val(youtube_url);
        if(homeview == 1 )
            $('#homecheckview').attr('checked', true);
        else
            $('#homecheckview').attr('checked', false);
        $('#updatemenu_name').val($(this).parents('.menu-icons').siblings('.dd-handle').text());
        $('#updatelevel2categories').html('');
        $('#updateparent_id').val('');
        $('#updatelevel').val(level);
        $('#updatemenuid').val(id);
        if (level == 1) {
            $('#updatemenu1').hide();
            $('#updatemenu2').hide();
            $('#updateparent_id').val(null);
        } else if (level == 2)
        {
            var parent_id = $(this).parents('.menu-icons').siblings('.dd-handle').data('parent_id');
            $('#updatemenu1').show();
            $('#updatemenu2').hide();
            $('#updatelevel1').val(parent_id);
            $('#updateparent_id').val(parent_id);
        } else {
            $('#updatelevel1').val($(this).parents('.menu-icons').siblings('.dd-handle').data('level1parent_id'));
            var parent_id = $(this).parents('.menu-icons').siblings('.dd-handle').data('level1parent_id');
            $.post('categories/get_level2_categories/' + parent_id, function (response) {

                $.each(response, function (key, value) {
                    $('#updatelevel2categories').append('<option value="' + value.id + '">' + value.category_name + '</option>');
                });
            }, 'json');
            $('#updateparent_id').val(parent_id);
            $('#updatemenu1').show();
            $('#updatemenu2').show();
        }
    });
    $(document).on('change', '#updatelevel1', function () {
        $('#updateparent_id').val($(this).val());
    });
    $(document).on('submit', '.AddMenuForm', function (e) {
        e.preventDefault();
        var url, formData;
        url = $(this).attr('action');
        formData = $(this).serialize();
        $.post(url, formData, function (response) {
            alert(response.message);
            if (response.success == 1)
                location.reload();
        }, 'json');
    });

</script>
<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<script src="<?php echo base_url('assets/dashboard/dist/js/jquery.nestable.js'); ?>"></script>
<script>
    $(document).on('change', '.level1categories', function (response) {
        var id = $(this).val();
        $.post('categories/get_level2_categories/' + id, function (response) {
            $('#level2categories').html('');
            $.each(response, function (key, value) {
                $('#level2categories').append('<option value="' + value.id + '">' + value.category_name + '</option>');
            });
        }, 'json');
    });
    $(document).on('click', '.deletemenu', function ()
    {
        var txt;
        var r = confirm("Are you really Want to delete this Menu!");
        if (r == true) {
            var id = $(this).parents('.menu-icons').siblings('.dd-handle').data('id');
            $.post('<?php echo base_url('categories/delete_category/'); ?>' + id, function (response) {
                alert(response.message);
                if (response.success === 1) {
                    location.reload();
                }
            }, 'json');
        }
    });

// Get the size of an object
    $(document).ready(function ()
    {
        var trashIcon, editIcon;
        trashIcon = '<i class="fa fa-fw fa-trash-o pull-right deletemenu"></i>';
        editIcon = '<i class="fa fa-fw fa-edit pull-right editmenu" data-toggle="modal" data-target=".updatemenu"></i>';

        Object.size = function (obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key))
                    size++;
            }
            return size;
        };
        $.post('<?php echo base_url('categories/get_categories') ?>', function (response) {
            if (Object.size(response.categories) > 0) {
                var html = '';
                html += '<ol class="dd-list">';
                $.each(response.categories, function (key, value) {
                    html += '<li class="dd-item cls' + value.id + '"><div class="dd-handle" data-level="' + value.level + '" data-id="' + value.id + '" data-homeview="' + value.homeview + '" data-parent_id="' + value.parent_id + '" data-youtube_url="' + value.youtube_url + '">' + value.category_name + '</div><div class="menu-icons">' + trashIcon + editIcon + '</div></li>';
                    if (Object.size(value.level2) > 0) {
                        html += '<ol class="dd-list">';
                        $.each(value.level2, function (key2, value2) {
                            html += '<li class="dd-item cls' + value2.id + '"><div class="dd-handle" data-level="' + value2.level + '" data-id="' + value2.id + '" data-homeview="' + value2.homeview + '" data-parent_id="' + value2.parent_id + '" data-youtube_url="' + value2.youtube_url + '">' + value2.category_name + '</div><div class="menu-icons">' + trashIcon + editIcon + '</div></li>';
                            if (Object.size(value2.level3) > 0) {
                                html += '<ol class="dd-list">';
                                $.each(value2.level3, function (key3, value3) {
                                    html += '<li class="dd-item cls' + value3.id + '"><div class="dd-handle" data-level="' + value3.level + '" data-id="' + value3.id + '" data-homeview="' + value3.homeview + '" data-parent_id="' + value3.parent_id + '"  data-level1parent_id="' + value.id + '" data-youtube_url="' + value3.youtube_url + '">' + value3.category_name + '</div><div class="menu-icons">' + trashIcon + editIcon + '</div></li>';
                                });
                                html += '</ol>';
                            }
                        });
                        html += '</ol>';
                    }
                });
                html += '</ol>';
            }
            $('#nestable').html(html);
        }, 'json');
//        var updateOutput = function (e)
//        {
//            console.log($(this));
//            var list = e.length ? e : $(e.target),
//                    output = list.data('output');
//            if (window.JSON) {
//                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
//            } else {
//                output.val('JSON browser support required for this demo.');
//            }
//        };
//        $('#nestable').nestable({
//            group: 1
//        })
//                .on('change', updateOutput);
//        updateOutput($('#nestable').data('output', $('#nestable-output')));
//        $('#nestable3').nestable();
    });
</script>
