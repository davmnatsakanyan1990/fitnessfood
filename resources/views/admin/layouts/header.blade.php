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
                <a class="dropdown-toggle count-info  order_notifi" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i> {!! $notifications->count() > 0 ? '<span class="label label-primary notifications_count">'. $notifications->count() .'</span>' : '' !!}
                </a>
                @if($notifications)
                <ul class="dropdown-menu dropdown-alerts">
                    <div class="notification_block" style="overflow-y: scroll; max-height: 300px" >
                    @foreach($notifications as $item)
                        @if($item['type'] == 'order')
                        <li id="order_{{ $item['id'] }}">
                            <a href="{{ url('admin/orders/show/'.$item['id']) }}">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have new order
                                    {{--<span class="pull-right text-muted small">4 minutes ago</span>--}}
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        @elseif($item['type'] == 'trainer')
                                <li id="trainer_{{ $item['id'] }}">
                                    <a href="{{ url('admin/trainers/show/'.$item['id']) }}">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> You have new trainer
                                            {{--<span class="pull-right text-muted small">4 minutes ago</span>--}}
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                        @endif
                    @endforeach
                    </div>
                </ul>
                @endif
            </li>


            <li>
                <a href="{{ url('admin/logout/') }}">
                    <i class="fa fa-sign-out"></i> Logout
                </a>
            </li>
        </ul>

    </nav>
</div>