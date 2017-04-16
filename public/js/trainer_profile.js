$(document).find('.card_order').on('click', function(){
    var card_id = $(this).data('id');

    $('#newCardOrder').find('input[name="card_id"]').val(card_id);
})

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah').attr('src', e.target.result);


        };

        reader.readAsDataURL(input.files[0]);

       $('#profile-form').submit();
    }
}

$("#imgInp").change(function () {
    readURL(this);
});


//window.fbAsyncInit = function() {
//    FB.init({
//        appId      : '1737028149942744',
//        xfbml      : true,
//        version    : 'v2.8'
//    });
//    FB.AppEvents.logPageView();
//};
//
//(function(d, s, id){
//    var js, fjs = d.getElementsByTagName(s)[0];
//    if (d.getElementById(id)) {return;}
//    js = d.createElement(s); js.id = id;
//    js.src = "//connect.facebook.net/en_US/sdk.js";
//    fjs.parentNode.insertBefore(js, fjs);
//}(document, 'script', 'facebook-jssdk'));
//
//$('.shareBtn').on('click', function() {
//    var code = $(this).data('code');
//    FB.ui({
//        method: 'feed',
//        link: BASE_URL+'/trainer/promo_code/share?promo_code='+code,
//        caption: 'An example caption',
//    }, function(response){});
//});


//(function(d, s, id) {
//    var js, fjs = d.getElementsByTagName(s)[0];
//    if (d.getElementById(id)) return;
//    js = d.createElement(s); js.id = id;
//    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1737028149942744";
//    fjs.parentNode.insertBefore(js, fjs);
//}(document, 'script', 'facebook-jssdk'));


