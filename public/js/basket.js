// manually change count
$(document).find('input[name="quantity"]').change(function(){
    var count = $(this).val();
    var product_id = $(this).closest('form').data('id');
    var price = $(this).closest('form').data('price');

    updateCount( count, product_id, price);

    var basket = JSON.parse(readCookie('basket'));

    var basket_count = 0;
    $.each(basket, function (key, item) {
        basket_count += item.count
    });

    $('.basket_count').text(basket_count);
});

// click on remove product button
$(document).on('click','.remove', function(){
    var product_id = $(this).data('id');

    var basket = JSON.parse(readCookie('basket'));
    var new_basket = [];
    $.each(basket, function(key, product){
        
        if(product.product_id != product_id){
            new_basket.push(product);
        }
    });

    var json = JSON.stringify(new_basket);

    createCookie('basket', json);

    $(this).closest('tr').remove();
    var basket_count = new_basket.length;
    $('.basket_count').text(basket_count);

    var total = 0;
    $.each($(document).find('.amount'), function(index, value){
        total += parseInt(value.innerText);
    });

    $('#total').html(total);

    if(total == 0){
        $(document).find('.not_empty').addClass('hidden');
        $(document).find('.empty').removeClass('hidden');
    }
});

// click on advised box
$(document).find('input[name="is_addvised"]').on('click', function(){
    var is_checked = $(document).find('input[name="is_addvised"]').is(':checked');
    if(is_checked){
        $('.marzich-search').addClass('show-open');
        $(this).next('label').addClass('checked-check')
    }
    else{
        $('.marzich-search').removeClass('show-open');
        $(this).next('label').removeClass('checked-check')
    }
});


// This button will increment the value
$(document).on('click', '.qtyplus', function(e){
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = parseInt($(this).closest('form').find('input[name='+fieldName+']').val());
    // If is not undefined
    if (!isNaN(currentVal)) {
        // Increment
        $(this).closest('form').find('input[name='+fieldName+']').val(currentVal + 1);

        var count = $(this).closest('form').find('input[name='+fieldName+']').val();
        var product_id = $(this).closest('form').data('id');
        var price = $(this).closest('form').data('price');
        updateCount(count, product_id, price);
    } else {
        // Otherwise put a 1 there
        $(this).closest('form').find('input[name='+fieldName+']').val(1);
    }

    var basket_count = $(document).find('.basket_count')[0].innerHTML;
    $('.basket_count').text(parseInt(basket_count) + 1);
});
// This button will decrement the value till 0
$(document).on('click','.qtyminus', function(e) {
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = parseInt($(this).closest('form').find('input[name='+fieldName+']').val());
    // If it isn't undefined or its greater than 0
    if (!isNaN(currentVal) && currentVal > 1) {
        // Decrement one
        $(this).closest('form').find('input[name='+fieldName+']').val(currentVal - 1);

        var count = $(this).closest('form').find('input[name='+fieldName+']').val();
        var product_id = $(this).closest('form').data('id');
        var price = $(this).closest('form').data('price');
        updateCount(count, product_id, price);
    } else {
        // Otherwise put a 1 there
        $(this).closest('form').find('input[name='+fieldName+']').val(1);
    }

    var basket_count = $(document).find('.basket_count')[0].innerHTML;

    if(currentVal > 1)
        $('.basket_count').text(parseInt(basket_count) - 1);

});

function updateCount(count, product_id, price){
    if(readCookie('basket') && (readCookie('basket')).length > 0){
        var basket = JSON.parse(readCookie('basket'));
    }
    else{
        var basket = [];
    }

    var product = {};

    product.count = count;
    product.product_id = product_id;

    $.each(basket, function(key, value){
        if(value.product_id == product_id){
            value.count = parseInt(count);
            var json = JSON.stringify(basket);
            createCookie('basket', json);
        }
    });

    $(document).find("[data-id='" + product_id + "']").closest('tr').find('.amount').html(parseInt(price) * parseInt(count));

    var total = 0;
    $.each($(document).find('.amount'), function(index, value){
       total += parseInt(value.innerText);
    });

    if(total > min_amount_free_shipping){
        $(document).find('.freeshipping').show();
        $(document).find('.shipping').hide();
        $(document).find('.shipping_amount').hide();
    }
    else{
        $(document).find('.shipping').show();
        $(document).find('.freeshipping').hide();
        $(document).find('.shipping_amount').show();
    }

    $('#total').html(total);

}

$("select.trainer").select2({
    templateResult: formatTrainer
});

function formatTrainer(trainer) {

    if (!trainer.id) {
        return trainer.first_name;
    }
    var image = trainer.element.attributes[0].value;
    var $trainer = $(
        '<span><img width="20" height="20" src="/images/trainerImages/' + image + '" /> ' + trainer.text + '</span>'
    );
    return $trainer;
}






