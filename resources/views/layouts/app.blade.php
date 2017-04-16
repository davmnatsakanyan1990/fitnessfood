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

    <meta property="fb:app_id"        content="{{ env('FB_APP_ID') }}" />
    <meta property="og:url"           content="{{ url()->current() }}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Fitness Cook" />
    <meta property="og:description"   content="Պատվիրեք Առանց Ալյուրի և Շաքարի Քաղցրավենիքներ Ֆիթնես Քուքից" />
    <meta property="og:image"         content="{{ url('/').'/images/for_share_1.png' }}" />
    <meta property="og:image"         content="{{ url('/').'/images/for_share_2.png' }}" />
    <meta property="og:image"         content="{{ url('/').'/images/for_share_3.png' }}" />

    <meta name="title" content="Fitness Cook">
    <meta name="description" content="Your description">
    <link rel="image_src" href="{{ url('/').'/images/logo.png' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Fitness Cook">
    <meta name="twitter:image" content="{{ url('/').'/images/logo.png' }}">
    <meta name="twitter:description" content="Tour description">
    <meta name="twitter:site" content="user">

    <meta itemprop="name" content="Fitness Cook">
    <meta itemprop="description" content="Your description">
    <meta itemprop="image" content="{{ url('/').'/images/logo.png' }}">


    <script>
        var BASE_URL = '{{ url('/') }}';
        var token = '{{ csrf_token() }}';
        var locale = '{{ App::getLocale() }}';
    </script>

    {{--<link rel="stylesheet" href="/rrssb-master/css/rrssb.css" />--}}
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
 

<!-- Custom script -->
<script src="/js/main.js"></script>
{{--<script src="/rrssb-master/js/rrssb.js"></script>--}}
@yield('scripts')
</body>
</html>