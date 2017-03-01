@extends('trainer.layouts.index')
@section('content')
    <!-- <div class="responsive-height-block">Important</div> -->
    <main>
        <div class="container">
            <div class="row profile-row-main">
                <div class="col-sm-6">
                    <div class="profile-top">
                        <a class="astxik" href="{{ url('trainer/settings/'.App::getLocale()) }}">
                            <img src="/images/profile/astxik.png" alt="profile/astxik.png">
                        </a>
                        <div>
                            <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="profile/face.png">
                            <h2>{{ $trainer->name }} </h2>
                            <h4 style=" font-size: 16px; margin-top: 5px">@lang('global.your promo code'): <span style="color: #892E6B; font-weight: bold">{{ $trainer->promoCode->code }}</span></h4>
                            <h4 style=" font-size: 16px; margin-top: 5px">@lang('global.earning from each trade'): <span style="color: #892E6B; font-weight: bold">{{ $trainer->percent }}%</span></h4>
                        </div>
                        <a href="{{ url('trainer/logout/'.App::getLocale()) }}" class="profile-exit">@lang('auth.logout')</a>
                    </div><!-- Profile top end -->
                </div>
                <div class="col-sm-6">
                    <div class="stanal" id="info"><!-- Stanal row -->
                        <div class=" stanal-info"><!-- Stanal info -->
                            <ul class="list-inline">
                                <li>@lang('global.wallet')</li>
                                <li>{{ $active_bonus }}@lang('product.amd')</li>
                            </ul>
                            <hr>
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    <p>{{ session('error') }}</p>
                                </div>
                            @endif
                            @if(count($errors)>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ url('trainer/payments/new/'.App::getLocale()) }}" method="post" class="kkapnvenq" id="message">
                                {{ csrf_field() }}
                                <input type="number" name="amount" placeholder="{{ $active_bonus < $min_payment_amount ? 0 : $min_payment_amount }}@lang('product.amd')">
                            </form>
                            @if(session('message'))
                                <p>{{ session('message') }}</p>
                            @endif
                            <div class="text-center">
                                <button type="submit" form="message" class="universal-buton">@lang('product.get')</button>
                            </div>

                        </div><!-- Stanal info end-->
                    </div><!-- Stanal row end-->
                </div>
            </div><!--Profile Row end -->

          <div class="row">
            <div role="tabpanel">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#hashiv" aria-controls="hashiv" role="tab" data-toggle="tab">@lang('global.orders')</a>
                </li>
                <li role="presentation">
                  <a href="#poxancum" aria-controls="tab" role="tab" data-toggle="tab">@lang('global.transactions')</a>
                </li>
              </ul>
            
              <!-- Tab panel -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="hashiv">
                  <div class="for-table"><!--Row For table -->           
                      <table class="table">
                        <thead>
                          <tr>
                            <th>@lang('global.date')</th>
                            <th>@lang('global.buyer')</th>
                            <th>@lang('global.phone')</th>
                            <th>@lang('product.total')</th>
                            <th>@lang('global.sale')</th>
                            <th class="text-center prod-percent-th">Եկամուտ</th>
                            <th class="text-center prod-count-th">Գումար</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                          <tr>
                            <td>{{ date( "Y/m/d H:i", strtotime($order->created_at)) }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_phone}}</td>
                            <td>{{ $order->amount }}@lang('product.amd')</td>
                            <td>{{ $order->sale}}%</td>
                            <td class="text-center prod-percent-th">{{ $order->trainer_percent - $order->sale }} %</td>
                            <td class="text-center prod-count-th">{{ $order->amount*($order->trainer_percent - $order->sale)/100 }}@lang('product.amd')</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div><!-- Row For table end -->
                </div>
                <!-- Hashivner end -->
                <!-- Poxancumner  start-->
                <div role="tabpanel" class="tab-pane" id="poxancum">
                  <div class="for-table"><!--Row For table -->           
                      <table class="table">
                        <thead>
                          <tr>
                            <th>@lang('global.date')</th>
                            <th>@lang('product.amount')</th>
                            <th>@lang('global.payment date')</th>
                            <th class="text-center">@lang('global.status')</th>
                            {{--<th class="text-center">@lang('product.count')</th>--}}
                            {{--<th class="text-right">@lang('product.total')</th>--}}
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                          <tr>
                            <td>{{ date( "Y/m/d H:i", strtotime($payment->created_at)) }}</td>
                            <td>{{ $payment->amount }} @lang('product.amd')</td>
                            <td>{{ $payment->payment_date ? date( "Y/m/d H:i", strtotime($payment->payment_date)) : ''  }}</td>
                            <td class="text-center">{{ is_null($payment->payment_date) ? trans('global.pending') : trans('global.paid') }}</td>
                            {{--<td class="text-center">{{ $order->products_count }}</td>--}}
                            {{--<td class="text-right">{{ $order->amount }}@lang('product.amd')</td>--}}
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div><!-- Row For table end -->
                </div>
              </div>
            </div>
          </div>

            <!-- Pagination -->
            {{ $orders->links() }}

           
        </div><!-- Container end -->
    </main>
@endsection