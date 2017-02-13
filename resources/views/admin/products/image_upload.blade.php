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
                            <a href="{{ url('admin/products/edit/'.$product_id) }}" style="color: #e6763e"><span
                                        style="font-weight: bold; font-size: medium">Back to images >></span></a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="errors"></div>
                        <p>Uploaded image size: min-height: 340px, min-width: 340px</p>
                        <form id="my-awesome-dropzone" class="dropzone" action="upload">
                            {{ csrf_field() }}
                            <div class="dropzone-previews"></div>
                            <button type="submit" class="btn btn-primary pull-right">Upload</button>
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

    <!-- Custom js -->
    <script src="/admin/js/product_image_upload.js"></script>
@endsection