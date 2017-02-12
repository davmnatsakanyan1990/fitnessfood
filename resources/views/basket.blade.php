@extends('layouts.app')
@section('styles')
<!-- select2 -->
<!--  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
@endsection
@section('content')
<main class="basket-main">
    <div class="container">
        <h3 class="basket-title">@lang('global.basket')</h3>
        @if(count($products) > 0)
        <div class="not_empty">
            <div class="row for-table basket-table">
                <!--Row For table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>@lang('product.name')</th>
                            <th class="text-center th-gin">@lang('product.price')</th>
                            <th class="text-center">@lang('product.count')</th>
                            <th class="text-right">@lang('product.total')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr id="tr_{{ $product['id'] }}">
                            <td class="name-td">
                                <img src="/images/products/{{ $product['thumb_image'] ? $product['thumb_image']['name'] : 'noimage.gif' }}"
alt="prod">
                                <span>{{ $product['title'] }}</span>
                            </td>
                            <td class="text-center td-gin">{{ $product['price'] }}@lang('product.amd')</td>
                            <td class="text-center">
                                <div class="prod-inf">
                                    <div class="quantity-wrap clearfix">
                                        <div>
                                            <form class="quantity-form"
                                                  method="POST"
                                                  action="#"
                                                  data-id="{{ $product['id'] }}"
                                                  data-price="{{ $product['price'] }}">
                                                <div>
                                                    <input type="text"
                                                           name="quantity"
                                                           value="{{ $product['count'] }}"
                                                           class="qty"></div>
                                                <div>
                                                    <input type="button"
                                                           value="+"
                                                           class="qtyplus"
                                                           field="quantity">
                                                    <input type="button"
                                                           value="−"
                                                           class="qtyminus"
                                                           field="quantity"></div>
                                            </form>
                                            <input type="hidden" value="{{ $total }}" name="total"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right td-prc">
                                <span class="amount">{{ $product['price'] * $product['count'] }}</span>
                                @lang('product.amd')
                            </td>
                            <td class="text-right close-prod">
                                <a style="cursor: pointer; text-decoration: none;" class="remove" data-id="{{ $product['id'] }}">&#10005;</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-right">
                                <span class="freeshipping" {{ $total >
                                    $min_amount_free_shipping ? '' : 'hidden' }}>@lang('global.free_shipping')
                                </span>
                                <span class="shipping" {{ $total < $min_amount_free_shipping ? '' : 'hidden' }}>@lang('global.shipping'): {{ $shipping }}</span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <!-- basket-form row-->
                <div class="basket-form">
                    <ul class="list-inline prc-ul">
                        <li>@lang('product.total')</li>
                        <li>
                            <span id="total">{{ $total }}</span>
                            @lang('product.amd')
                            <span {{ $total >
                                $min_amount_free_shipping ? 'hidden' : '' }} class="shipping_amount">+ {{ $shipping }}@lang('product.amd')
                            </span>
                        </li>
                    </ul>
                    <hr>
                    <div class="basket-form-div">
                        @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @endif

                        <form action="{{ url('orders/new/'.App::getLocale()) }}" method="post">
                            {{ csrf_field() }}
                            <div class="basket-first-inps">
                                <input name="name" type="text" value="{{ old('name') }}" placeholder="@lang('auth.name')">
                                <input name="phone" type="text" value="{{ old('phone') }}" placeholder="@lang('auth.tel')."></div>

                            <div class="check-box">
                            
                                <span style="display:block; text-align:center; font-size:18px;">@lang('global.advised by trainer')</span>
                            </div>

                            <select class="selectpicker" data-show-subtext="true" data-live-search="true">
                                <option data-subtext="" data-content="<img src='/images/profile/face.png'><span style='display:inline-block;'>Ալեքսանդր Հարությունյան</span>
                                    <br>
                                    <span>GoldGym</span>
                                ">
                                </option>

                                <option data-subtext="" data-content="<img src='/images/profile/face.png'><span style='display:inline-block;'>Դավիթ Հարությունյան</span>
                                    <br>
                                    <span>GoldGym</span>            
                                ">

                                </option>

                                <option data-subtext="" data-content="<img src='/images/profile/face.png'><span style='display:inline-block;'>Ալեքսանդր Թամանյան</span>
                                    <br>
                                    <span>GoldGym</span>
                                ">
                                </option>
                            </select>

                            <input type="checkbox" name="is_addvised" id="voch-voq">
                            <label for="voch-voq" class="voch-voq-label"></label>
                            <span>Ոչ ոք</span>
                            <button type="submit"
{{ count($products) == 0 ? 'disabled' : '' }} class="submit universal-buton">@lang('global.order')</button>
                        </form>

                    </div>
                    <!-- basket-form-div end --> </div>
                <!-- basket-form --> </div>
            <!-- Row --> </div>
        @else
        <div class="empty">
            @if(session('success'))
            <div class="col-md-offset-4 col-md-4">
                <div class="alert alert-success" style="margin-top: 30px">
                    <p>{{ trans(session('success')) }}</p>
                </div>
            </div>
            @endif
            <div class="col-md-offset-4 col-md-4">
                <div style="margin-top: 50px; font-size: larger" class="row text-center">
                    <h1>@lang('global.basket is empty')</h1>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- Container -->
</main>
@endsection

@section('scripts')
<script src="{{ url('select2-4.0.3/dist/js/select2.min.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script>
var min_amount_free_shipping = '{{ $min_amount_free_shipping }}';
var bsk_empty = '{{ trans('global.basket is empty') }}';
</script>
<script src="/js/basket.js"></script>
@endsection