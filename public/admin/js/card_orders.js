$(document).ready(function(){

    $.ajax({
        url: BASE_URL+'/admin/promo_card/orders/seen',
        type: 'get',
        data: {
            new_orders: new_card_orders_array
        },
        success: function(data){

        }
    })
});

$(document).find('.export').on('click', function(){
    var id = $(this).data('id');

    $.ajax({
        url: BASE_URL+'/admin/promo_card/'+id,
        type: 'get',
        success: function(data){

            $('#exportData').find('.trainer').html(data.trainer.name);
            $('#exportData').find('input[name="trainer"]').val(data.trainer.name);

            $('#exportData').find('.phone').html(data.trainer.phone);
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