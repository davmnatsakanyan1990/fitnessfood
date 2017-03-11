@extends('trainer.layouts.index')
@section('content')
    <!-- <div class="responsive-height-block">Important</div> -->
    <main style="overflow: hidden;">
        <div class="container">
            <div class="row profile-row-main">
                <div class="col-sm-6">
                    <div class="profile-top">
                        <a class="astxik" href="{{ url('trainer/settings/'.App::getLocale()) }}">
                            <img src="/images/profile/astxik.png" alt="profile/astxik.png">
                        </a>
                        <div>
                            <form id="profile-form" method="post" action="{{ url('trainer/image/update') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="user-prof">
                                    <div class="user-prof-inner">
                                        <input type="file" name="image" id="imgInp">
                                        <label for="imgInp" id="uplod-img-label"></label>
                                        <img id="blah"
                                             src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}"
                                             alt="settings/face.png">
                                    </div>
                                </div>
                            </form>
                            {{--<img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="profile/face.png">--}}
                            <h2>{{ $trainer->name }} </h2>
                            <h4 style=" font-size: 16px; margin-top: 5px">@lang('global.your percent'): <span style="color: #892E6B; font-weight: bold">{{ $trainer->percent }}%</span></h4>
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
              <ul class="nav nav-tabs" id="tree-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#hashiv" aria-controls="hashiv" role="tab" data-toggle="tab">@lang('global.orders')</a>
                </li>
                <li role="presentation">
                  <a href="#poxancum" aria-controls="tab" role="tab" data-toggle="tab">@lang('global.my payments')</a>
                </li>

                <li role="presentation">
                  <a href="#third-tab" aria-controls="tab" role="tab" data-toggle="tab">@lang('global.promo codes')</a>
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
                            <td class="text-center {{ is_null($payment->payment_date) ? '' : 'paid' }}">{{ is_null($payment->payment_date) ? trans('global.pending') : trans('global.paid') }}</td>
                            {{--<td class="text-center">{{ $order->products_count }}</td>--}}
                            {{--<td class="text-right">{{ $order->amount }}@lang('product.amd')</td>--}}
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div><!-- Row For table end -->
                </div>
                <!-- promo codes -->
                <div role="tabpanel" class="tab-pane" id="third-tab">
                  <div class="for-table"><!--Row For table -->           
                      <table class="table">
                        <thead>
                          <tr>
                            <th>@lang('global.code')</th>
                            <th>@lang('global.percent')</th>
                            <th>@lang('global.action')</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($promo_codes as $promo_code)
                          <tr>
                            <td>{{ $promo_code->code }}</td>
                            <td>{{ $promo_code->percent }} %</td>
                            <td>
                                <div class="btn-group">
                                    <button data-id="{{ $promo_code->id }}"  class="card_order btn btn-white btn-xs" data-toggle="modal" data-target="#newCardOrder">@lang('global.order')</button>
                                    <div class="fb-share-button"
                                         data-href="{{ url('trainer/promo_code/share?promo_code='.$promo_code->code) }}"
                                         data-layout="button_count"
                                         data-size="small">Share
                                    </div>
{{--<button data-code="{{ $promo_code->code }}"  class="shareBtn btn btn-white btn-xs" >share</button>--}}
                                </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                  </div><!-- Row For table end -->
                </div>
                <!-- Promo codes end -->
              </div>
            </div>
          </div>

            <!-- Pagination -->
            {{ $orders->links() }}

           
        </div><!-- Container end -->

        <!-- New card order -->
        <div class="modal fade" tabindex="-1" role="dialog" id="newCardOrder" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">@lang('global.card order')</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ url('trainer/card_order/create') }}" id="card_order">
                            {{ csrf_field() }}
                            <input type="hidden" name="card_id">
                            <div class="form-group has-error">
                                <label for="count"></label>
                                <input type="number" id="count" name="count" class="form-control" min="1" placeholder="@lang('global.count')">
                                @if(!$trainer->image)
                                <span class="help-block">@lang('global.Set your profile photo to order a card')</span>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('auth.cancel')</button>
                        <button type="submit" form="card_order" class="btn btn-primary" {{ $trainer->image ? '' : 'disabled'}}>@lang('global.order')</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
<div id="fb-root"></div>
@endsection

@section('scripts')
    <script src="/js/trainer_profile.js"></script>
@endsection