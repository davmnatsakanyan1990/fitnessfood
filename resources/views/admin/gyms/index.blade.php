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
                        {{--<a class="pull-right" href="{{ url('admin/gyms/new') }}"><button class="btn btn-warning pull-right " type="button"><i style="padding-right: 7px" class="fa fa-plus"></i>&nbsp;Add Gym</button></a>--}}
                        <button class="btn btn-warning pull-right " type="button" data-toggle="modal" data-target="#addGym"><i style="padding-right: 7px" class="fa fa-plus"></i>&nbsp;Add Gym</button>
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
                                        <button data-toggle="modal" data-target="#editGym" data-id="{{ $gym->id }}" class="btn-white btn btn-xs edit">Edit</button>
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

    <!-- New Gym -->
    <div id="addGym" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Gym</h4>
                </div>
                <div class="modal-body">
                    <div class="errors"></div>
                   <form id="new_gym">
                       <div class="form-group">
                           <input type="text" name="name" class="form-control" placeholder="Name">
                       </div>
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="add">Add</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Gym -->
    <div id="editGym" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Gym</h4>
                </div>
                <div class="modal-body">
                    <div class="errors"></div>
                   <form id="edit_gym">
                       <div class="form-group">
                           <input type="text" name="name" class="form-control" placeholder="Name">
                       </div>
                   </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save</button>
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

    <script src="/admin/js/gyms.js"></script>
@endsection