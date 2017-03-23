@extends('admin.layouts.index')

@section('styles')
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/css/recipes.css') }}">
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
                    <div class="col-lg-4">
                        <a href="{{ url('admin/recipes/all') }}">
                            <button class="btn btn-warning btn-sm m-l-sm delete" type="button"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Cancel</button>
                        </a>
                    </div>
                    <div class="col-lg-4">
                        <div class="user-prof">
                            <div class="user-prof-inner">
                                <input type="file" name="profile_image" id="imgInp">
                                <label for="imgInp" id="uplod-img-label"></label>
                                <img id="blah"
                                     src="/images/products/noimage.gif"
                                     alt="settings/face.png">
                                <p class="text-center">Thumbnail</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button class="pull-right btn btn-primary btn-sm m-l-sm save" type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
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
                        <button class=" pull-right btn btn-primary btn-sm m-l-sm save" type="button"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
                        <a href="{{ url('admin/recipes/all') }}"> <button class="pull-left btn btn-warning btn-sm m-l-sm delete" type="button"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Cancel</button></a>
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
            $('input[name="text[am]"]').val(text_am.trim());

            var text_ru = $(document).find('.russian .click2edit').code();
            $('input[name="text[ru]"]').val(text_ru.trim());

            var text_en = $(document).find('.english .click2edit').code();
            $('input[name="text[en]"]').val(text_en.trim());

            $('#create_form').submit();
        })


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);


                };

                reader.readAsDataURL(input.files[0]);

                $('#profile-form').submit();
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    </script>
@endsection
