$(document).ready(function () {

    $('.footable').footable();

    if (localStorage.getItem('product_edit_tab')) {
        switch (localStorage.getItem('product_edit_tab')) {
            case 'tab1':
                if (!$('#tab1').hasClass('active')) {
                    $('#tab1').addClass('active');
                    $('#tab2').removeClass('active');
                    $('#tab-1').addClass('active');
                    $('#tab-2').removeClass('active')
                }
                $('#tab1')
                break;
            case 'tab2':
                if (!$('#tab2').hasClass('active')) {
                    $('#tab2').addClass('active');
                    $('#tab1').removeClass('active');
                    $('#tab-2').addClass('active');
                    $('#tab-1').removeClass('active')
                }
                break
        }
    }

    $('.delete_image').click(function () {
        var _this = $(this);

        swal({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#892E6B",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    var image_id = _this.data('id');
                    $.ajax({
                        url: BASE_URL + '/admin/products/images/delete/' + image_id,
                        type: 'post',
                        data: {
                            _token: token
                        },
                        success: function (data) {
                            _this.closest('.img_cont').remove();
                        }
                    });
                    swal({
                        title: "Deleted!",
                        text: 'Image has been deleted.',
                        type: "success",
                        confirmButtonColor: "#892E6B",
                        timer: 2000
                    });
                } else {

                }
            });
    });

    $('.set_thumb_image').on('click', function () {
        var _this = $(this);
        var id = $(this).data('id');
        var product_id = $(this).data('product');

        swal({
                title: "Set as thmbnail picture?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#892E6B",
                confirmButtonText: "Yes!",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {

                if (isConfirm) {
                    $.ajax({
                        url: BASE_URL + '/admin/products/' + product_id + '/images/set_thumbnail/' + id,
                        type: 'post',
                        data: {
                            _token: token
                        },
                        success: function (data) {
                            $('.show').removeClass('show');
                            _this.closest('.img_cont').find('.tmb_img').addClass('show');
                            _this.closest('.img_cont').find('.delete_image').css('margin-top', '23px');

                            var elements = _this.closest('#gall').find('.set_thumb_image');

                            $.each(elements, function (index, value) {
                                var attr = $(value).hasClass('hidden');
                                if (attr) {
                                    $(value).removeClass('hidden');
                                    $(value).closest('.img_cont').find('.delete_image').css('margin-top', '0')
                                }
                            });
                            _this.addClass('hidden');

                            swal({
                                title: "Updated!",
                                text: 'Thumbnail picture has been changed',
                                type: "success",
                                confirmButtonColor: "#892E6B",
                                timer: 2000
                            });
                        }
                    });
                } else {

                }
            });
    });

    $('.summernote').summernote();

    $('.input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

});

$('.tab').on('click', function () {
    var id = $(this).attr('id');
    localStorage.setItem('product_edit_tab', id);
});
