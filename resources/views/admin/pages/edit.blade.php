@extends('admin.layouts.index')
@section('styles')
    <link href="/admin/css/pages.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

@endsection
@section('content')
<div class="wrapper wrapper-content edit_page">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab-1"> Section 1</a></li>
            <li class=""><a data-toggle="tab" href="#tab-2">Section 2</a></li>
            <li class=""><a data-toggle="tab" href="#tab-3">Section 3</a></li>
        </ul>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane active">
                <div class="panel-body">
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
            </div>
            <div id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>
            <div id="tab-3" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>
                    
                </div>
            </div>
        </div>


    </div>

</div>
@endsection
@section('scripts')

    <!-- SUMMERNOTE -->
    <script src="/template/js/plugins/summernote/summernote.min.js"></script>
    <script src="/admin/js/pages.js"></script>

@endsection
