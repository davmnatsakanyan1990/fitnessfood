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
                        <h4 class="pull-left">All Categories</h4>
                        <button class="btn btn-warning pull-right " type="button" data-toggle="modal" data-target="#addCategory"><i style="padding-right: 7px" class="fa fa-plus"></i>&nbsp;Add Category</button>
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
                            @if(count($categories) > 0)
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ json_decode($category->name)->am }}<br>
                                            {{ json_decode($category->name)->ru }}<br>
                                            {{ json_decode($category->name)->en }}
                                        <td>
                                            <button data-toggle="modal" data-target="#editCategory" data-id="{{ $category->id }}" class="btn-white btn btn-xs edit">Edit</button>
                                            <button data-id="{{ $category->id }}" class="btn-white btn btn-xs delete">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="2">There aren't any categories</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Category -->
    <div id="addCategory" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Category</h4>
                </div>
                <div class="modal-body">
                    <div class="errors"></div>
                    <form id="new_cat" method="post" action="{{ url('admin/categories/new') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="name[am]" class="form-control" placeholder="Անվանումը" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name[ru]" class="form-control" placeholder="Имя" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name[en]" class="form-control" placeholder="Name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="new_cat" id="add">Add</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Category -->
    <div id="editCategory" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div class="errors"></div>
                    <form id="edit_cat" method="post" action="{{ url('admin/categories/update') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="name[am]" class="form-control" placeholder="Անվանումը" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name[ru]" class="form-control" placeholder="Имя" required>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name[en]" class="form-control" placeholder="Name" required>
                        </div>
                        <input type="hidden" name="cat_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="edit_cat" id="save">Save</button>
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

    <script src="/admin/js/category.js"></script>
@endsection
