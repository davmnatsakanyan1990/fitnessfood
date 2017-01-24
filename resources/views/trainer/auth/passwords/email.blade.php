@extends('layouts.app')
@section('content')
    <main>
        <div class="login-marzich">
            <h3>Մոռացել եմ գաղտնաբառը</h3>
            <p>Մուտքագրեք ձեր էլ-փոստը և կստանաք գաղտնաբառը վերականգնող հաղորդագրություն</p>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ url('trainer/password/email') }}">
                {{ csrf_field() }}
                <input name="email" value="{{ old('email') }}" type="email" placeholder="Էլ-հասցե">
                <div>
                    <button type="submit" class="login-reg-button">Ողարկել</button>
                </div>

            </form>
        </div>
    </main>
@endsection