 $.post('<?php echo base_url('categories/get_categories') ?>', function (response) {
            if (Object.size(response.categories) > 0) {
                $('#listMenu').append('<ol type="circle">');
                $.each(response.categories, function (key, value) {
                    $('#listMenu').append('<li>' + value.category_name + '</li>');
                    if (Object.size(value.level2) > 0) {
                        $('#listMenu').append('<ul>');
                        $.each(value.level2, function (key2, value2) {
                            $('#listMenu').append('<li>' + value2.category_name + '</li>');
                                if (Object.size(value2.level3) > 0) {
                                    $('#listMenu').append('<ul>');
                                    $.each(value2.level3, function (key3, value3) {
                                        console.log(value3);
                                        $('#listMenu').append('<li>' + value3.category_name + '</li>');
                                    });
                                    $('#listMenu').append('</ul>');
                                }
                        });
                        $('#listMenu').append('</ul>');
                    }
                });
                $('#listMenu').append('</ol>');
            }
        }, 'json');