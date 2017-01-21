<div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope"></i>{!! count($new_messages) > 0 ?   '<span class="label label-warning new_messages_count">'. count($new_messages).'</span>' : '' !!}
                </a>
                @if(count($new_messages) > 0)
                <ul class="dropdown-menu dropdown-messages">
                    @foreach($new_messages as $message)
                            <li>
                                <div class="dropdown-messages-box">
                                    <a href="/admin/trainers/show/{{ $message->sender->id }}" class="pull-left">
                                        <img alt="image" class="img-circle" src="/images/trainerImages/{{ $message->sender->image ? $message->sender->image->name : 'profile-icon.png' }}">
                                    </a>
                                    <div class="media-body">
                                        <strong>{{ $message->sender->first_name }} {{ $message->sender->last_name }}</strong> <br>
                                        <p>New Message</p>
                                        <small class="text-muted">{{ $message->created_at }}</small>
                                    </div>
                                </div>
                            </li>
                    <li class="divider"></li>
                    @endforeach
                </ul>
                @endif
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i> {!! $new_orders_count ? '<span class="label label-primary new_orders_count">'. $new_orders_count .'</span>' : '' !!}
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