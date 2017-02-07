$(function() {
    // Default
    jQuery.scrollSpeed(100, 800);
});

$(document).ready(function(){
    if(checkCookie('basket') && (readCookie('basket')).length > 0) {
        var basket = JSON.parse(readCookie('basket'));

        var basket_count = 0;
        $.each(basket, function (key, item) {
            basket_count = parseInt(basket_count) + 1
        });

        if(basket_count > 0) {
            $.ajax({
                url: BASE_URL + '/basket/products/' + locale,
                type: 'post',
                data: {
                    _token: token,
                    basket: basket
                }
            })
        }
    }
    else {
        var basket_count = 0;
    }
    $('.basket_count').text(basket_count);
    
});

// Change language
$(document).find('select[name="lang"]').change(function(){
    var lang = $(this).val();
    window.location.href = lang;
});

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function checkCookie(name)
{
    return readCookie(name) != null;
}
