<header><!-- Header -->
    <nav class="navbar">
        <div class="heraxosner">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-inline">
                            <li><a href="tel:091700323">(091) 700-323</a></li>
                            <li><a href="tel:077700323">(077) 700-323</a></li>
                            <li><a href="tel:044700323">(044) 700-323</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 text-center">
                        <p class="header-ship-p">Առաքումն անվճար 3000դր և ավել գնումների դեպքում</p>
                    </div>
                    
                </div>      
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{ url('/'.App::getLocale()) }}">
                        <img src="/images/logo.png" alt="/images/logo.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav main-nav" >
                        <li class="active"><a href="{{ url('/'.App::getLocale()) }}">@lang('global.order')</a></li>
                        <li><a href="{{ url('about/'.App::getLocale()) }}">@lang('global.about us')</a></li>
                        <li><a href="{{ url('trainer/login/'.App::getLocale()) }}">@lang('global.I am trainer')</a></li>
                        <li><a href="{{ url('contact/'.App::getLocale()) }}">@lang('global.contact')</a></li>
                    </ul>
                    <div class="droshakner-parent">
                        <select name="lang" id="">
                            <option {{ App::getLocale() == 'am' ? 'selected' : '' }} value="am">AM</option>
                            <option {{ App::getLocale() == 'ru' ? 'selected' : '' }} value="ru">RU</option>
                            <option {{ App::getLocale() == 'en' ? 'selected' : '' }} value="en">EN</option>
                        </select>
                    </div>
                    <div class="dropdown">
                        <ul class="nav navbar-nav dropbtn">
                            <li class="shopping-cart ">
                                <a href="{{ url('basket/'.App::getLocale()) }}">
                                    <img src="/images/zambyux.png" style="vertical-align: middle;" alt="images/zambyux.png">
                                    @lang('global.basket')(<span  class="basket_count"></span>)
                                </a>
                            </li>
                        </ul>
                        @if(count($basket_products) > 0)
                        <div class="dropdown-content basket_dropdown">
                             <ul>
                                 @foreach($basket_products as $product)
                                 <li id="bsk_product_{{ $product['id'] }}">
                                    <a>
                                        <span>
                                            <article style="background: url(/images/products/{{ $product['thumb_image'] ? $product['thumb_image']['name'] : 'noimage.gif' }});">
                                                <mark>{{ $product['count'] }}</mark>
                                            </article>
                                        </span>
                                        <span class="title">{{ $product['title'] }}</span>
                                        <span><label class="total">{{ $product['count']* $product['price'] }}</label>@lang('product.amd')</span>
                                        <span class="fa fa-close remove" data-id="{{ $product['id'] }}"></span>
                                    </a>
                                </li>
                                @endforeach
                             </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header><!-- Header end -->