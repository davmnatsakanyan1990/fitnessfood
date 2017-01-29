<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin</title>

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">

    <script>
        var BASE_URL = '{{ url('/') }}';

        var token = '{{ csrf_token() }}';
    </script>

    @yield('styles')

    <script src="https://js.pusher.com/3.2/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('f099d8275bf3d94c6bf9', {
            encrypted: true
        });

        var channel = pusher.subscribe('new-message');
        channel.bind('App\\Events\\NewMessageEvent', function(data) {
            alert(data.name);
        });

        var channel = pusher.subscribe('new-order');
        channel.bind('App\\Events\\NewOrderEvent', function(data) {
            alert('order');
        });
    </script>

</head>

<body class="">

<div id="wrapper">

    @include('admin.layouts.navigation')

    <div id="page-wrapper" class="gray-bg">

        @include('admin.layouts.header')

        @yield('content')

        @include('admin.layouts.footer')

    </div>
</div>

<!-- Mainly scripts -->
<script src="/template/js/jquery-2.1.1.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/template/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="/template/js/inspinia.js"></script>
<script src="/template/js/plugins/pace/pace.min.js"></script>
@yield('scripts')
</body>

</html>
