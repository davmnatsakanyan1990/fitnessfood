<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FitnessCook</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css">
    <link rel="stylesheet" href="/styles/fitness.css">

    <meta property="fb:app_id"           content="{{ env('FB_APP_ID') }}" />
    <meta property="og:url"           content="{{ url()->current() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Fitness Cook" />
    <meta property="og:description"   content="Պատվիրեք Առանց Ալյուրի և Շաքարի Քաղցրավենիքներ Ֆիթնես Քուքից" />
    <meta property="og:image"         content="{{ url('/').'/images/for_share_1.png' }}" />


    <script>
        var BASE_URL = '{{ url('/') }}';
        var locale = '{{ App::getLocale() }}';
        var token = '{{ csrf_token() }}';
    </script>

    @yield('styles')
</head>
<body>

{{--@include('trainer.layouts.header')--}}

@yield('content')

@include('trainer.layouts.footer')

        <!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
<script src="{{ url('lib/jQuery.scrollSpeed.js')}}"></script>
<script src="/js/main.js"></script>
<script>
    $(document).ready(function(){
        if(localStorage.getItem('basket'))
            var basket_count = (JSON.parse(localStorage.getItem('basket'))).length;
        else
            var basket_count = 0;

        $('.basket_count').text(basket_count);
    });
</script>

<script>
    $(document).ready(function(){
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '{{ env('FB_APP_ID') }}',
                xfbml      : true,
                version    : 'v2.8'
            });

            FB.AppEvents.logPageView();
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        $('.fbShare').on('click', function(){
            FB.ui({
                method: 'share_open_graph',
                action_type: 'og.share',
                action_properties: JSON.stringify({
                    object:'{{ url()->current() }}'
                })

            }, function(response){});
        })
    });
</script>

<script>
    $(document).find('select[name="lang"]').change(function(){
        var lang = $(this).val();
        window.location.href = lang;
    })
</script>


@yield('scripts')
</body>
</html>