var sale_percent = 0;
var timeout;
var trainers_list = $(document).find('.trainer-select-main').html();
// Search for trainer
$(document).find('input[name="search"]').on('input', function() {
    var value = $(this).val();
    if(value.length == 0){
        clearTimeout(timeout);
        $(document).find('.trainer-select-main').html(trainers_list);
    }
    else {
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            $.ajax({
                url: BASE_URL + '/trainers/search/' + locale,
                type: 'get',
                data: {
                    text: value
                },
                success: function (data) {
                    $(document).find('.trainer-select-main').html(data);
                }
            })
        }, 1000);
    }

});

// Inserting promo code
$(document).find('input[name="promo_code"]').on('input', function() {
    var value = $(this).val();
    if(value.length == 0){
        clearTimeout(timeout);
        // fill trainers list
        $(document).find('.trainer-select-main').html(trainers_list);
        // enable trainer search field
        $(document).find('input[name="search"]').prop("disabled", false);
        // hide discounted amount
        $(document).find('#zexchvats').closest('.prc-ul').hide();
        // enable nobody box
        $(document).find('.v-voq input[name="trainer"]').prop("disabled", false);
        $(document).find('.v-voq input[name="trainer"]').next('label').css("background", '#ffffff');
        $(document).find('.v-voq input[name="trainer"]').next('label').css("cursor", 'inherit');
    }
    else{
        // disable trainer search field
        $(document).find('input[name="search"]').prop("disabled", true);
        // disable nobody box
        $(document).find('.v-voq input[name="trainer"]').prop("disabled", true);
        $(document).find('.v-voq input[name="trainer"]').next('label').css("background", '#ebebe4');
        $(document).find('.v-voq input[name="trainer"]').next('label').css("cursor", 'not-allowed');


        clearTimeout(timeout);
        // search promo code
         timeout = setTimeout(function(){
            $.ajax({
                url: BASE_URL + '/promo/search/'+locale,
                type: 'get',
                data: {
                    text: value
                },
                success: function (data) {
                    var total = getTotalAmount();

                    if(data.promo)
                        sale_percent = data.promo.percent;

                    if(total >= min_amount_free_shipping){
                        var final_shipping = 0;
                    }
                    else{
                        var final_shipping = shipping;
                    }

                    // get discounted amount
                    var discounted = total - (total * sale_percent)/100 + parseInt(final_shipping);

                    // show discounted block

                    if(data.promo) {
                        if(data.promo.trainer.is_approved == 1) {
                            $(document).find('#zexchvats').closest('.prc-ul').show();
                            $(document).find('#zexchvats').html(discounted);
                        }
                    }

                    // fill trainers list
                    $(document).find('.trainer-select-main').html(data.view);
                    $(document).find('.trainer-select-main input[name="trainer"]').prop("checked", true);
                }
            })
        }, 1000);
    }
});

// manually change count
$(document).find('input[name="quantity"]').change(function(){
    var count = $(this).val();
    var product_id = $(this).closest('.quantity-form').data('id');
    var price = $(this).closest('.quantity-form').data('price');

    updateCount( count, product_id, price);

    var basket = JSON.parse(readCookie('basket'));

    var basket_count = 0;
    $.each(basket, function (key, item) {
        basket_count += item.count
    });

    $('.basket_count').text(basket_count);
});

// click on remove product button
$(document).find('table').on('click','.remove', function(){
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
    if(new_basket == 0){
        $(document).find('.basket_dropdown').remove();

        $(document).find('.not_empty').html('<div class="empty">'+
            '<div class="col-md-offset-4 col-md-4">'+
            '<div style="margin-top: 50px; font-size: larger" class="row text-center">'+
            '<h1>'+bsk_empty+'</h1>'+
            '</div>'+
            '</div>'+
            '</div>')
    }
    else{
        $(document).find('#bsk_product_'+product_id).remove();
    }

    var basket_count = new_basket.length;
    $('.basket_count').text(basket_count);

    var total = getTotalAmount();

    if(total >= min_amount_free_shipping){
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
});

// remove item from basket dropdown
$(document).find('.dropdown').on('click', '.remove', function(){
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

    if(new_basket.length == 0){
        $(this).closest('.basket_dropdown').remove();
        $(document).find('.not_empty').html('<div class="empty">'+
            '<div class="col-md-offset-4 col-md-4">'+
            '<div style="margin-top: 50px; font-size: larger" class="row text-center">'+
            '<h1>'+bsk_empty+'</h1>'+
            '</div>'+
            '</div>'+
            '</div>')
    }
    else{
        $(this).closest('li').remove();
        $(document).find('#tr_'+product_id).remove();
    }

    var basket_count = new_basket.length;
    $('.basket_count').text(basket_count);

    var total = getTotalAmount();

    if(total >= min_amount_free_shipping){
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
});

// This button will increment the value
$(document).on('click', '.qtyplus', function(e){
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = parseInt($(this).closest('.quantity-form').find('input[name='+fieldName+']').val());
    // If is not undefined
    if (!isNaN(currentVal)) {
        // Increment
        $(this).closest('.quantity-form').find('input[name='+fieldName+']').val(currentVal + 1);

        var count = $(this).closest('.quantity-form').find('input[name='+fieldName+']').val();
        var product_id = $(this).closest('.quantity-form').data('id');
        var price = $(this).closest('.quantity-form').data('price');
        updateCount(count, product_id, price);
    } else {
        // Otherwise put a 1 there
        $(this).closest('.quantity-form').find('input[name='+fieldName+']').val(1);
    }
});

// This button will decrement the value till 0
$(document).on('click','.qtyminus', function(e) {
    // Stop acting like a button
    e.preventDefault();
    // Get the field name
    fieldName = $(this).attr('field');
    // Get its current value
    var currentVal = parseInt($(this).closest('.quantity-form').find('input[name='+fieldName+']').val());
    // If it isn't undefined or its greater than 0
    if (!isNaN(currentVal) && currentVal > 1) {
        // Decrement one
        $(this).closest('.quantity-form').find('input[name='+fieldName+']').val(currentVal - 1);

        var count = $(this).closest('.quantity-form').find('input[name='+fieldName+']').val();
        var product_id = $(this).closest('.quantity-form').data('id');
        var price = $(this).closest('.quantity-form').data('price');
        updateCount(count, product_id, price);
    } else {
        // Otherwise put a 1 there
        $(this).closest('.quantity-form').find('input[name='+fieldName+']').val(1);
    }
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

            $('#bsk_product_'+product_id).find('mark').text(value.count);
            $('#bsk_product_'+product_id).find('.total').text(parseInt(value.count) * parseInt(price));

            var json = JSON.stringify(basket);
            createCookie('basket', json);
        }
    });

    $(document).find("[data-id='" + product_id + "']").closest('tr').find('.amount').html(parseInt(price) * parseInt(count));

    var total = getTotalAmount();
    var discounted = total - (total * sale_percent)/100;

    if(total < min_amount_free_shipping){
        discounted = discounted + parseInt(shipping);
        total = total + parseInt(shipping);

        $('#zexchvats').html(discounted);
        $(document).find('.shipping').show();
        $(document).find('.freeshipping').hide();
    }
    else{
        $('#zexchvats').html(discounted);
        $(document).find('.freeshipping').show();
        $(document).find('.shipping').hide();
    }

    $('#total').html(total);
}

function getTotalAmount(){
    var total = 0;
    $.each($(document).find('.amount'), function(index, value){
        total += parseInt(value.innerText);
    });

    return total;
}






