@extends('layouts.app')
@section('styles')

@endsection
@section('content')
    <main>
        <div class="login-marzich">
            <h3>Ես մարզիչ եմ</h3>
            <p>ՄՈՒՏՔ</p>
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
            	<input type="email" placeholder="Էլ-հասցե" name="email">
            	<input type="password" placeholder="Գաղտնաբառ" name="password">
            	<div class="check-box">
            		<input type="checkbox" name="remember">
            		<label for="#"></label>
            		<span for="#">Հիշել ինձ</span>
            	</div>
            	<a href="{{ url('trainer/password/reset') }}">Մոռացել եմ գաղտնաբառը</a>
            	<div>
            		<button type="submit">Մուտք</button>
            	</div>
            	
            </form>
        </div>
    </main>
@endsection

@section('scripts')

@endsection
