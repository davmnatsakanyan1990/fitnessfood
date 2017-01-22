$(document).ready(function(){
    var products = JSON.parse(localStorage.getItem('basket'));
    $.ajax({
        url: BASE_URL+'/basket/products',
        type: 'post',
        data: {
            products: products,
            _token: token
        },
        success: function(data){
            $('.content').html(data);
        }
    })
});

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
});