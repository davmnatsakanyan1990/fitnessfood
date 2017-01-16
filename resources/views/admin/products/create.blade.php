@extends('admin.layouts.index')
@section('styles')

@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <h4>Create New Product</h4>
                        <div class="hr-line-dashed"></div>
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{ url('admin/products/save') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10"><input name="name" value="{{ old('name') }}" type="text" class="form-control"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-10"><input name="price" value="{{ old('price') }}" type="text" class="form-control"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10"><textarea name="description" class="form-control">{{ old('description') }}</textarea></div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="status">
                                        <option>Select Status</option>
                                        <option {{ old('status') === 0 ? 'selected' : '' }} value="0">Available</option>
                                        <option {{ old('status') === 1 ? 'selected' : '' }} value="1">Not Available</option>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <a href="{{ url('admin/products') }}"><button class="btn btn-warning" type="button">Cancel</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection