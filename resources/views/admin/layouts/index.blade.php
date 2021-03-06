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
    <link href="/admin/css/custom.css" rel="stylesheet">


    <script>
        var BASE_URL = '{{ url('/') }}';
        var token = '{{ csrf_token() }}';
        var current = '{{ url()->current() }}';
        var pusher_key = '{{ env('PUSHER_KEY') }}'
    </script>

    @yield('styles')
</head>

<body class="">

<div id="wrapper">
    <audio id="xyz" src="/admin/audio/alert.mp3" preload="auto"></audio>
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
<script src="/admin/js/broadcasting.js"></script>

<script>
    $(document).on('click', '.view_message', function(){
        localStorage.setItem('trainer_profile_tab', 'tab1');
    })
</script>
</body>

</html>
