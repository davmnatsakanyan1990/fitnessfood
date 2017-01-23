@extends('layouts.app')
@section('content')

    <main><!-- Main section -->
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
                    <!-- 1 -->
                    <div class="col-sm-6 col-md-3">
                        <div class="tumb-wrap ">
                            <div class="for-img">
                                <img src="images/products/{{ $product->thumb_image ? $product->thumb_image->name : 'noimage.gif' }}" class="img-responsive" alt="">
                                <div class="prod-inf">
                                    <p>{{ $product->title }}</p>
                                    <div class="clearfix">
                                        <div class="p-kkal">{{ $product->nutritional_value }} կկալ </div>
                                        <div class="p-price">{{ $product->price }}<sub>դր</sub></div>
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
                                            <button data-id="{{ $product->id }}" class="addToCard-button"><span><img src="images/zambyux-sm.png" alt="images/zambyux.png"></span>Ավելացնել</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 1 end-->
                    @endforeach
                </div><!-- Row end -->
            </div><!-- home-product-cont end -->
               {{-- <div class="container opening-block"><!-- Opening Block -->
                    <div class="row">
                        <div class="reapeating-block"><!-- * 1 * -->
                            <div class="col-md-4">
                                <div class="gall-big">
                                    <img src="images/products/gal/1.png" class="img-responsive" alt="opened1.png">
                                </div>
                                <ul class="sm-gallery-ul list-inline text-center">
                                    <li><a href="javascript:;"><img src="images/products/gal/sm1.png" data-big-src="images/products/gal/1.png" alt="pr4.png"></a></li>
                                    <li><a href="javascript:;"><img src="images/products/gal/sm2.png" alt="pr4.png" data-big-src="images/products/gal/2.png"></a></li>
                                    <li><a href="javascript:;"><img src="images/products/gal/sm3.png" alt="pr4.png" data-big-src="images/products/gal/3.png"></a></li>
                                </ul>
                            </div>
                            <div class="col-sm-8">
                                <h2>Կաթնաշոռային Չիզ Քեյք</h2>
                                <p>Բաղադրություն։ վարսակի թեփ, կաթ 1%, կաթնաշոռ 1%, սուկրալոզա, յուղազերծված կակաո, եգիպտացորենի օսլա, հատապտուղներ, ձու</p>
                                <h3>Սննդային Արժեք - 100g.</h3>
                                <div class="sp-ch-k">
                                    <div>
                                        <p>Սպիտակուցներ<span>9.2գ</span></p>
                                        <p>Ճարպեր<span>7.8գ</span></p>
                                    </div>
                                    <div>
                                        <p>Ածխաջրեր<span>8.4գ</span></p>
                                        <p>Կալորիաներ<span>185k</span></p>
                                    </div>
                                </div>

                                <div class="social-wrap clearfix"><!-- Social block -->
                                    <div>
                                        <ul class="list-inline">
                                            <li><a href="#"><img src="images/social/share.png" alt="share.png"></a></li>
                                            <li><a href="#"><img src="images/social/1.png" alt="social/1.png"></a></li>
                                            <li><a href="#"><img src="images/social/2.png" alt="social/2.png"></a></li>
                                            <li><a href="#"><img src="images/social/3.png" alt="social/3.png"></a></li>
                                            <li><a href="#"><img src="images/social/4.png" alt="social/4.png"></a></li>
                                        </ul>
                                    </div>
                                    <div class="sided-to-social">
                                        <div class="prod-inf">
                                            <div class="clearfix">
                                                <div class="p-price">700<sub>դր</sub></div>
                                            </div>
                                            <div class="quantity-wrap clearfix">
                                                <div>
                                                    <form class="quantity-form" method="POST" action="#">
                                                        <div>
                                                            <input type="text" name="quantity" value="0" class="qty">
                                                        </div>
                                                        <div>
                                                            <input type="button" value="+" class="qtyplus" field="quantity">
                                                            <input type="button" value="−" class="qtyminus" field="quantity">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="add-to-card-wrap">
                                                    <button class="addToCard-button"><span><img src="images/zambyux-sm.png" alt="images/zambyux.png"></span>Ավելացնել</button>
                                                </div>
                                            </div>
                                        </div><!-- prod-info end in opening block -->
                                    </div><!-- Sided to social -->
                                </div><!-- Social block -->
                            </div><!-- col-sm-8 end-->
                        </div><!-- reapiting-block end-->

                        <div class="reapeating-block"><!-- * 2 * -->
                            <div class="col-md-4">
                                <div class="gall-big">
                                    <img src="images/products/gal/1.png" class="img-responsive" alt="opened1.png">
                                </div>
                                <ul class="sm-gallery-ul list-inline text-center">
                                    <li><a href="javascript:;"><img src="images/products/gal/sm1.png" data-big-src="images/products/gal/1.png" alt="pr4.png"></a></li>
                                    <li><a href="javascript:;"><img src="images/products/gal/sm2.png" alt="pr4.png" data-big-src="images/products/gal/2.png"></a></li>
                                    <li><a href="javascript:;"><img src="images/products/gal/sm3.png" alt="pr4.png" data-big-src="images/products/gal/3.png"></a></li>
                                </ul>
                            </div>
                            <div class="col-sm-8">
                                <h2>Կաթնաշոռային Չիզ Քեյք</h2>
                                <p>Բաղադրություն։ վարսակի թեփ, կաթ 1%, կաթնաշոռ 1%, սուկրալոզա, յուղազերծված կակաո, եգիպտացորենի օսլա, հատապտուղներ, ձու</p>
                                <h3>Սննդային Արժեք - 100g.</h3>
                                <div class="sp-ch-k">
                                    <div>
                                        <p>Սպիտակուցներ<span>9.2գ</span></p>
                                        <p>Ճարպեր<span>7.8գ</span></p>
                                    </div>
                                    <div>
                                        <p>Ածխաջրեր<span>8.4գ</span></p>
                                        <p>Կալորիաներ<span>185k</span></p>
                                    </div>
                                </div>

                                <div class="social-wrap clearfix"><!-- Social block -->
                                    <div>
                                        <ul class="list-inline">
                                            <li><a href="#"><img src="images/social/share.png" alt="share.png"></a></li>
                                            <li><a href="#"><img src="images/social/1.png" alt="social/1.png"></a></li>
                                            <li><a href="#"><img src="images/social/2.png" alt="social/2.png"></a></li>
                                            <li><a href="#"><img src="images/social/3.png" alt="social/3.png"></a></li>
                                            <li><a href="#"><img src="images/social/4.png" alt="social/4.png"></a></li>
                                        </ul>
                                    </div>
                                    <div class="sided-to-social">
                                        <div class="prod-inf">
                                            <div class="clearfix">
                                                <div class="p-price">700<sub>դր</sub></div>
                                            </div>
                                            <div class="quantity-wrap clearfix">
                                                <div>
                                                    <form class="quantity-form" method="POST" action="#">
                                                        <div>
                                                            <input type="text" name="quantity" value="0" class="qty">
                                                        </div>
                                                        <div>
                                                            <input type="button" value="+" class="qtyplus" field="quantity">
                                                            <input type="button" value="−" class="qtyminus" field="quantity">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="add-to-card-wrap">
                                                    <button class="addToCard-button"><span><img src="images/zambyux-sm.png" alt="images/zambyux.png"></span>Ավելացնել</button>
                                                </div>
                                            </div>
                                        </div><!-- prod-info end in opening block -->
                                    </div><!-- Sided to social -->
                                </div><!-- Social block -->
                            </div><!-- col-sm-8 end-->
                        </div><!-- reapiting-block end-->

                        <div class="reapeating-block"><!-- * 3 * -->
                            <div class="col-md-4">
                                <div class="gall-big">
                                    <img src="images/products/gal/1.png" class="img-responsive" alt="opened1.png">
                                </div>
                                <ul class="sm-gallery-ul list-inline text-center">
                                    <li><a href="javascript:;"><img src="images/products/gal/sm1.png" data-big-src="images/products/gal/1.png" alt="pr4.png"></a></li>
                                    <li><a href="javascript:;"><img src="images/products/gal/sm2.png" alt="pr4.png" data-big-src="images/products/gal/2.png"></a></li>
                                    <li><a href="javascript:;"><img src="images/products/gal/sm3.png" alt="pr4.png" data-big-src="images/products/gal/3.png"></a></li>
                                </ul>
                            </div>
                            <div class="col-sm-8">
                                <h2>Կաթնաշոռային Չիզ Քեյք</h2>
                                <p>Բաղադրություն։ վարսակի թեփ, կաթ 1%, կաթնաշոռ 1%, սուկրալոզա, յուղազերծված կակաո, եգիպտացորենի օսլա, հատապտուղներ, ձու</p>
                                <h3>Սննդային Արժեք - 100g.</h3>
                                <div class="sp-ch-k">
                                    <div>
                                        <p>Սպիտակուցներ<span>9.2գ</span></p>
                                        <p>Ճարպեր<span>7.8գ</span></p>
                                    </div>
                                    <div>
                                        <p>Ածխաջրեր<span>8.4գ</span></p>
                                        <p>Կալորիաներ<span>185k</span></p>
                                    </div>
                                </div>

                                <div class="social-wrap clearfix"><!-- Social block -->
                                    <div>
                                        <ul class="list-inline">
                                            <li><a href="#"><img src="images/social/share.png" alt="share.png"></a></li>
                                            <li><a href="#"><img src="images/social/1.png" alt="social/1.png"></a></li>
                                            <li><a href="#"><img src="images/social/2.png" alt="social/2.png"></a></li>
                                            <li><a href="#"><img src="images/social/3.png" alt="social/3.png"></a></li>
                                            <li><a href="#"><img src="images/social/4.png" alt="social/4.png"></a></li>
                                        </ul>
                                    </div>
                                    <div class="sided-to-social">
                                        <div class="prod-inf">
                                            <div class="clearfix">
                                                <div class="p-price">700<sub>դր</sub></div>
                                            </div>
                                            <div class="quantity-wrap clearfix">
                                                <div>
                                                    <form class="quantity-form" method="POST" action="#">
                                                        <div>
                                                            <input type="text" name="quantity" value="0" class="qty">
                                                        </div>
                                                        <div>
                                                            <input type="button" value="+" class="qtyplus" field="quantity">
                                                            <input type="button" value="−" class="qtyminus" field="quantity">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="add-to-card-wrap">
                                                    <button class="addToCard-button"><span><img src="images/zambyux-sm.png" alt="images/zambyux.png"></span>Ավելացնել</button>
                                                </div>
                                            </div>
                                        </div><!-- prod-info end in opening block -->
                                    </div><!-- Sided to social -->
                                </div><!-- Social block -->
                            </div><!-- col-sm-8 end-->
                        </div><!-- reapiting-block end-->

                        <div class="reapeating-block"><!-- * 4 * -->
                            <div class="col-md-4">
                                <div class="gall-big">
                                    <img src="images/products/gal/1.png" class="img-responsive" alt="opened1.png">
                                </div>
                                <ul class="sm-gallery-ul list-inline text-center">
                                    <li><a href="javascript:;"><img src="images/products/gal/sm1.png" data-big-src="images/products/gal/1.png" alt="pr4.png"></a></li>
                                    <li><a href="javascript:;"><img src="images/products/gal/sm2.png" alt="pr4.png" data-big-src="images/products/gal/2.png"></a></li>
                                    <li><a href="javascript:;"><img src="images/products/gal/sm3.png" alt="pr4.png" data-big-src="images/products/gal/3.png"></a></li>
                                </ul>
                            </div>
                            <div class="col-sm-8">
                                <h2>Կաթնաշոռային Չիզ Քեյք</h2>
                                <p>Բաղադրություն։ վարսակի թեփ, կաթ 1%, կաթնաշոռ 1%, սուկրալոզա, յուղազերծված կակաո, եգիպտացորենի օսլա, հատապտուղներ, ձու</p>
                                <h3>Սննդային Արժեք - 100g.</h3>
                                <div class="sp-ch-k">
                                    <div>
                                        <p>Սպիտակուցներ<span>9.2գ</span></p>
                                        <p>Ճարպեր<span>7.8գ</span></p>
                                    </div>
                                    <div>
                                        <p>Ածխաջրեր<span>8.4գ</span></p>
                                        <p>Կալորիաներ<span>185k</span></p>
                                    </div>
                                </div>

                                <div class="social-wrap clearfix"><!-- Social block -->
                                    <div>
                                        <ul class="list-inline">
                                            <li><a href="#"><img src="images/social/share.png" alt="share.png"></a></li>
                                            <li><a href="#"><img src="images/social/1.png" alt="social/1.png"></a></li>
                                            <li><a href="#"><img src="images/social/2.png" alt="social/2.png"></a></li>
                                            <li><a href="#"><img src="images/social/3.png" alt="social/3.png"></a></li>
                                            <li><a href="#"><img src="images/social/4.png" alt="social/4.png"></a></li>
                                        </ul>
                                    </div>
                                    <div class="sided-to-social">
                                        <div class="prod-inf">
                                            <div class="clearfix">
                                                <div class="p-price">700<sub>դր</sub></div>
                                            </div>
                                            <div class="quantity-wrap clearfix">
                                                <div>
                                                    <form class="quantity-form" method="POST" action="#">
                                                        <div>
                                                            <input type="text" name="quantity" value="0" class="qty">
                                                        </div>
                                                        <div>
                                                            <input type="button" value="+" class="qtyplus" field="quantity">
                                                            <input type="button" value="−" class="qtyminus" field="quantity">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="add-to-card-wrap">
                                                    <button class="addToCard-button"><span><img src="images/zambyux-sm.png" alt="images/zambyux.png"></span>Ավելացնել</button>
                                                </div>
                                            </div>
                                        </div><!-- prod-info end in opening block -->
                                    </div><!-- Sided to social -->
                                </div><!-- Social block -->
                            </div><!-- col-sm-8 end-->
                        </div><!-- reapiting-block end-->
                    </div><!-- Opening row -->
                </div><!-- opening block end -->--}}
            @endforeach
            @endif

        </section><!-- Products section -->
    </main><!-- Main sction end -->

@endsection