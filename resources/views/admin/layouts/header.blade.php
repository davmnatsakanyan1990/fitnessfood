<div class="row border-bottom">
    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
        </div>
        <ul class="nav navbar-top-links navbar-right">

            <!-- New Card Order -->
            <li class="dropdown card_order_alert">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-credit-card"></i>{!! count($new_card_orders) > 0 ?   '<span class="label label-primary count">'. count($new_card_orders).'</span>' : '' !!}
                </a>
                @if(count($new_card_orders) > 0)
                    <ul class="dropdown-menu dropdown-messages" style="overflow-y: scroll; max-height: 300px" >
                        @foreach($new_card_orders as $card_order)
                            <li id="card_order_{{ $card_order->id }}">
                                <a href="{{ url('admin/promo_card/orders') }}" class="pull-left">
                                    <img alt="image" width="30" class="img-circle" src="/images/trainerImages/{{ $card_order->promo_code->trainer->image ? $card_order->promo_code->trainer->image->name :  'profile-icon.png'}}">
                                </a>
                                <div class="media-body">
                                    <strong>{{ $card_order->promo_code->trainer->name }}</strong> <br>
                                    <p>New Card Order</p>
                                    <small class="text-muted">{{ $card_order->created_at }}</small>
                                </div>
                            </li>
                            <li class="divider"></li>
                        @endforeach
                    </ul>
                @endif
            </li>

            {{-- New Trainers  --}}
            <li class="dropdown trainer_alert">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-users"></i>{!! count($new_trainers) > 0 ?   '<span class="label label-primary count">'. count($new_trainers).'</span>' : '' !!}
                </a>
                @if(count($new_trainers) > 0)
                    <ul class="dropdown-menu dropdown-messages" style="overflow-y: scroll; max-height: 300px" >
                        @foreach($new_trainers as $trainer)
                            <li id="trainer_{{ $trainer->id }}">
                                <a href="/admin/trainers/show/{{ $trainer->id }}" class="pull-left">
                                    <img alt="image" width="30" class="img-circle" src="/images/trainerImages/profile-icon.png">
                                </a>
                                <div class="media-body">
                                    <strong>{{ $trainer->name }}</strong> <br>
                                    <p>New Trainer</p>
                                    <small class="text-muted">{{ $trainer->created_at }}</small>
                                </div>
                            </li>
                            <li class="divider"></li>
                        @endforeach
                    </ul>
                @endif
            </li>

            {{--   New Payments  --}}
            <li class="dropdown message_alert">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-money"></i>{!! count($new_payments) > 0 ?   '<span class="label label-primary count">'. count($new_payments).'</span>' : '' !!}
                </a>
                @if(count($new_payments) > 0)
                <ul class="dropdown-menu dropdown-messages" style="overflow-y: scroll; max-height: 300px" >
                    @foreach($new_payments as $payment)
                        <li id="msg_{{ $payment->id }}">
                            <a href="/admin/trainers/show/{{ $payment->sender->id }}" class="pull-left view_message">
                                <img alt="image" width="30" class="img-circle" src="/images/trainerImages/{{ $payment->sender->image ? $payment->sender->image->name : 'profile-icon.png' }}">
                            </a>
                            <div class="media-body">
                                <strong>{{ $payment->sender->first_name }} {{ $payment->sender->last_name }}</strong> <br>
                                <p>New Payment Request</p>
                                <small class="text-muted">{{ $payment->created_at }}</small>
                            </div>
                        </li>
                    <li class="divider"></li>
                    @endforeach
                </ul>
                @endif
            </li>

            {{--   New Orders  --}}
            <li class="dropdown order_alert">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i> {!! count($new_orders) > 0 ? '<span class="label label-primary count">'. count($new_orders) .'</span>' : '' !!}
                </a>
                @if(count($new_orders) > 0)
                <ul class="dropdown-menu dropdown-alerts" style="overflow-y: scroll; max-height: 300px">
                    @foreach($new_orders as $order)
                        <li id="order_{{ $order->id }}">
                            <a href="{{ url('admin/orders/show/'.$order->id) }}">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> New order
                                    <span class="pull-right text-muted small">{{ date('H:m:s', strtotime($order->created_at)) }}</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    @endforeach
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