var sale_percent = 0;
var timeout;
var trainers_list = $(document).find('.trainer-select-main').html();

$(document).ready(function(){

    function initAutocomplete() {

        var geocoder;
        var marker;

        var myOptions = {
            center: new google.maps.LatLng(40.17651248103691, 44.514713287353516 ),
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };

        geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);

        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });

        function placeMarker(location) {
            if(marker){
                marker.setPosition(location);
            }else{
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            getAddress(location);
        }

        function getAddress(latLng) {
            geocoder.geocode( {'latLng': latLng},
                function(results, status) {
                    if(status == google.maps.GeocoderStatus.OK) {
                        if(results[0]) {
                            document.getElementById("Yaddress").value = results[0].formatted_address;
                        }
                        else {
                            document.getElementById("Yaddress").value = "No results";
                        }
                    }
                    else {
                        document.getElementById("Yaddress").value = status;
                    }
                });
        }

        // Create the search box and link it to the UI element.
        var input = document.getElementById('Yaddress');

        // Create the autocomplete object, restricting the search to geographical
        // location types.

        var autocomplete;

        var defaultBounds = new google.maps.LatLngBounds(
            new google.maps.LatLng(-33.8902, 151.1759),
            new google.maps.LatLng(-33.8474, 151.2631));

        autocomplete = new google.maps.places.Autocomplete((input), {
                componentRestrictions: {country: 'am'},
                types: ['geocode']
            });

        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();

            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }

            placeMarker(place.geometry.location);

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            map.fitBounds(bounds);
        });
    }

    // when basket is not empty
    if($(document).find('.not_empty').length != 0) {
        google.maps.event.addDomListener(window, 'load', initAutocomplete);

        if($(document).find('input[name="promo_code"]').val() != ''){
            promo_inserted($(document).find('input[name="promo_code"]').val());
        }
    }

    if($('#tr4-na').prop('checked')){
        // disable trainer search field
        $(document).find('input[name="search"]').prop("disabled", true);

        // hide trainers
        $(document).find('.trainer-select-main').hide();
    }

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
});

// click on order button
$(document).find('.submit').on('click', function(e){
    e.preventDefault();
    var d = new Date();

    var current_time = '01/01/2011 '+d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();

    if(Date.parse(current_time) > Date.parse('01/01/2011 '+wrk_hr_from) && Date.parse(current_time) < Date.parse('01/01/2011 '+wrk_hr_to)){
        $('#form_order').submit();
    }
    else{
        $('#warningModal').modal('show');

        $(document).find('.order_tomorrow').on('click', function(){
            $('#form_order').submit();
        })
    }

});

// Search for trainer
$(document).find('input[name="search"]').on('input', function() {
    var value = $(this).val().replace(/\s\s+/g, ' ');

    searchTrainer(value);
});

$(document).find('input[name="search"]').next('span').on('click', function(){
    var value = $(this).closest('.basket-form-div').find('input[name="search"]').val();
    searchTrainer(value);
});

function searchTrainer(value){
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
        }, 500);
    }
}
// Inserting promo code
$(document).find('input[name="promo_code"]').on('input', function() {
    var value = $(this).val();
    promo_inserted(value);

});
function promo_inserted(value){
    if(value.length != 4){
        $('.greencheck').hide();
        $('.redcross').hide();
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

        $(document).find('input[name="search"]').val('');

    }
    else {

            // disable trainer search field
            $(document).find('input[name="search"]').prop("disabled", true);
            // disable nobody box
            $(document).find('.v-voq input[name="trainer"]').prop("disabled", true);
            $(document).find('.v-voq input[name="trainer"]').next('label').css("background", '#ebebe4');
            $(document).find('.v-voq input[name="trainer"]').next('label').css("cursor", 'not-allowed');


            clearTimeout(timeout);
            // search promo code
            timeout = setTimeout(function () {
                $.ajax({
                    url: BASE_URL + '/promo/search/' + locale,
                    type: 'get',
                    data: {
                        text: value
                    },
                    success: function (data) {
                        var total = getTotalAmount();

                        if (data.promo) {
                            $('.greencheck').show();
                            sale_percent = data.promo.percent;
                        }
                        else{
                            $('.redcross').show();
                        }

                        if (total >= min_amount_free_shipping) {
                            var final_shipping = 0;
                        }
                        else {
                            var final_shipping = shipping;
                        }

                        // get discounted amount
                        var discounted = total - (total * sale_percent) / 100 + parseInt(final_shipping);

                        // show discounted block

                        if (data.promo) {
                            if (data.promo.trainer.is_approved == 1) {
                                $(document).find('#zexchvats').closest('.prc-ul').show();
                                $(document).find('#zexchvats').html(discounted);
                                $('.old-price').html(total + parseInt(final_shipping));

                                $(document).find('input[name="search"]').val(data.promo.trainer.name);
                            }
                        }
                        else {
                            $(document).find('input[name="search"]').val('');
                            $(document).find('#zexchvats').closest('.prc-ul').hide();
                        }

                        // fill trainers list
                        $(document).find('.trainer-select-main').html(data.view);
                        $(document).find('.trainer-select-main input[name="trainer"]').prop("checked", true);
                    }
                })
            }, 100);

    }
}
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

    //if(total >= min_amount_free_shipping){
    //    $(document).find('.freeshipping').show();
    //    $(document).find('.shipping').hide();
    //    $(document).find('.shipping_amount').hide();
    //}
    //else{
    //    $(document).find('.shipping').show();
    //    $(document).find('.freeshipping').hide();
    //    $(document).find('.shipping_amount').show();
    //}

    var discounted = total - (total * sale_percent)/100;

    if(total < min_amount_free_shipping){
        discounted = discounted + parseInt(shipping);
        total = total + parseInt(shipping);

        $('#zexchvats').html(discounted);
        $('.old-price').html(total);
        $(document).find('.shipping').show();
        $(document).find('.freeshipping').hide();
    }
    else {
        $('#zexchvats').html(discounted);
        $('.old-price').html(total);
        $(document).find('.freeshipping').show();
        $(document).find('.shipping').hide();
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

    //if(total >= min_amount_free_shipping){
    //    $(document).find('.freeshipping').show();
    //    $(document).find('.shipping').hide();
    //    $(document).find('.shipping_amount').hide();
    //}
    //else{
    //    $(document).find('.shipping').show();
    //    $(document).find('.freeshipping').hide();
    //    $(document).find('.shipping_amount').show();
    //}

    var discounted = total - (total * sale_percent)/100;

    if(total < min_amount_free_shipping){
        discounted = discounted + parseInt(shipping);
        total = total + parseInt(shipping);

        $('#zexchvats').html(discounted);
        $('.old-price').html(total);
        $(document).find('.shipping').show();
        $(document).find('.freeshipping').hide();
    }
    else {
        $('#zexchvats').html(discounted);
        $('.old-price').html(total);
        $(document).find('.freeshipping').show();
        $(document).find('.shipping').hide();
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
        $('.old-price').html(total);
        $(document).find('.shipping').show();
        $(document).find('.freeshipping').hide();
    }
    else{
        $('#zexchvats').html(discounted);
        $('.old-price').html(total);
        $(document).find('.freeshipping').show();
        $(document).find('.shipping').hide();
    }

    $('#total').html(total);
}

// click to no one checkbox
$(document).find('#tr4-na').on('click', function(){
    if($('#tr4-na').prop('checked')){
        // disable trainer search field
        $(document).find('input[name="search"]').prop("disabled", true);

        // hide trainers
        $(document).find('.trainer-select-main').hide();
    }
    else{
        // enable trainer search field
        $(document).find('input[name="search"]').prop("disabled", false);

        // show trainers
        $(document).find('.trainer-select-main').show();
    }
});

function getTotalAmount(){
    var total = 0;
    $.each($(document).find('.amount'), function(index, value){
        total += parseInt(value.innerText);
    });

    return total;
}






