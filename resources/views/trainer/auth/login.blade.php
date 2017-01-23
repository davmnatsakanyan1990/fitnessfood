@extends('layouts.app')
@section('styles')

@endsection
@section('content')
    <main>
        <div class="login-marzich">
            <h3>Ես մարզիչ եմ</h3>
            <p>ՄՈՒՏՔ</p>
            <form action="#">
            	<input type="mail" placeholder="Էլ-հասցե">
            	<input type="password" placeholder="Գաղտնաբառ">
            	<div class="check-box">
            		<input type="checkbox">
            		<label for="#"></label>
            		<span for="#">Հիշել ինձ</span>
            	</div>
            	<a href="#">Մոռացել եմ գաղտնաբառը</a>
            	<div>
            		<button>Մուտք</button>
            	</div>
            	
            </form>
        </div>
    </main>
@endsection

@section('scripts')

@endsection
