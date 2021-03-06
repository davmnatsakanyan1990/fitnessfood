<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/images/profile-icon.png" />
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Admin</strong></span>
                                {{--<span class="text-muted text-xs block">Trainer <b class="caret"></b></span> --}}
                            </span>
                    </a>
                    {{--<ul class="dropdown-menu animated fadeInRight m-t-xs">--}}
                        {{--<li><a href="{{ url('admin/logout') }}">Logout</a></li>--}}
                    {{--</ul>--}}
                </div>
                <div class="logo-element">

                </div>
            </li>
            <li class="{{ url()->current() == url('admin/trainers') ? 'active' : ''  }}">
                <a href="{{ url('admin/trainers') }}"><i class="fa fa-users"></i> <span class="nav-label">Trainers</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Promo Codes</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('admin/promo/all') }}">All Codes</a></li>
                    <li><a href="{{ url('admin/promo_card/orders') }}">Card Orders</a></li>
                </ul>
            </li>
            <li class="{{ url()->current() == url('admin/orders') ? 'active' : ''  }}">
                <a href="{{ url('admin/orders') }}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Orders</span></a>
            </li>
            <li class="{{ url()->current() == url('admin/products') ? 'active' : ''  }}">
                <a href="{{ url('admin/products') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Products</span></a>
            </li>
            <li class="{{ url()->current() == url('admin/payments') ? 'active' : ''  }}">
                <a href="{{ url('admin/payments') }}"><i class="fa fa-money"></i> <span class="nav-label">Payments</span></a>
            </li>
            <li class="{{ url()->current() == url('admin/gyms') ? 'active' : ''  }}">
                <a href="{{ url('admin/gyms') }}"><i class="fa fa-building"></i> <span class="nav-label">Gyms</span></a>
            </li>
            <li class="{{ url()->current() == url('admin/categories') ? 'active' : ''  }}">
                <a href="{{ url('admin/categories') }}"><i class="fa fa-tags"></i> <span class="nav-label">Categories</span></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-list-ul"></i> <span class="nav-label">Pages</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ url('admin/pages/about_us') }}">About us</a></li>
                </ul>
            </li>
            <li class="{{ url()->current() == url('admin/recipes/all') ? 'active' : ''  }}">
                <a href="{{ url('admin/recipes/all') }}"><i class="fa fa-book"></i> <span class="nav-label">Recipes</span></a>
            </li>
            <li class="{{ url()->current() == url('admin/settings') ? 'active' : ''  }}">
                <a href="{{ url('admin/settings') }}"><i class="fa fa-cogs"></i> <span class="nav-label">Settings</span></a>
            </li>
        </ul>

    </div>
</nav>