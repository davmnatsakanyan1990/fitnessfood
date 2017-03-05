$(document).find('.card_order').on('click', function(){
    var card_id = $(this).data('id');

    $('#newCardOrder').find('input[name="card_id"]').val(card_id);
})