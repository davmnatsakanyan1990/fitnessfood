@extends('admin.layouts.index')
@section('styles')

@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <form method="post" action="{{ url('admin/gyms/update/'.$gym->id) }}" >
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" value="{{ $gym->name }}" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection