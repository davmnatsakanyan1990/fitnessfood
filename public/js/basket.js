$(document).ready(function(){


    if(localStorage.getItem('basket') && (JSON.parse(localStorage.getItem('basket'))).length > 0){
        $('.submit').removeAttr('disabled');
    }


    var products = JSON.parse(localStorage.getItem('basket'));

    if(products && products.length > 0) {

        $.ajax({
            url: BASE_URL + '/basket/products/' + locale,
            type: 'post',
            data: {
                products: products,
                _token: token
            },
            success: function (data) {
                $('.table').find('tbody').html(data);
                var total = $(document).find('input[name="total"]').val();
                $('#total').html(total);

                $(document).find('input[name="quantity"]').change(function(){
                    var count = $(this).val();
                    var product_id = $(this).closest('form').data('id');
                    var price = $(this).closest('form').data('price');
                    updateCount( count, product_id, price);
                })
            }
        })
    }
    else{
        $(document).find('.not_empty').addClass('hidden');
        $(document).find('.empty').removeClass('hidden');
    }
});


// click on remove product button
$(document).on('click','.remove', function(){
    var product_id = $(this).data('id');

    var basket = JSON.parse(localStorage.getItem('basket'));
    var new_basket = [];
    $.each(basket, function(key, product){
        
        if(product.product_id != product_id){
            new_basket.push(product);
        }
    });

    var json = JSON.stringify(new_basket);

    localStorage.setItem('basket', json);

    $(this).closest('tr').remove();

    var basket_count = (JSON.parse(localStorage.getItem('basket'))).length;
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
    }
    else{
        $('.marzich-search').removeClass('show-open');
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
});

function updateCount(count, product_id, price){
    if(localStorage.getItem('basket') && (localStorage.getItem('basket')).length > 0){
        var basket = JSON.parse(localStorage.getItem('basket'));
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
            localStorage.setItem('basket', json);
        }
    });

    $(document).find("[data-id='" + product_id + "']").closest('tr').find('.amount').html(parseInt(price) * parseInt(count));

    var total = 0;
    $.each($(document).find('.amount'), function(index, value){
       total += parseInt(value.innerText);
    })

    $('#total').html(total);

}






