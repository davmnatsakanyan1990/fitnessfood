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

    <meta property="og:url"           content="{{ url()->current() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Fitness Cook" />
    <meta property="og:description"   content="Your description" />
    <meta property="og:image"         content="{{ url('/').'/images/logo.png' }}" />


    <script>
        var BASE_URL = '{{ url('/') }}';

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

        function eraseCookie(name) {
            createCookie(name,"",-1);
        }

        function checkCookie(name)
        {
            return readCookie(name) != null;
        }

        if(checkCookie("XYZ")) {
            createCookie("XYZ","SMURF",1);
            document.write("reset cookie");
        }
        else {
            createCookie("XYZ","SMURF",1);
            document.write(readCookie("XYZ"));
        }
    </script>

    @yield('styles')
</head>
<body>

@include('layouts.header')

@yield('content')

@include('layouts.footer')

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
<script src="{{ url('lib/jQuery.scrollSpeed.js')}}"></script>
<script>
    $(function() {

        // Default
        jQuery.scrollSpeed(100, 800);
    });
</script>
<script>
    $(document).find('select[name="lang"]').change(function(){
        var lang = $(this).val();
        window.location.href = lang;
    })
</script>
<script>
    if(checkCookie('basket') && (readCookie('basket')).length > 0) {
        var basket = JSON.parse(readCookie('basket'));

        var basket_count = 0;
        $.each(basket, function (key, item) {
            basket_count = parseInt(basket_count) + parseInt(item.count)
        });
    }
    else {
        var basket_count = 0;
    }
    $('.basket_count').text(basket_count);
</script>
    

@yield('scripts')
</body>
</html>