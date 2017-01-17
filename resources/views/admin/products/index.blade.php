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
                                        <button style="color: #337ab7" data-id="{{ $product->id }}" class=" delete btn-white btn btn-xs">Delete</button>
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
    {{--{{ $products->links() }}--}}
@endsection
@section('scripts')
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>
    <script>
        var BASE_URL = '{{ url('/') }}'
    </script>
  <script src="/admin/js/products.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
        var token = '{{ csrf_token() }}'

        $(document).ready(function () {

            $('.delete').click(function () {
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
                                var product_id = row.data('id');
                                $.ajax({
                                     url: BASE_URL+'/admin/products/delete/'+product_id,
                                     type: 'post',
                                     data: {
                                         _token: token
                                     },
                                     success: function(data){
                                         row.closest('tr').remove();
                                     }
                                });
                                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            } else {
//                                swal("Cancelled", "Your imaginary file is safe :)", "error");
                            }
                        });
            });


        });

    </script>
@endsection