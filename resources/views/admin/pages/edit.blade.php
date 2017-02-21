@extends('admin.layouts.index')
@section('styles')
    <link href="/admin/css/pages.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

@endsection
@section('content')
<div class="wrapper wrapper-content edit_page">
    <div class="row ibox">
        <div class="col-lg-12 text-right">
            <button class="btn btn-warning btn-sm m-l-sm save" data-id="{{ $page->id }}" type="button">Save</button>
        </div>
    </div>
    {{-- Editor Armenian --}}
    <div class="row armenian">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title row" style="margin: 0">
                    <div style="display: inline-block; float: left">
                        <h5>Armenian</h5>
                        <button class="btn btn-primary btn-sm m-l-sm edit" type="button">Edit</button>
                        <button class="btn btn-primary  btn-sm view" type="button">View</button>
                    </div>
                    <div class="ibox-tools" style="float: right">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content no-padding">

                    <div class="click2edit wrapper p-md">
                        {!! json_decode($page->content)->am  !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End --}}
    {{-- Editor Russian --}}
    <div class="row russian">
        <div class="col-lg-12">
            <div class="ibox collapsed float-e-margins">
                <div class="ibox-title row" style="margin: 0">
                    <div style="display: inline-block; float: left">
                        <h5>Russian</h5>
                        <button class="btn btn-primary btn-sm m-l-sm edit" type="button">Edit</button>
                        <button class="btn btn-primary  btn-sm view" type="button">View</button>
                    </div>
                    <div class="ibox-tools" style="float: right">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content no-padding">

                    <div class="click2edit wrapper p-md">
                        {!! json_decode($page->content)->ru  !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End --}}
    {{-- Editor English --}}
    <div class="row english">
        <div class="col-lg-12">
            <div class="ibox collapsed float-e-margins">
                <div class="ibox-title row" style="margin: 0">
                    <div style="display: inline-block; float: left">
                        <h5>English</h5>
                        <button class="btn btn-primary btn-sm m-l-sm edit" type="button">Edit</button>
                        <button class="btn btn-primary  btn-sm view" type="button">View</button>
                    </div>
                    <div class="ibox-tools" style="float: right">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content no-padding">

                    <div class="click2edit wrapper p-md">
                        {!! json_decode($page->content)->en  !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    <div class="row ibox">
        <div class="col-lg-12 text-right">
            <button class="btn btn-warning btn-sm m-l-sm save" data-id="{{ $page->id }}" type="button">Save</button>
        </div>
    </div>

</div>
@endsection
@section('scripts')

    <!-- SUMMERNOTE -->
    <script src="/template/js/plugins/summernote/summernote.min.js"></script>
    <script src="/admin/js/pages.js"></script>

@endsection
