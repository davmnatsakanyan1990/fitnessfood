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

                        <table class="footable table table-stripped toggle-arrow-tiny footable-loaded default breakpoint" data-page-size="15">
                            <thead>
                            <tr>

                                <th data-toggle="true" class="footable-visible footable-sortable footable-first-column">Product Name<span class="footable-sort-indicator"></span></th>
                                <th data-hide="all" class="footable-sortable" >Description<span class="footable-sort-indicator"></span></th>
                                <th data-hide="phone" class="footable-visible footable-sortable">Price<span class="footable-sort-indicator"></span></th>
                                <th data-hide="phone" class="footable-visible footable-sortable">Status<span class="footable-sort-indicator"></span></th>
                                <th class="text-right footable-visible footable-last-column" data-sort-ignore="true">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr class="footable-even" style="">
                                <td class="footable-visible footable-first-column"><span class="footable-toggle"></span>
                                    {{ $product->title }}
                                </td>
                                <td class="description">
                                    {{ $product->description }}
                                </td>
                                <td class="footable-visible">
                                    {{ $product->price }}
                                </td>
                                <td class="footable-visible">
                                    <span class="label label-primary">Available</span>
                                </td>
                                <td class="text-right footable-visible footable-last-column">
                                    <div class="btn-group">
                                        <a href="#"><button class="btn-white btn btn-xs">View</button></a>
                                        <a href="{{ url('admin/products/edit/'.$product->id) }}"><button class="btn-white btn btn-xs">Edit</button></a>
                                        <a href="#modal-form" class="delete" data-toggle="modal" data-id="{{ $product->id }}"><button class="btn-white btn btn-xs">Delete</button></a>
                                    </div>
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
    <div id="modal-form" class="modal fade" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="text-center">
                            <h4>Delete this product?</h4>
                            <form method="post" action="{{ url('admin/products/delete') }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="product_id">
                                <button type="submit" class="btn btn-sm btn-primary">Yes</button>
                                <button data-dismiss="modal" class="btn btn-sm btn-warning">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ $products->links() }}
@endsection
@section('scripts')
    <script src="/template/js/plugins/pace/pace.min.js"></script>
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>
    <script>
        $('.action .delete').on('click', function(){
            var product_id = $(this).data('id');
            $('#modal-form').find('input[name="product_id"]').val(product_id);
        })
    </script>
@endsection