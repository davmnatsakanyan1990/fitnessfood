<header><!-- Header -->
    <nav class="navbar">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="#">
                        <img src="/images/logo.png" alt="/images/logo.png">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav main-nav" >
                        <li class="active"><a href="{{ url('/'.App::getLocale()) }}">@lang('global.products')</a></li>
                        <li><a href="{{ url('about/'.App::getLocale()) }}">@lang('global.about us')</a></li>
                        <li><a href="{{ url('trainer/login/'.App::getLocale()) }}">@lang('global.I am trainer')</a></li>
                        <li><a href="{{ url('contact/'.App::getLocale()) }}">@lang('global.contact')</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="{{ url('basket/'.App::getLocale()) }}">
                                <img src="/images/zambyux.png" style="vertical-align: middle;" alt="images/zambyux.png">
                                @lang('global.basket')(<span  class="basket_count"></span>)
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header><!-- Header end -->