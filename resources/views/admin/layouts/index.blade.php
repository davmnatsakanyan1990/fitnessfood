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

<script src="https://js.pusher.com/3.2/pusher.min.js"></script>
<script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('f099d8275bf3d94c6bf9', {
        encrypted: true
    });

    var channel = pusher.subscribe('new-message');
    channel.bind('App\\Events\\NewMessageEvent', function(data) {
        alert('new message');
    });

    var channel = pusher.subscribe('new-order');
    channel.bind('App\\Events\\NewOrderEvent', function(data) {
        if($('.new_orders_count').length > 0){
            var count = $(document).find('.new_orders_count')[0].innerText;
            $(document).find('.new_orders_count').text(parseInt(count)+1);
        }
        else{
            $(document).find('.order_notifi').append('<span class="label label-warning new_messages_count">1</span>');
        }
    });
    var channel = pusher.subscribe('new-trainer');
    channel.bind('App\\Events\\NewTrainerEvent', function(data) {
        alert('new trainer');
    });
</script>
</body>

</html>
