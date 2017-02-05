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

    			<input name="first_name" type="text" value="{{ old('first_name') }}" placeholder="@lang('auth.name')">

    			<input name="last_name" type="text" value="{{ old('last_name') }}" placeholder="@lang('auth.surname')">

    			<input name="phone" type="tel" value="{{ old('phone') }}" placeholder=" @lang('auth.tel')։">

    			<input name="email" type="email" value="{{ old('email') }}" placeholder="@lang('auth.email')">

				<select class="form-control" name="gym" style="margin-top: 10px;
																padding: 15px 10px 10px 10px;
																height: 48px;
																font-size: 18px;
																border: 1px solid #999999;
																color: #999999;">
					<option value="">@lang('global.gym')</option>
					@foreach(\App\Models\Gym::all() as $gym)
						<option {{ old('gym') && old('gym') == $gym->id ? 'selected' : '' }} value="{{ $gym->id }}">{{ $gym->name }}</option>
					@endforeach
				</select>

    			<input name="address" type="text" value="{{ old('address') }}" placeholder="@lang('auth.address')">

				<div class="bfh-datepicker" data-name="date_of_birth" data-format="y-m-d" data-placeholder="Date of birthday"></div>

    			<input name="password" type="password" placeholder="@lang('auth.password')">

    			<input name="password_confirmation" type="password" placeholder="@lang('auth.password_confirm')">

    			<input type="submit" value="@lang('auth.register')">
    		</form>
    	</div>
    </main>
@endsection