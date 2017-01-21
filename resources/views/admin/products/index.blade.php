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
                        <h4 class="pull-left">All Products</h4>
                        <a class="pull-right" href="{{ url('admin/products/create') }}"><button class="btn btn-warning pull-right " type="button"><i style="padding-right: 7px" class="fa fa-plus"></i>&nbsp;Add Product</button></a>
                        <div style="border-top: none; border-bottom: 1px dashed #e7eaec; height: 25px" class="hr-line-dashed"></div>
                        @if(session('message'))
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                            <p>{{ session('message') }}</p>
                        </div>
                        @endif
                        <input type="text" class="form-control input-sm m-b-xs" id="filter"
                               placeholder="Search in table">
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="6" data-filter=#filter>
                            <thead>
                            <tr>

                                <th data-sort-ignore="true">Image</th>
                                <th data-toggle="true">Product Name</th>
                                <th data-hide="phone, tablet" data-sort-ignore="true">Description</th>
                                <th data-hide="phone" data-sort-ignore="true">Nutritional</th>
                                <th data-hide="phone" data-sort-ignore="true">Proteins</th>
                                <th data-hide="phone" data-sort-ignore="true">Carbs</th>
                                <th data-hide="phone" data-sort-ignore="true">Fats</th>
                                <th data-hide="phone" data-sort-ignore="true">Calories</th>
                                <th data-hide="phone">Price</th>
                                <th class="text-right" data-sort-ignore="true">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(count($products) > 0)
                            @foreach($products as $product)
                            <tr>
                                <td>
                                    <img src="/images/productImages/{{ $product->thumb_image ? $product->thumb_image->name : 'noimage.gif'}}" class="img-thumbnail img-responsive" width="100">
                                </td>
                                <td>
                                    {{ $product->title }}
                                </td>
                                <td class="description">
                                    {{ $product->description }}
                                </td>
                                <td>
                                    {{ $product->nutritional_value }}
                                </td>
                                <td>
                                    {{ $product->proteins }}
                                </td>
                                <td>
                                    {{ $product->carbs }}
                                </td>
                                <td>
                                    {{ $product->fats }}
                                </td>
                                <td>
                                    {{ $product->calories }}
                                </td>
                                <td>
                                    {{ $product->price }}
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

    <script src="/admin/js/products.js"></script>

@endsection