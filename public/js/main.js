$(document).ready(function(){

    if((localStorage.getItem('basket')).length > 0)
        var basket_count = (JSON.parse(localStorage.getItem('basket'))).length;
    else
        var basket_count = 0;
    $('.basket_count').text(basket_count);

    // This button will increment the value
    $('.qtyplus').click(function(e){
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
        } else {
            // Otherwise put a 1 there
            $(this).closest('form').find('input[name='+fieldName+']').val(1);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
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
        } else {
            // Otherwise put a 1 there
            $(this).closest('form').find('input[name='+fieldName+']').val(1);
        }
    });

/*Single page gallery code starts here */

    $('.sm-gallery-ul li  img').click(function() {
        var big_src = $(this).data('big-src');
        $('.gall-big img').attr('src',big_src);
    
    });

    /* Click add to card button */
    $('.addToCard-button').on('click', function(){
        var product_id = $(this).data('id');
        var count = $(this).closest('.quantity-wrap').find('input[name="quantity"]').val();

        if((localStorage.getItem('basket')).length > 0){
            var basket = JSON.parse(localStorage.getItem('basket'));
        }
        else{
            var basket = [];
        }

        var product = {};

        product.count = count;
        product.product_id = product_id;

        // determine the product exist or not
        var exist = false;
        $.each(basket, function(key, value){
            if(value.product_id == product_id){
                value.count = parseInt(value.count) + parseInt(count);

                var json = JSON.stringify(basket);

                localStorage.setItem('basket', json);

                exist = true;
            }
        });

        if(!exist) {
            basket.push(product);
            var json = JSON.stringify(basket);

            localStorage.setItem('basket', json);
        }

        var basket_count = (JSON.parse(localStorage.getItem('basket'))).length;
        $('.basket_count').text(basket_count);

        $(this).closest('.quantity-wrap').find('input[name="quantity"]').val(1)
    })
});/*Document Ready*/
 
