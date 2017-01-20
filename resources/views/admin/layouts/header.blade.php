<div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>  <span class="label label-warning">{{ $new_messages_count }}</span>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <div class="text-center link-block">
                            <a href="{{ url('admin/messages') }}">
                                <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i> {!! $new_orders_count ? '<span class="label label-primary">'. $new_orders_count .'</span>' : '' !!}
                </a>
                @if($new_orders_count)
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a>
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have {{ $new_orders_count }} new orders
                                {{--<span class="pull-right text-muted small">4 minutes ago</span>--}}
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="{{ url('admin/orders') }}">
                                <strong>See All Orders</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
                @endif
            </li>


            <li>
                <a href="{{ url('admin/logout') }}">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>

    </nav>
</div>