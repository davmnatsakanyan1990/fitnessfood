@extends('admin.layouts.index')

@section('styles')

@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-md-10">
            <h2>Recipes</h2>
        </div>
        <div class="col-md-2">
            <h2>
                <a href="#">
                    <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Recipe</button>
                </a>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <ul class="notes">
                    @foreach($recipes as $recipe)
                    <li>
                        <div>
                            <small>{{ date("F j, Y, g:i a", strtotime($recipe->created_at))  }}</small>
                            <h4>{{ json_decode($recipe->title)->en }}</h4>
                            <p>{{ json_decode($recipe->text)->en }}</p>
                            <a href="{{ url('admin/recipes/delete/'.$recipe->id) }}"><i class="fa fa-trash-o "></i></a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('template/js/plugins/pace/pace.min.js') }}"></script>
@endsection