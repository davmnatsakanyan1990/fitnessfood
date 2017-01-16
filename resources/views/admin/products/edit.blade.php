@extends('admin.layouts.index')
@section('styles')
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <link href="/template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">

        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1"> Product info</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2"> Images</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                @if(count($errors)>0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
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
                                        <tr>
                                            <td>
                                                <img src="img/gallery/2s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image1.png">
                                            </td>
                                            <td>
                                                <input type="radio" class="form-control">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
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

    <script>
        $(document).ready(function(){

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
@endsection