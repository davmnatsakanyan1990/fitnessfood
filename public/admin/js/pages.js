$(document).ready(function(){

    $('.summernote').summernote();

    $('.ibox').find('.click2edit').summernote({focus: true});

});

$('.tab').on('click', function(){
    var id = $(this).attr('id');
    localStorage.setItem('sub_page_tab', id);
});

if(localStorage.getItem('sub_page_tab')){
    var tab = localStorage.getItem('sub_page_tab');

    $('.nav-tabs').find('.active').removeClass('active');
    $('#'+tab).addClass('active');

    $('.tab-content').find('.active').removeClass('active');
    $('#tab-'+tab).addClass('active');

}

//$(document).find('.edit').on('click', function(){
//    $(this).closest('.ibox').find('.click2edit').summernote({focus: true});
//});
//
//$(document).find('.view').on('click', function(){
//    $(this).closest('.ibox').find('.click2edit').destroy();
//});

$(document).find('.save').on('click', function(){
    var sub_page_id = $(this).data('id');

    var data = {};
    data.content = {};
    data.title = {};

    data.content.am = $(this).closest('.tab-pane').find('.armenian .click2edit').code();
    data.content.ru = $(this).closest('.tab-pane').find('.russian .click2edit').code();
    data.content.en = $(this).closest('.tab-pane').find('.english .click2edit').code();

    data.title.am = $(this).closest('.tab-pane').find('.armenian input[name="title[am]"]').val();
    data.title.ru = $(this).closest('.tab-pane').find('.russian input[name="title[ru]"]').val();
    data.title.en = $(this).closest('.tab-pane').find('.english input[name="title[en]"]').val();

    var _this = $(this);
    $.ajax({
        url: BASE_URL+'/admin/sub_pages/update/'+sub_page_id,
        type: 'post',
        data: {
            data: data,
            _token: token
        },
        success: function(data){
            swal({
                    title: "Updated!",
                    type: "success",
                    animation: "slide-from-top",
                },
                function (isConfirm) {
                    location.reload();
                }
            );
        }
    })
});

$(document).find('.delete').on('click', function(){
    var sub_page_id = $(this).data('id');
    swal({
            title: "Delete Page?",
            type: "warning",
            showCancelButton: true,
            closeOnConfirm: true,
            animation: "slide-from-top"
        },
        function (isConfirm) {
            if(isConfirm) {
                $.ajax({
                    url: BASE_URL + '/admin/sub_pages/delete/' + sub_page_id,
                    type: 'get',
                    success: function () {
                        location.reload();
                    }
                })
            }
        }
    );
});