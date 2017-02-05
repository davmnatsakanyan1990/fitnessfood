$(document).ready(function(){

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
        $(this).closest('div').find('.gall-big img').attr('src',big_src);

    });

    /* Click add to card button */
    $('.addToCard-button').on('click', function(){
        var product_id = $(this).data('id');
        var count = $(this).closest('.quantity-wrap').find('input[name="quantity"]').val();

        if(checkCookie('basket') && (readCookie('basket')).length > 0){
            var basket = JSON.parse(readCookie('basket'));
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

                createCookie('basket', json);

                exist = true;
            }
        });

        if(!exist) {
            basket.push(product);
            var json = JSON.stringify(basket);

            createCookie('basket', json);
        }

        var basket_count = $(document).find('.basket_count')[0].innerHTML;
        $('.basket_count').text(parseInt(basket_count) + parseInt(count));

        $(this).closest('.quantity-wrap').find('input[name="quantity"]').val(1)

        // Start animation
        var cart = $('.shopping-cart');
        var imgtodrag = $(this).closest('.for-img').find("img.product").eq(0);

        if (imgtodrag) {
            var imgclone = imgtodrag.clone()
                .offset({
                    top: imgtodrag.offset().top,
                    left: imgtodrag.offset().left
                })
                .css({
                    'opacity': '0.5',
                    'position': 'absolute',
                    'height': '150px',
                    'width': '150px',
                    'z-index': '100'
                })
                .appendTo($('body'))
                .animate({
                    'top': cart.offset().top + 10,
                    'left': cart.offset().left + 10,
                    'width': 75,
                    'height': 75
                }, 1000, 'easeInOutExpo');

            setTimeout(function () {
                cart.effect("shake", {
                    times: 2
                }, 200);
            }, 1500);

            imgclone.animate({
                'width': 0,
                'height': 0
            }, function () {
                $(this).detach()
            });
        }
    });


    // click to product
    $('.product').on('click', function () {
        //if($(window).width() >= 1024)
        //{
        //    var id = $(this).data('id');
        //
        //    $('.t-active').removeClass('t-active');
        //    $('.show-open').removeClass('show-open');
        //    $('.show-prod').removeClass('show-prod');
        //
        //    $(this).closest('.tumb-wrap').addClass('t-active');
        //    $('#' + id).closest('.opening-block').addClass('show-open');
        //    $('#' + id).addClass('show-prod');
        //}
        //else{
        //    alert('open modal')
        //}

        var product_id = $(this).closest('.tumb-wrap').data('id');

        $.ajax({
            url: BASE_URL+'/products/get/'+product_id+'/'+locale,
            type: 'get',
            success: function(data){
                $($('#carousel-id').find('.carousel-inner')[0]).html(data);
                console.log($('#carousel-id').find('.carousel-inner'))
            }
        });

    })

});/*Document Ready*/


