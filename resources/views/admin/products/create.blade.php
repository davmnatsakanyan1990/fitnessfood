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
                                <div class="col-sm-10">
                                    <input name="name[am]" value="{{ old('name.am') }}" type="text"
                                           class="form-control" placeholder="Հայերեն">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input name="name[ru]" value="{{ old('name.ru') }}" type="text"
                                           class="form-control" placeholder="Русский">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input name="name[en]" value="{{ old('name.en') }}" type="text"
                                           class="form-control" placeholder="English">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-10"><input name="price" value="{{ old('price') }}" type="text"
                                                              class="form-control" placeholder="AMD"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea rows="5" name="description[am]" class="form-control"
                                              placeholder="Հայերեն">{{ old('description.am') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <textarea rows="5" name="description[ru]" class="form-control"
                                              placeholder="Русский">{{ old('description.ru') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <textarea rows="5" name="description[en]" class="form-control"
                                              placeholder="English">{{ old('description.en') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nutritional Value</label>
                                <div class="col-sm-10"><input name="nutritional_value" type="text" class="form-control"
                                                              value="{{ old('nutritional_value') }}" placeholder="kcal">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Proteins</label>
                                <div class="col-sm-10"><input name="proteins" type="text" class="form-control"
                                                              value="{{ old('proteins') }}" placeholder="gram"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Carbs</label>
                                <div class="col-sm-10"><input name="carbs" type="text" class="form-control"
                                                              value="{{ old('carbs') }}" placeholder="gram"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Fats</label>
                                <div class="col-sm-10"><input name="fats" type="text" class="form-control"
                                                              value="{{ old('fats') }}" placeholder="gram"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Calories</label>
                                <div class="col-sm-10"><input name="calories" type="text" class="form-control"
                                                              value="{{ old('calories') }}" placeholder="gram"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Weight</label>
                                <div class="col-sm-10"><input name="weight" type="text" class="form-control"
                                                              value="{{ old('weight') }}" placeholder="gram"></div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="category">
                                        <option value="0">Select Category</option>
                                        @foreach($categories as $category)
                                            <option {{ old('category') === 0 ? 'selected' : '' }} value="{{ $category->id }}">{{ json_decode($category->name)->en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label style="padding-top: 0" class="col-sm-2 control-label">Show On First Page</label>
                                <div class="col-sm-10">
                                    <input type="checkbox" name="first_page">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <a href="{{ url('admin/products') }}">
                                        <button class="btn btn-warning" type="button">Cancel</button>
                                    </a>
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