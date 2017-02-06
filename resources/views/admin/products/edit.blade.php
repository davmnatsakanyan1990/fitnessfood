@extends('admin.layouts.index')
@section('styles')
    <link href="/template/css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="/template/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">

    <link href="/template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/admin/css/products.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="/template/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="tab active" id="tab1"><a data-toggle="tab" href="#tab-1"> Product info</a></li>
                        <li class="tab" id="tab2"><a data-toggle="tab" href="#tab-2"> Images</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                @if(count($errors)>0)
                                    <div class="alert alert-danger alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x
                                        </button>
                                        <ul>
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session('message'))
                                    <div class="alert alert-success alert-dismissable">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x
                                        </button>
                                        <p>{{ session('message') }}</p>
                                    </div>
                                @endif
                                <form class="form-horizontal" action="{{ url('admin/products/update') }}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <fieldset class="form-horizontal">
                                        <div class="form-group"><label class="col-sm-2 control-label">Անվանում:</label>
                                            <div class="col-sm-10"><input name="name[am]"
                                                                          value="{{ $product->title ? json_decode($product->title)->am : ''}}"
                                                                          type="text" class="form-control"></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Имя:</label>
                                            <div class="col-sm-10"><input name="name[ru]"
                                                                          value="{{ $product->title ? json_decode($product->title)->ru : '' }}"
                                                                          type="text" class="form-control"></div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Name:</label>
                                            <div class="col-sm-10"><input name="name[en]"
                                                                          value="{{ $product->title ? json_decode($product->title)->en : '' }}"
                                                                          type="text" class="form-control"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Price: </label>
                                            <div class="col-sm-10"><input name="price" value="{{ $product->price }}"
                                                                          type="text" class="form-control"
                                                                          placeholder="AMD"></div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Բնութագիր:</label>
                                            <div class="col-sm-10">
                                                <textarea rows="8" class="form-control" name="description[am]"
                                                          placeholder="Հայերեն">{{$product->description ? json_decode($product->description)->am : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Описание:</label>
                                            <div class="col-sm-10">
                                                <textarea rows="8" class="form-control" name="description[ru]"
                                                          placeholder="Русский">{{$product->description ?  json_decode($product->description)->ru : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Description:</label>
                                            <div class="col-sm-10">
                                                <textarea rows="8" class="form-control" name="description[en]"
                                                          placeholder="English">{{$product->description ? json_decode($product->description)->en : '' }}</textarea>
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Nutritional Value</label>
                                            <div class="col-sm-10"><input name="nutritional_value"
                                                                          type="text"
                                                                          class="form-control"
                                                                          value="{{ old('nutritional_value') ? old('nutritional_value') : $product->nutritional_value }}"
                                                                          placeholder="kcal">
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Proteins</label>
                                            <div class="col-sm-10"><input name="proteins"
                                                                          type="text"
                                                                          class="form-control"
                                                                          value="{{ old('proteins') ? old('proteins') : $product->proteins }}"
                                                                          placeholder="gram">
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Carbs</label>
                                            <div class="col-sm-10"><input name="carbs"
                                                                          type="text"
                                                                          class="form-control"
                                                                          value="{{ old('carbs') ? old('carbs') : $product->carbs }}"
                                                                          placeholder="gram">
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Fats</label>

                                            <div class="col-sm-10"><input name="fats"
                                                                          type="text"
                                                                          class="form-control"
                                                                          value="{{ old('fats') ? old('fats') : $product->fats  }}"
                                                                          placeholder="gram">
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Calories</label>

                                            <div class="col-sm-10"><input name="calories"
                                                                          type="text"
                                                                          class="form-control"
                                                                          value="{{ old('calories') ? old('calories') : $product->calories }}"
                                                                          placeholder="gram">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Weight</label>

                                            <div class="col-sm-10"><input name="weight"
                                                                          type="text"
                                                                          class="form-control"
                                                                          value="{{ old('weight') ? old('weight') : $product->weight }}"
                                                                          placeholder="gram">
                                            </div>
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <div class="form-group"><label class="col-sm-2 control-label">Status:</label>
                                            <div class="col-sm-10">
                                                <select class="form-control m-b" name="status">
                                                    <option {{ $product->status === 0 ? 'selected' : '' }} value="0">
                                                        Available
                                                    </option>
                                                    <option {{ $product->status === 1 ? 'selected' : '' }} value="1">
                                                        Not Available
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="button" class="btn btn-warning">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <a href="{{ url('admin/products/'.$product->id.'/images/new') }}">
                                            <button class="btn btn-warning pull-right add_image"><i class="fa fa-plus"
                                                                                                    style="padding-right: 7px"></i>
                                                Add Image
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="lightBoxGallery" id="gall">
                                    @if(count($product->images) > 0)
                                        @foreach($product->images as $image)
                                            <div class="img_cont">
                                                <img width="100" height="100" src="/images/products/{{ $image->name }}">
                                                <span class="tmb_img {{ $image->role == 1 ? 'show' : ''}}">Thumb image</span>
                                                <div class="tools">
                                                    <div class="delete_image"
                                                         data-id="{{ $image->id }}" {!! $image->role == 1 ? 'style="margin-top: 23px"' : '' !!}>
                                                        <i style="margin-right: 5px" class="fa fa-trash"></i> remove
                                                    </div>
                                                    <div class="set_thumb_image {{ $image->role == 1 ? 'hidden' : '' }}"
                                                         data-product="{{ $product->id }}" data-id="{{ $image->id }}"><i
                                                                style="margin-right: 5px" class="fa fa-check"></i>set as thumb
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <h2 class="text-center">There are no any images</h2>
                                        @endif
                                        <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                                        <div id="blueimp-gallery" class="blueimp-gallery">
                                            <div class="slides"></div>
                                            <h3 class="title"></h3>
                                            <a class="prev">‹</a>
                                            <a class="next">›</a>
                                            <a class="close">×</a>
                                            <a class="play-pause"></a>
                                            <ol class="indicator"></ol>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="/template/js/plugins/footable/footable.all.min.js"></script>
    <!-- SUMMERNOTE -->
    <script src="/template/js/plugins/summernote/summernote.min.js"></script>

    <!-- Data picker -->
    <script src="/template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom js -->
    <script src="/admin/js/product_edit.js"></script>

    <!-- blueimp gallery -->
    <script src="/template/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

@endsection