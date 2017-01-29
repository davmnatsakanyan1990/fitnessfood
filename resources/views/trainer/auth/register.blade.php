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
				<span class="d-of-birth">Ծննդյան ամիս ամսաթիվ</span>
				<div class="bfh-datepicker">
					<div class="input-prepend bfh-datepicker-toggle" data-toggle="bfh-datepicker">
						<span class="add-on"><i class="icon-calendar"></i></span>
						<input type="text" class="input-medium">
					</div>
					<div class="bfh-datepicker-calendar">
						<table class="calendar table table-bordered">
							<thead>
							<tr class="months-header">
								<th class="month" colspan="4">
									<a class="previous" href="#"><i class="icon-chevron-left"></i></a>
									<span></span>
									<a class="next" href="#"><i class="icon-chevron-right"></i></a>
								</th>
								<th class="year" colspan="3">
									<a class="previous" href="#"><i class="icon-chevron-left"></i></a>
									<span></span>
									<a class="next" href="#"><i class="icon-chevron-right"></i></a>
								</th>
							</tr>
							<tr class="days-header">
							</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
    			<input name="password" type="password" placeholder="@lang('auth.password')">
    			<input name="password_confirmation" type="password" placeholder="@lang('auth.password_confirm')">
    			<input type="submit" value="@lang('auth.register')">
    		</form>
    	</div>
    </main>
@endsection