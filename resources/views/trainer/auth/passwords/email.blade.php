@extends('layouts.app')
@section('content')
    <main>
        <div class="login-marzich">
            <h3>@lang('auth.forgot password')</h3>
            <p>@lang('auth.forgot password_message')</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (count($errors)> 0)
                <div class="alert alert-success">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ url('trainer/password/email/'.App::getLocale()) }}">
                {{ csrf_field() }}
                <input name="email" value="{{ old('email') }}" type="email" placeholder="@lang('auth.email')">
                <div class="login-reg-button">
                    <button type="submit">@lang('global.send')</button>
                </div>

            </form>
        </div>
    </main>
@endsection