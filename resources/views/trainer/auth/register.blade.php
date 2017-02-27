@extends('layouts.app')
@section('content')
	<div class="responsive-height-block"><!-- Important --></div>
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

    			<input name="name" type="text" value="{{ old('name') }}" placeholder="@lang('auth.name')">
				<span class="star">*</span>
    			<input name="phone" type="tel" value="{{ old('phone') }}" placeholder=" @lang('auth.tel')։">
				<span class="star">*</span>
    			<input name="email" type="email" value="{{ old('email') }}" placeholder="@lang('auth.email')">
				<span class="star">*</span>
				<select class="form-control" name="gym" style="margin-top: 10px;
																padding: 15px 10px 10px 10px;
																height: 48px;
																font-size: 18px;
																display: inline-block;
																border: 1px solid #999999;
																color: #999999;">
					<option value="">@lang('global.gym')</option>
					@foreach(\App\Models\Gym::all() as $gym)
						<option {{ old('gym') && old('gym') == $gym->id ? 'selected' : '' }} value="{{ $gym->id }}">{{ $gym->name }}</option>
					@endforeach
				</select>
				<span class="star">*</span>
    			<input name="address" type="text" value="{{ old('address') }}" placeholder="@lang('auth.address')">
				<span class="star">*</span>
				<div class="bfh-datepicker" data-name="date_of_birth" data-format="y-m-d" data-placeholder="Date of birthday" style="display: inline-block;"></div>
				<span class="star">*</span>

    			<input name="password" type="password" placeholder="@lang('auth.password')">
				<span class="star">*</span>
    			<input name="password_confirmation" type="password" placeholder="@lang('auth.password_confirm')">
				<span class="star">*</span>
    			<input type="submit" value="@lang('auth.register')">
    		</form>
    	</div>
    </main>
@endsection