@extends('admin.layouts.index')
@section('styles')
    <link href="/template/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="/template/css/plugins/dropzone/dropzone.css" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Upload Images</h5>
                        <div class="ibox-tools">
                            <a href="{{ url('admin/products/edit/'.$product_id) }}" style="color: #1ab394"><span style="font-weight: bold; font-size: medium">Back to images >></span></a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id="my-awesome-dropzone" class="dropzone" action="upload">
                            {{ csrf_field() }}
                            <div class="dropzone-previews"></div>
                            <button type="submit" class="btn btn-primary pull-right">Submit this form!</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <!-- DROPZONE -->
    <script src="/template/js/plugins/dropzone/dropzone.js"></script>


    <script>
        $(document).ready(function(){

            Dropzone.options.myAwesomeDropzone = {

                autoProcessQueue: false,
                uploadMultiple: true,
                parallelUploads: 100,
                maxFiles: 100,

                // Dropzone settings
                init: function() {
                    var myDropzone = this;

                    this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });
                    this.on("sendingmultiple", function() {
                    });
                    this.on("successmultiple", function(files, response) {
                    });
                    this.on("errormultiple", function(files, response) {
                    });
                }

            }

        });
    </script>
@endsection