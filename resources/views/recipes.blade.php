@extends('layouts.app')
@section('styles')

@endsection
@section('content')
	<div class="responsive-height-block"><!-- Important --></div>
    <main>
    	<div class="container">
    		<div class="row">
                @foreach($recipes as $recipe)
    			<div class="col-sm-3">
    				<div class="recp-wrap">
	    				<div class="for-reciep-img" style="background: url( '{{ $recipe->profile_image ? "../images/recipes/".$recipe->profile_image->name : "../images/products/noimage.gif" }}')"><!-- For img bg --></div>
	    				<h3>{{ $recipe->title }}</h3>
	    				<hr>
	    				<p>{{ $recipe->text }}</p>
                    </div>
    			</div>
    			@endforeach
    		</div>

    	</div>
    </main>
@endsection
@section('scripts')

@endsection