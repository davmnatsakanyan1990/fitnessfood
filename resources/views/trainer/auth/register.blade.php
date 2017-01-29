@extends('layouts.app')
@section('content')
    <main class="register-main">
    	<div class="registration-block">
    		<p>Գրանցվել</p>
    		<form action="#">
    			<input type="text" placeholder="Անուն Ազգանուն">
    			<input type="tel" placeholder=" Հեռ։">
    			<input type="email" placeholder="էլ-փոստ">
    			<input type="text" placeholder="Աշխատանքի վայրը">
    			<input type="text" placeholder="Հասցե">
    			<input type="text" placeholder="Ծննդյան ամիս ամսաթիվ">
    			<input type="submit" value="Գրանցվել">
    		</form>
    	</div>
    </main>
@endsection