@extends('admin.layouts.index')
@section('styles')
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <link href="/template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/admin/css/products.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="tab active" id="tab1"><a data-toggle="tab" href="#tab-1"> Product info</a></li>
                        <li class="tab" id="tab2"><a data-toggle="tab" href="#tab-2"> Images</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                @if(count($errors)>0)
                                    <div class="alert alert-danger alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session('message'))
                                    <div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                                        <p>{{ session('message') }}</p>
                                    </div>
                                @endif
                                <form class="form-horizontal" action="{{ url('admin/products/update') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <fieldset class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Name:</label>
                                            <div class="col-sm-10"><input name="name" value="{{ $product->title }}" type="text" class="form-control" ></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Price:</label>
                                            <div class="col-sm-10"><input name="price" value="${{ $product->price }}" type="text" class="form-control" placeholder="$160.00"></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Description:</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="description">{{ $product->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Status:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control m-b" name="status">
                                                    <option {{ $product->status === 0 ? 'selected' : '' }} value="0">Available</option>
                                                    <option {{ $product->status === 1 ? 'selected' : '' }} value="1">Not Available</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update</button>
                                        <button type="button" class="btn btn-warning">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <a href="{{ url('admin/products/'.$product->id.'/images/new') }}"><button class="btn btn-warning pull-right add_image"><i class="fa fa-plus" style="padding-right: 7px"></i> Add Image</button></a>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                        <tr>
                                            <th>
                                                Image preview
                                            </th>
                                            <th>
                                                Image url
                                            </th>
                                            <th>
                                               Thumb Image
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($product->images as $image)
                                        <tr>
                                            <td>
                                                <img class="img-thumbnail" width="100" height="100" src="/images/productImages/{{ $image->name }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="{{ url('images/productImages').'/'.$image->name }}">
                                            </td>
                                            <td>
                                                <input data-product="{{ $product->id }}" name="thumb_image" {{ $image->role == 1 ? 'checked': '' }} type="radio" class="form-control" value="{{ $image->id }}">
                                            </td>
                                            <td>
                                                <button class = "delete_image" data-id="{{ $image->id }}" class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
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

    <!-- Data picker -->
    <script src="/template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        var token = '{{ csrf_token() }}';

        $(document).ready(function(){
            if(localStorage.getItem('selected_tab')){
                switch (localStorage.getItem('selected_tab')){
                    case 'tab1':
                            if(!$('#tab1').hasClass('active')){
                                $('#tab1').addClass('active')
                                $('#tab2').removeClass('active')
                                $('#tab-1').addClass('active')
                                $('#tab-2').removeClass('active')
                            }
                        $('#tab1')
                        break;
                    case 'tab2':
                        if(!$('#tab2').hasClass('active')){
                            $('#tab2').addClass('active')
                            $('#tab1').removeClass('active')
                            $('#tab-2').addClass('active')
                            $('#tab-1').removeClass('active')
                        }
                        break
                }
            }

            $('.delete_image').click(function () {
                var row = $(this);
                swal({
                            title: "Are you sure?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#1ab394",
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, cancel plx!",
                            closeOnConfirm: false,
                            closeOnCancel: true },
                        function (isConfirm) {
                            if (isConfirm) {
                                var image_id = row.data('id');
                                $.ajax({
                                    url: BASE_URL+'/admin/products/images/delete/'+image_id,
                                    type: 'post',
                                    data: {
                                        _token: token
                                    },
                                    success: function(data){
                                        row.closest('tr').remove();
                                    }
                                });
                                swal({
                                    title: "Deleted!",
                                    text: 'Image has been deleted.',
                                    type: "success",
                                    confirmButtonColor: "#1ab394",
                                });
                            } else {
//                                swal("Cancelled", "Your imaginary file is safe :)", "error");
                            }
                        });
            });

            $('input[name="thumb_image"]').on('click', function(){
                var id = $(this).val();
                var product_id = $(this).data('product');
                $.ajax({
                    url: BASE_URL+'/admin/products/'+product_id+'/images/set_thumbnail/'+id,
                    type: 'post',
                    data: {
                        _token: token
                    },
                    success: function(data){

                    }
                })
            });

            $('.summernote').summernote();

            $('.input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

        });
    </script>
    <script>
        $('.tab').on('click', function(){
            var id = $(this).attr('id');
            localStorage.setItem('selected_tab', id);
        })
    </script>
@endsection