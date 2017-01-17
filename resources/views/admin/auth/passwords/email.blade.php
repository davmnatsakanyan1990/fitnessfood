<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin - Forgot password</title>

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

                <h2 class="font-bold">Forgot password</h2>

                <p>
                    Enter your email address and your password will be reset and emailed to you.
                </p>

                <div class="row">

                    <div class="col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="m-t" role="form" method="POST" action="{{ url('admin/password/email') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input name="email" value="{{ old('email') }}" type="email" class="form-control" placeholder="Email address" required="">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary block full-width m-b">Send Password Reset Link</button>

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

