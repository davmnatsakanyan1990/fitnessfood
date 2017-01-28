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
            @if (count($errors)> 0)
                <div class="alert alert-success">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ url('trainer/password/email') }}">
                {{ csrf_field() }}
                <input name="email" value="{{ old('email') }}" type="email" placeholder="Էլ-հասցե">
                <div class="login-reg-button">
                    <button type="submit">Ողարկել</button>
                </div>

            </form>
        </div>
    </main>
@endsection