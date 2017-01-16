@extends('admin.layouts.index')
@section('styles')
    <link rel="stylesheet" href="/admin/css/products.css">
    <link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">
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
                        <a href="{{ url('admin/products/create') }}"><button class="btn btn-xl btn-lg btn-sm btn-warning pull-right " type="button"><i class="fa fa-check"></i>&nbsp;Create Product</button></a>
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="6">
                            <thead>
                            <tr>

                                <th data-toggle="true">Product Name</th>
                                <th data-hide="phone">Description</th>
                                <th data-hide="phone">Price</th>
                                <th data-hide="phone">Status</th>
                                <th class="text-right" data-sort-ignore="true">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
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
                                    <span class="label label-primary">Available</span>
                                </td>
                                <td class="text-right action">
                                    <div class="btn-group">
                                        <a href="#"><button class="btn-white btn btn-xs">View</button></a>
                                        <a href="{{ url('admin/products/edit/'.$product->id) }}"><button class="btn-white btn btn-xs">Edit</button></a>
                                        <a href="#modal-form" class="delete" data-toggle="modal" data-id="{{ $product->id }}"><button class="btn-white btn btn-xs">Delete</button></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
    <div id="modal-form" class="modal fade" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="text-center">
                            <h4>Delete this product?</h4>
                            <form>
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id">
                                <button type="submit" class="btn btn-sm btn-primary yes">Yes</button>
                                <button data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--{{ $products->links() }}--}}
@endsection
@section('scripts')
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>
    <script>
        var BASE_URL = '{{ url('/') }}'
    </script>
  <script src="/admin/js/products.js"></script>
@endsection