@extends('admin.layouts.index')
@section('styles')
    <!-- FooTable -->
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
                        <h4 class="pull-left">All Gyms</h4>
                        <a class="pull-right" href="{{ url('admin/gyms/new') }}"><button class="btn btn-warning pull-right " type="button"><i style="padding-right: 7px" class="fa fa-plus"></i>&nbsp;Add Gym</button></a>
                        <div style="border-top: none; border-bottom: 1px dashed #e7eaec; height: 25px" class="hr-line-dashed"></div>
                        @if(session('message'))
                            <div class="alert alert-success">
                                <p>{{ session('message') }}</p>
                            </div>
                        @endif
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                            <thead>
                                <tr>
                                    <th data-toggle="true">Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($gyms) > 0)
                            @foreach($gyms as $gym)
                                <tr>
                                    <td>{{ $gym->name }}</td>
                                    <td>
                                        <a style="color: inherit" href="{{ url('admin/gyms/edit/'.$gym->id) }}"><button class="btn-white btn btn-xs">Edit</button></a>
                                        <button data-id="{{ $gym->id }}" class="btn-white btn btn-xs delete">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="2">There aren't any gym</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- FooTable -->
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script>
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
                            var gym_id = row.data('id');
                            $.ajax({
                                url: BASE_URL+'/admin/gyms/delete/'+gym_id,
                                type: 'post',
                                data: {
                                    _token: token
                                },
                                success: function(data){
                                    row.closest('tr').remove();
                                }
                            });
                            swal("Deleted!", "Gym has been deleted.", "success");
                        } else {
//                                swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
        });
    </script>
@endsection