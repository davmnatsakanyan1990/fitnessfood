$(document).ready(function(){

    $('.summernote').summernote();

});

$(document).find('.edit').on('click', function(){
    $(this).closest('.ibox').find('.click2edit').summernote({focus: true});
});

$(document).find('.view').on('click', function(){
    $(this).closest('.ibox').find('.click2edit').destroy();
});

$(document).find('.save').on('click', function(){
    var page_id = $(this).data('id');
    var data = {};
    data.am = $('.armenian .click2edit').code();
    data.ru = $('.russian .click2edit').code();
    data.en = $('.english .click2edit').code();
    
    var _this = $(this);
    $.ajax({
        url: BASE_URL+'/admin/pages/update/'+page_id,
        type: 'post',
        data: {
            data: data,
            _token: token
        },
        success: function(data){
            if($(document).find('.msg').length == 0){
                $(document).find('.wrapper.wrapper-content').prepend('<div class="alert alert-success msg"><p>Page was updated</p></div>');
            }

            _this.closest('.ibox').find('.click2edit').destroy();
        }
    })
});