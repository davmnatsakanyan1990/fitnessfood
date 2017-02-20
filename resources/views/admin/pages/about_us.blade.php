@extends('admin.layouts.index')
@section('styles')
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

@endsection
@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <button id="edit" class="btn btn-primary btn-sm m-l-sm" onclick="edit()" type="button">Edit</button>
                    <button id="save" class="btn btn-primary  btn-sm" onclick="view()" type="button">View</button>
                </div>
                <div class="ibox-content no-padding">

                    <div class="click2edit wrapper p-md">
                        <h3>Lorem Ipsum is simply</h3>
                        dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the industry's</strong> standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                        typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with
                        <br/>
                        <br/>
                        <ul>
                            <li>Remaining essentially unchanged</li>
                            <li>Make a type specimen book</li>
                            <li>Unknown printer</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

    <!-- SUMMERNOTE -->
    <script src="/template/js/plugins/summernote/summernote.min.js"></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

        });
        var edit = function() {
            $('.click2edit').summernote({focus: true});
        };
        var view = function() {
            var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).

            $('.click2edit').destroy();
        };
    </script>
@endsection
