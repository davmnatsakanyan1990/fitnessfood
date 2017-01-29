@extends('layouts.app')
@section('content')
    <main class="register-main">
    	<div class="registration-block">
    		<p>@lang('auth.register')</p>
			@if(count($errors->all()) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
    		<form action="{{ url('trainer/register/'.App::getLocale()) }}" method="post">
				{{ csrf_field() }}
    			<input name="first_name" type="text" placeholder="@lang('auth.name')">
    			<input name="last_name" type="text" placeholder="@lang('auth.surname')">
    			<input name="phone" type="tel" placeholder=" @lang('auth.tel')։">
    			<input name="email" type="email" placeholder="@lang('auth.email')">
    			<input name="workplace" type="text" placeholder="@lang('auth.workplace')">
    			<input name="address" type="text" placeholder="@lang('auth.address')">
    			<input name="date_of_birth" type="text" placeholder="@lang('auth.date of birthday')">
    			<input name="password" type="password" placeholder="@lang('auth.password')">
    			<input name="password_confirmation" type="password" placeholder="@lang('auth.password_confirm')">
    			<input type="submit" value="@lang('auth.register')">
    		</form>
    	</div>
    </main>
@endsection