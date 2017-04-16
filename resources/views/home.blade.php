@extends('layouts.app')
@section('content')
    <div class="responsive-height-block"><!-- Important --></div>
    <main class="home-main"><!-- Main section -->
        <section><!-- Products section -->
            <!-- Sub menu -->
            <!-- end menu -->
            <div class="container home-product-cont">
                <div class="row">
                    <div class="col-md-3 side-bar">
                        <div class="side-bar-cont">
                            <div class="filter-navmenu-wrap">
                                <ul>
                                    @foreach($categories as $category)
                                        <li class="{{ request('cat') == $category->id ? 'filter-active' : '' }}"><a href="{{ url('/'.App::getLocale().'?cat='.$category->id) }}">{{$category->name }}</a></li>
                                    @endforeach

                                </ul>
                            </div>

                            <!-- Delivery Banner -->
                            <div class="delivery-block">
                                <div class="car-bef">
                                    <p>Առաքումն</p>
                                    <span>Անվճար</span>
                                </div>
                                <article>3000 դրամ և ավելի գնումների դեպքում</article>
                                <article>Առաքում ենք ամեն օր՝ {{ date("H:i", strtotime($wrk_hr_from)) }} - {{ date("H:i", strtotime($wrk_hr_to)) }}</article>
                            </div>

                            <!-- No Need Registration Banner -->
                            <div class="no-need-reg">
                                <img src="images/girl.png" alt="girl.png">
                                <p>
                                    <span>Գրանցվելու</span>
                                    <span>Կարիք</span>
                                    <span>չկա</span>
                                </p>
                                <div class="clearfix"></div>
                                <ul>
                                    <li>
                                        Ավելացրեք տեսականին
                                        զամբյուղում
                                    </li>
                                    <li>
                                        Մուտքագրեք ձեր
                                        անունը
                                    </li>
                                    <li>
                                        Մուտքագրեք ձեր
                                        հեռախոսահամարը
                                    </li>
                                    <li>
                                        Եվ մենք անմիջապես
                                        կզանգահարենք ձեզ
                                    </li>
                                </ul>
                            </div>

                            <!-- Partner Banner -->
                            <div class="partner-block">
                                <img src="{{ asset('images/menuam.png') }}">
                                <p>Առաքման պաշտոնական գործընկեր</p>

                            </div>
                        </div>
                    </div>
                    @if(count($products) > 0)

                    <div class="col-md-9 product-section">
                        <div class="icons-block row">
                            <div class="col-md-12">
                                <div class="icon-parent">
                                    <div class="img_circle dropdown">

                                        <img class="img-responsive" src="{{ asset('images/icons/Icons_1_'.App::getLocale().'.gif') }}" >

                                        <div class="dropdown-menu">
                                            <p>Շաքարի փոխարեն մենք օգտագործում ենք Սուկրալոզա և ֆրուկտոզա, որոնք անվնաս են և կալորիականությամբ՝ ցածր։</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="icon-parent">
                                    <div class="img_circle dropdown">

                                        <img class="img-responsive" src="{{ asset('images/icons/Icons_2_'.App::getLocale().'.gif') }}" >

                                        <div class="dropdown-menu">
                                            <p>Վարսակի Թեփը չի պարունակում գլյուտեն և լայն կիրառում ունի գլյուտեն ֆրի արտադրանքում։</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="icon-parent">
                                    <div class="img_circle dropdown">

                                        <img class="img-responsive" src="{{ asset('images/icons/Icons_3_'.App::getLocale().'.gif') }}" >

                                        <div class="dropdown-menu">
                                            <p>Մենք չենք օգտագործում որևէ քիմիական հավելանյութեր, արհեստական յուղեր և թթխմորներ։</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="icon-parent">
                                    <div class="img_circle dropdown">

                                        <img class="img-responsive" src="{{ asset('images/icons/Icons_4_'.App::getLocale().'.gif') }}" >

                                        <div class="dropdown-menu">
                                            <p>Մեր ամբողջ արտադրանքը պատրաստվում է 100% Վարսակի թեփից, չի օգտագործվում որևէ այլ տեսակի հացահատիկ կամ հավելում։</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="icon-parent">
                                    <div class="img_circle dropdown">

                                        <img class="img-responsive" src="{{ asset('images/icons/Icons_5_'.App::getLocale().'.gif') }}" >

                                        <div class="dropdown-menu">
                                            <p> Մեր խորհուրդն է՝ Ֆիթնես և Առողջ սնունդ, Սնվեք բնական, բացառեք թթխմորներ, շաքար, քիմիական հավելանյութեր և արհեստական յուղեր պարունակող ցանկացած սնունդ։</p>
                                        </div>

                                    </div>
                                </div>


                            </div>
                        </div>
                        @foreach($products as $product)
                        <div class="col-sm-6 col-md-4" >
                            <div class="tumb-wrap" data-id="{{ $product->id }}">
                                <div class="for-img">
                                    <div class="prd_header">
                                        <p class="prd_title">{{ $product->title }}</p>
                                        <div class="prod-img product" data-toggle="modal" data-target="#productModal" style="background: url(images/products/{{ $product->thumb_image ? $product->thumb_image->name : 'noimage.gif' }});" data-id="{{ $product->id }}" ></div>
                                    </div>
                                    <div class="prod-inf">

                                            <!-- Product info from_m -->
                                        <div class="modal-product-info">
                                            <h2>@lang('product.nutritional value')
                                                <span>(@lang('global.per') <label class="nutritional_value">{{ $product->nutritional_value }}</label>@lang('product.g'))</span>
                                            </h2>

                                            <hr>
                                            <ul>
                                                <li>@lang('product.proteins') <span><label class="proteins">{{ $product->proteins }}</label> @lang('product.g')</span></li>
                                                <li>@lang('product.fats') <span><label class="fats">{{ $product->fats }}</label> @lang('product.g')</span></li>
                                                <li>@lang('product.carbs') <span><label class="carbs">{{ $product->carbs }}</label> @lang('product.g')</span></li>
                                                <li>@lang('product.calories') <span><label class="calories">{{ $product->calories }}</label> @lang('product.kkal')</span></li>
                                                <li>@lang('product.weight') <span><label class="weight">{{ $product->weight }}</label> @lang('product.g')</span></li>
                                            </ul>
                                            <hr>
                                            <p class="product-desc">
                                                {{ $product->description }}
                                            </p>
                                        </div><!-- Product info from_m end -->
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

                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div><!-- Row end -->
            </div>
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
                            <h1 class="prd_name"></h1>
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
                            <p class="description"></p>
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