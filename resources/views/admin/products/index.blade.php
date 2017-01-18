@extends('admin.layouts.index')
@section('styles')
    <link rel="stylesheet" href="/admin/css/products.css">
    <link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        @if(session('message'))
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                            <p>{{ session('message') }}</p>
                        </div>
                        @endif
                        <a href="{{ url('admin/products/create') }}"><button class="btn btn-warning pull-right " type="button"><i style="padding-right: 7px" class="fa fa-plus"></i>&nbsp;Add Product</button></a>
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="6">
                            <thead>
                            <tr>

                                <th data-hide="phone">Image</th>
                                <th data-toggle="true">Product Name</th>
                                <th data-hide="phone">Description</th>
                                <th data-hide="phone">Price</th>
                                <th data-hide="phone">Status</th>
                                <th class="text-right" data-sort-ignore="true">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(count($products) > 0)
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <img src="/images/productImages/{{ $product->thumb_image ? $product->thumb_image->name : 'noimage.gif'}}" class="img-thumbnail" width="100">
                                </td>
                                <td>
                                    {{ $product->title }}
                                </td>
                                <td class="description">
                                    {{ $product->description }}
                                </td>
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td class="footable-visible">
                                    @if($product->status == 0)
                                    <span class="label label-primary">Available</span>
                                    @elseif($product->status == 1)
                                        <span class="label label-warning">Not Available</span>
                                    @endif
                                </td>
                                <td class="text-right action">
                                    <div class="btn-group">
                                        <a href="{{ url('admin/products/edit/'.$product->id) }}"><button class="btn-white btn btn-xs">Edit</button></a>
                                        <button style="color: #337ab7" data-id="{{ $product->id }}" class=" delete btn-white btn btn-xs">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr><td class="text-center" colspan="6">There aren't any products</td></tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--{{ $products->links() }}--}}
@endsection
@section('scripts')
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>


    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        var token = '{{ csrf_token() }}';
    </script>

    <script src="/admin/js/products.js"></script>

@endsection