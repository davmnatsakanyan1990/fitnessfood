//$(document).find('.edit').on('click', function(){
//    var id = $(this).data('id');
//
//    $.ajax({
//        url : BASE_URL + '/admin/promo/get/' + id,
//        type: 'get',
//        success: function(data){
//            $('#editPromoCode').find('input[name="percent"]').val(data.percent);
//            $('#editPromoCode').find('.trainer_name').text(data.trainer.name);
//            $('#editPromoCode').find('.promo').text(data.code);
//            $('#editPromoCode').find('input[name="id"]').val(data.id)
//        }
//    })
//});

//$('.delete').click(function () {
//    var row = $(this);
//
//    swal({
//            title: "Are you sure?",
//            type: "warning",
//            showCancelButton: true,
//            confirmButtonColor: "#892E6B",
//            confirmButtonText: "Yes, delete it!",
//            cancelButtonText: "No, cancel plx!",
//            closeOnConfirm: false,
//            closeOnCancel: true
//        },
//        function (isConfirm) {
//            if (isConfirm) {
//                var promo_id = row.data('id');
//                $.ajax({
//                    url: BASE_URL + '/admin/promo/delete/' + promo_id,
//                    type: 'post',
//                    data: {
//                        _token: token
//                    },
//                    success: function (data) {
//                        row.closest('tr').remove();
//                    }
//                });
//                swal("Deleted!", "Gym has been deleted.", "success");
//            }
//        });
//});

$(document).find('input[name="trainer"]').on('input', function(){
    var trainer = $(this).val();

    $.ajax({
        url: BASE_URL+'/admin/promo/all',
        data: {
            trainer: trainer
        },
        success: function(data){
            $(document).find('.codes tbody').html(data);
        }
    })
});

$(document).find('.export').on('click', function(){
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL+'/admin/promo_card/'+id,
        type: 'get',
        success: function(data){
            console.log(data);

            $('#exportData').find('.trainer_name span').html(data.trainer.name);
            $('#exportData').find('input[name="trainer"]').val(data.trainer.name);

            $('#exportData').find('.trainer_phone span').html(data.trainer.phone);
            $('#exportData').find('input[name="phone"]').val(data.trainer.phone);

            if(data.trainer.gym) {
                $('#exportData').find('.gym').html(data.trainer.gym.name);
                $('#exportData').find('input[name="gym"]').val(data.trainer.gym.name);
            }
            else {
                $('#exportData').find('.gym').html('Null');
                $('#exportData').find('input[name="gym"]').val('');
            }

            $('#exportData').find('.promo_code').html(data.code);
            $('#exportData').find('input[name="promo_code"]').val(data.code);

            $('#exportData').find('.percent').html(data.percent);
            $('#exportData').find('input[name="percent"]').val(data.percent);

            $('#exportData').find('.trainer_img').attr('src', '/images/trainerImages/'+data.trainer.image.name);

            $('#exportData').find('input[name="image_name"]').val(data.trainer.image.name);
        }
    })
});

$('#exportData').on('click', '.edit', function(){
    var parent = $(this).closest('dd');
    var value = $(this).closest('dd').find('span')[0].innerText;
    $(this).closest('dd').html('<input type="text" class="form-control" value="'+value+'">');
    parent.find('input').focus();
    parent.find('input')[0].setSelectionRange(value.length, value.length);

});

$(document).find('#exportData').on('focus', 'input', function() {

}).on('blur', 'input', function() {
    var value = $(this).val();
    var parent = $(this).closest('dd');

    $(this).closest('dd').html('<span>'+value+'</span>'+' <i class="fa fa-pencil edit"></i>')
    parent.next('input').val(value);

});
