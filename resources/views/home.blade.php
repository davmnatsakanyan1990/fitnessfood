@extends('layouts.app')
@section('content')

    <main class="home-main"><!-- Main section -->
        <section><!-- Slider section -->
            <div class="container">
                <div class="row">
                    <div id="main-slider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="/images/slider/sl-1.png" alt="/images/slider/sl-1.png">
                            </div>
                            <div class="item">
                                <img src="/images/slider/sl-1.png" alt="/images/slider/sl-1.png">
                            </div>
                        </div>
                        <a class="left carousel-control" href="#main-slider" data-slide="prev"><span><img src="/images/slider/l-c.png" alt="lc"></span></a>
                        <a class="right carousel-control" href="#main-slider" data-slide="next"><span><img src="/images/slider/r-c.png" alt=""></span></a>
                    </div>
                </div>
            </div>
        </section><!-- Slider section end-->

        <section><!-- Products section -->
            @if(count($products) > 0)
            @foreach($products as $row)
                <div class="container home-product-cont">
                    <div class="row" style="margin-left: -30px; margin-right: -30px;">
                        @foreach($row as $product)
                        <!-- product -->
                        <div class="col-sm-6 col-md-3" >
                            <div class="tumb-wrap" data-id="{{ $product->id }}">
                                <div class="for-img">
                                    <div class="prod-img product" data-toggle="modal" data-target="#productModal" style="background: url(images/products/{{ $product->thumb_image ? $product->thumb_image->name : 'noimage.gif' }});" data-id="{{ $product->id }}" >
                                    </div>
                                    <div class="prod-inf">
                                        <p class="prd_title">{{ $product->title }}</p>
                                        <div class="clearfix">
                                            <div class="p-kkal">{{ $product->nutritional_value }} @lang('product.kkal') </div>
                                            <div class="p-price"><span class="prd_price">{{ $product->price }}</span><sub>@lang('product.amd')</sub></div>
                                        </div>
                                        <div class="quantity-wrap clearfix">
                                            <div>
                                                <form class='quantity-form' method='POST' action='#'>
                                                    <div>
                                                        <input type='text' name='quantity' value='1' class='qty' />
                                                    </div>
                                                    <div >
                                                        <input type='button' value='&#43;' class='qtyplus' field='quantity' />
                                                        <input type='button' value='&#8722;' class='qtyminus' field='quantity' />
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="add-to-card-wrap">
                                                <button data-id="{{ $product->id }}" class="addToCard-button"><span><img src="images/zambyux-sm.png" alt="images/zambyux.png"></span>@lang('product.add to cart')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- Product info from_m -->
                                <div class="modal-product-info"> 
                                    <h2>@lang('product.nutritional value')</h2>
                                    <h4>@lang('global.per') <label class="nutritional_value"></label>@lang('product.g')</h4>
                                    <hr>
                                    <ul>
                                        <li>@lang('product.proteins') <span><label class="proteins"></label> @lang('product.g')</span></li>
                                        <li>@lang('product.fats') <span><label class="fats"></label> @lang('product.g')</span></li>
                                        <li>@lang('product.carbs') <span><label class="carbs"></label> @lang('product.g')</span></li>
                                        <li>@lang('product.calories') <span><label class="calories"></label> @lang('product.kkal')</span></li>
                                        <li>@lang('product.weight') <span><label class="weight"></label> @lang('product.g')</span></li>
                                    </ul>
                                    <hr>
                                    <p class="product-desc">
                                        Բաղադրություն։ վարսակի թեփ, կաթ 1%, կաթնաշոռ 1%, սուկրալոզա, յուղազերծված կակաո, եգիպտացորենի օսլա, հատապտուղներ, ձու
                                    </p>
                                </div><!-- Product info from_m end -->
                            </div>
                        </div>
                        <!-- product end-->
                        @endforeach
                    </div><!-- Row end -->
                </div><!-- home-product-cont end -->
                    {{--<div class="container opening-block"><!-- Opening Block -->--}}
                        {{--<div class="row">--}}
                    {{--@foreach($row as $product)--}}
                        {{--<div class="reapeating-block" id="{{ $product->id }}"><!-- * 1 * -->--}}
                            {{--<div class="col-md-4">--}}
                                {{--<div class="gall-big">--}}
                                    {{--<img src="images/products/{{ $product->thumb_image ? $product->thumb_image->name : 'noimage.gif' }}" class="img-responsive" alt="">--}}
                                {{--</div>--}}
                                {{--<ul class="sm-gallery-ul list-inline text-center">--}}
                                    {{--@if(count($product->images) > 0)--}}
                                        {{--@foreach($product->images as $image)--}}
                                        {{--<li><a href="javascript:;"><img src="images/products/{{ $image->name }}" data-big-src="images/products/{{ $image->name }}" alt=""></a></li>--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-8">--}}
                                {{--<h2>{{ $product->title }}</h2>--}}
                                {{--<p>{{ $product->description }}</p>--}}
                                {{--<h3>@lang('product.nutritional value') - {{ $product->nutritional_value }}@lang('product.g').</h3>--}}
                                {{--<div class="sp-ch-k">--}}
                                    {{--<div>--}}
                                        {{--<p>@lang('product.proteins')<span>{{ $product->proteins }}@lang('product.g')</span></p>--}}
                                        {{--<p>@lang('product.carbs')<span>{{ $product->carbs }}@lang('product.g')</span></p>--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--<p>@lang('product.fats')<span>{{ $product->fats }}@lang('product.g')</span></p>--}}
                                        {{--<p>@lang('product.calories')<span>{{ $product->calories }}@lang('product.g')</span></p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="social-wrap clearfix"><!-- Social block -->--}}
                                    {{--<div>--}}
                                        {{--<ul class="list-inline">--}}
                                            {{--<li><a href="#"><img src="images/social/share.png" alt="share.png"></a></li>--}}
                                            {{--<li><a href="#"><img src="images/social/1.png" alt="social/1.png"></a></li>--}}
                                            {{--<li><a href="#"><img src="images/social/2.png" alt="social/2.png"></a></li>--}}
                                            {{--<li><a href="#"><img src="images/social/3.png" alt="social/3.png"></a></li>--}}
                                            {{--<li><a href="#"><img src="images/social/4.png" alt="social/4.png"></a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div class="sided-to-social">--}}
                                        {{--<div class="prod-inf">--}}
                                            {{--<div class="clearfix">--}}
                                                {{--<div class="p-price">{{ $product->price }}<sub>@lang('product.amd')</sub></div>--}}
                                            {{--</div>--}}
                                            {{--<div class="quantity-wrap clearfix">--}}
                                                {{--<div>--}}
                                                    {{--<form class="quantity-form" method="POST" action="#">--}}
                                                        {{--<div>--}}
                                                            {{--<input type="text" name="quantity" value="1" class="qty">--}}
                                                        {{--</div>--}}
                                                        {{--<div>--}}
                                                            {{--<input type="button" value="+" class="qtyplus" field="quantity">--}}
                                                            {{--<input type="button" value="−" class="qtyminus" field="quantity">--}}
                                                        {{--</div>--}}
                                                    {{--</form>--}}
                                                {{--</div>--}}
                                                {{--<div class="add-to-card-wrap">--}}
                                                    {{--<button data-id="{{ $product->id }}" class="addToCard-button"><span><img src="images/zambyux-sm.png" alt="images/zambyux.png"></span>@lang('product.add to cart')</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div><!-- prod-info end in opening block -->--}}
                                    {{--</div><!-- Sided to social -->--}}
                                {{--</div><!-- Social block -->--}}
                            {{--</div><!-- col-sm-8 end-->--}}
                        {{--</div><!-- reapiting-block end-->--}}
                    {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}
                @endforeach
            @endif
        </section><!-- Products section -->

        <!-- Modal -->
        <div class="modal fade" id="productModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
              </div>
            <div class="modal-body"><!-- Modal-body -->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="modal-product-info">
                            <h1>Ապրանքի Անվանում</h1>
                            <h2>@lang('product.nutritional value')</h2>
                            <h4>@lang('global.per') <label class="nutritional_value"></label>@lang('product.g')</h4>
                            <hr>
                            <ul>
                                <li>@lang('product.proteins') <span><label class="proteins"></label> @lang('product.g')</span></li>
                                <li>@lang('product.fats') <span><label class="fats"></label> @lang('product.g')</span></li>
                                <li>@lang('product.carbs') <span><label class="carbs"></label> @lang('product.g')</span></li>
                                <li>@lang('product.calories') <span><label class="calories"></label> @lang('product.kkal')</span></li>
                                <li>@lang('product.weight') <span><label class="weight"></label> @lang('product.g')</span></li>
                            </ul>
                            <hr>
                            <p>
                                Բաղադրություն։ վարսակի թեփ, կաթ 1%, կաթնաշոռ 1%, սուկրալոզա, յուղազերծված կակաո, եգիպտացորենի օսլա, հատապտուղներ, ձու
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="carousel-id" data-interval="false" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                {{-- Filling from axaj call--}}
                            </div>
                            <div class="container">
                                
                            </div>
                            <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div><!-- Modal-carousel-end -->
                    </div>
                </div>
                
            </div><!-- Modal-body end-->

            </div>
          </div>
        </div>
    </main><!-- Main sction end -->

@endsection

@section('scripts')
    <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <script>
        var currency = '{{ trans('product.amd') }}'
    </script>
    <script src="/js/home.js"></script>
@endsection