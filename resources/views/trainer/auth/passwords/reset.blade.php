<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trainer - Forgot password</title>

    <link href="/template/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/template/css/animate.css" rel="stylesheet">
    <link href="/template/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg"> 
<div class="passwordBox animated fadeInDown">
    <div class="row">

        <div class="col-md-12">
            <div class="ibox-content">

                <h2 class="font-bold">Reset your password</h2>

                <div class="row">

                    <div class="col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="m-t" role="form" method="POST" action="{{ url('trainer/password/reset') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="form-group">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email">

                                @if ($errors->has('email'))
                                    <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                                @endif

                            </div>
                            <div class="form-group">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                                @if ($errors->has('password'))
                                    <span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
                                @endif

                            </div>

                            <div class="form-group">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                                @endif

                            </div>

                            <button type="submit" class="btn btn-primary block full-width m-b">
                                <i class="fa fa-btn fa-refresh"></i> Reset Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr/>
</div>

</body>

</html>


