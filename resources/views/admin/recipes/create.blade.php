@extends('admin.layouts.index')

@section('styles')
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <style>
        .title{
            margin-left: 15px ;
            margin-top: 10px ;
        }
    </style>
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>New Recipe</h2>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="panel-body">
            <form id="create_form" action="{{ url('admin/recipes/save') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row ibox">
                    <div class="col-lg-6">
                        <input type="file" name="profile_image">
                    </div>
                    <div class="col-lg-6">
                        <button class="pull-right btn btn-warning btn-sm m-l-sm save" type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                        <button class="pull-right btn btn-danger btn-sm m-l-sm delete" type="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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
                                        <input  type="text" name="title[am]" class="form-control" id="am_title">

                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <input type="hidden" name="text[am]">

                                <div class="click2edit wrapper p-md">

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
                                        <input  type="text" name="title[ru]" class="form-control" id="ru_title">

                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <input type="hidden" name="text[ru]">

                                <div class="click2edit wrapper p-md">

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
                                        <input type="text" name="title[en]" class="form-control" id="en_title">

                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>

                                <input type="hidden" name="text[en]">

                                <div class="click2edit wrapper p-md">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- End --}}

                <div class="row ibox">
                    <div class="col-lg-12">
                        <button class=" pull-right btn btn-warning btn-sm m-l-sm save" type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                        <button class="pull-right btn btn-danger btn-sm m-l-sm delete" type="button"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection

    @section('scripts')
            <!-- SUMMERNOTE -->
    <script src="/template/js/plugins/summernote/summernote.min.js"></script>

    <script>
        $('.summernote').summernote();

        $('.ibox').find('.click2edit').summernote({focus: true});

        $('.save').on('click', function(e){

            var text_am = $(document).find('.armenian .click2edit').code();
            $('input[name="text[am]"]').val(text_am);

            var text_ru = $(document).find('.russian .click2edit').code();
            $('input[name="text[ru]"]').val(text_ru);

            var text_en = $(document).find('.english .click2edit').code();
            $('input[name="text[en]"]').val(text_en);

            $('#create_form').submit();
        })
    </script>
@endsection
