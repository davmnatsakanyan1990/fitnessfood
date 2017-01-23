<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin | Login</title>

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name"><img src="/images/logo.png"></h1>

        </div>
        <h3>@lang('auth.admin login')</h3>
        @if(count($errors) > 0)
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="m-t" role="form" action="{{ url('admin/login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <input name="username" type="username" class="form-control" placeholder="@lang('auth.username')" required="">
            </div>
            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="@lang('auth.password')" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">@lang('auth.login')</button>

            <a href="{{ url('admin/password/reset?local='.App::getLocale()) }}"><small>@lang('auth.forgot password?')</small></a>
        </form>
    </div>
</div>

<!-- Mainly scripts -->
<script src="/template/js/jquery-2.1.1.js"></script>
<script src="/template/js/bootstrap.min.js"></script>

</body>

</html>
