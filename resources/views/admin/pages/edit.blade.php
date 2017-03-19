@extends('admin.layouts.index')
@section('styles')
    <link href="/admin/css/pages.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

@endsection
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ ucwords($page->title) }}</h2>
    </div>
    <div class="col-lg-2">
        <h2>
            <button data-toggle="modal" data-target="#newSubPage" class="btn btn-primary"><i class="fa fa-plus"></i> Add Sub-Page</button>
        </h2>
    </div>
</div>
<div class="wrapper wrapper-content edit_page">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            @foreach($page->subPages as $k=>$subPage)
            <li class="{{ $k == 0 ? 'active' : '' }} tab" id="{{ $k }}"><a data-toggle="tab" href="#tab-{{ $k }}">{{ ucwords(json_decode($subPage->title)->en) }}</a></li>
            @endforeach
        </ul>
        <div class="tab-content">
            @if(count($page->subPages) > 0)
                @foreach($page->subPages as $k=>$subPage)
                    <div id="tab-{{ $k }}" class="tab-pane {{ $k == 0 ? 'active' : '' }}">
                    <div class="panel-body">
                        <div class="row ibox">
                            <div class="col-lg-12">
                                <button class="pull-right btn btn-warning btn-sm m-l-sm save" data-id="{{ $subPage->id }}" type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                <button class="pull-right btn btn-danger btn-sm m-l-sm delete" data-id="{{ $subPage->id }}" type="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                            </div>
                        </div>
                        {{-- Editor Armenian --}}
                        <div class="row armenian">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">
                                    <div class="ibox-title row" style="margin: 0">
                                        <div style="display: inline-block; float: left">
                                            <h5>Armenian</h5>
                                            {{--<button class="btn btn-primary btn-sm m-l-sm edit" type="button">Edit</button>--}}
                                            {{--<button class="btn btn-primary  btn-sm view" type="button">View</button>--}}
                                        </div>
                                        <div class="ibox-tools" style="float: right">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content no-padding">
                                        <div class="row">
                                            <div class="col-md-3 title">
                                                <label for="am_title">Title</label>
                                                <input value="{{  json_decode($subPage->title)->am }}" type="text" name="title[am]" class="form-control" id="am_title">

                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="click2edit wrapper p-md">
                                            {!! json_decode($subPage->content)->am  !!}
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
                                            {{--<button class="btn btn-primary btn-sm m-l-sm edit" type="button">Edit</button>--}}
                                            {{--<button class="btn btn-primary  btn-sm view" type="button">View</button>--}}
                                        </div>
                                        <div class="ibox-tools" style="float: right">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content no-padding">
                                        <div class="row">
                                            <div class="col-md-3 title">
                                                <label for="ru_title">Title</label>
                                                <input value="{{ json_decode($subPage->title)->ru }}" type="text" name="title[ru]" class="form-control" id="ru_title">

                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="click2edit wrapper p-md">
                                            {!! json_decode($subPage->content)->ru  !!}
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
                                            {{--<button class="btn btn-primary btn-sm m-l-sm edit" type="button">Edit</button>--}}
                                            {{--<button class="btn btn-primary  btn-sm view" type="button">View</button>--}}
                                        </div>
                                        <div class="ibox-tools" style="float: right">
                                            <a class="collapse-link">
                                                <i class="fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="ibox-content no-padding">
                                        <div class="row">
                                            <div class="col-md-3 title">
                                                <label for="en_title">Title</label>
                                                <input value="{{ json_decode($subPage->title)->en }}" type="text" name="title[en]" class="form-control" id="en_title">

                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="click2edit wrapper p-md">
                                            {!! json_decode($subPage->content)->en  !!}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End --}}

                        <div class="row ibox">
                            <div class="col-lg-12">
                                <button class=" pull-right btn btn-warning btn-sm m-l-sm save" data-id="{{ $subPage->id }}" type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                                <button class="pull-right btn btn-danger btn-sm m-l-sm delete" data-id="{{ $subPage->id }}" type="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            @else
                <h2 class="text-center">The page is empty</h2>
            @endif
        </div>


    </div>

</div>

<!-- New Sub-Page Modal -->
<div class="modal fade" id="newSubPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">New Sub-Page</h4>
            </div>
            <div class="modal-body">
                <form id="new_sub_page_form" method="post" action="{{ url('admin/sub_pages/create') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Armenian</label>
                        <input type="text" name="title[am]" class="form-control" placeholder="Page Title" required>
                    </div>
                    <div class="form-group">
                        <label>Russian</label>
                        <input type="text" name="title[ru]" class="form-control" placeholder="Page Title" required>
                    </div>
                    <div class="form-group">
                        <label>English</label>
                        <input type="text" name="title[en]" class="form-control" placeholder="Page Title" required>
                    </div>
                    <input type="hidden" name="page_id" value="{{ $page->id }}">
                    <input type="hidden" name="contents[am]" value="">
                    <input type="hidden" name="contents[ru]" value="">
                    <input type="hidden" name="contents[en]" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="new_sub_page_form" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

    <!-- SUMMERNOTE -->
    <script src="/template/js/plugins/summernote/summernote.min.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="/admin/js/pages.js"></script>

@endsection
