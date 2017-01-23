<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FitnessCook</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/styles/fitness.css">

    <script>
        var BASE_URL = '{{ url('/') }}'
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
@yield('scripts')
</body>
</html>