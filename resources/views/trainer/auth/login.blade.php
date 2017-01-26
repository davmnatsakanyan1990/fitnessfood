@extends('layouts.app')
@section('styles')

@endsection
@section('content')
    <main>
        <div class="login-marzich">
            <h3>@lang('global.I am trainer')</h3>
            <p>@lang('auth.login')</p>
			@if(count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
            <form action="{{ url('trainer/login') }}" method="post">
				{{ csrf_field() }}
            	<input type="email" placeholder="@lang('auth.email')" name="email">
            	<input type="password" placeholder="@lang('auth.password')" name="password">
            	<div class="check-box">
            		<input type="checkbox" name="remember">
            		<label for="#"></label>
            		<span for="#">@lang('auth.remember me')</span>
            	</div>
            	<a href="{{ url('trainer/password/reset') }}">@lang('auth.forgot password')</a>
            	<div class="login-reg-button">
            		<button type="submit">@lang('auth.login')</button>
            	</div>
            	
            </form>
        </div>
    </main>
@endsection

@section('scripts')

@endsection
