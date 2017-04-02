@extends('layouts.app')
@section('styles')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
@endsection
@section('content')
<div class="responsive-height-block"><!-- Important --></div>
<main class="basket-main">
    <div class="container">
        
        {{--<div class="row">--}}
            {{--<div class="headerimg-div">--}}

            {{--</div>--}}
        {{--</div>--}}
        <h3 class="basket-title">@lang('global.basket')</h3>
        @if(count($products) > 0)
        <div class="not_empty">
            <form action="{{ url('orders/new/'.App::getLocale()) }}" method="post">
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
                                    <img src="/images/products/{{ $product['thumb_image'] ? $product['thumb_image']['name'] : 'noimage.gif' }}" alt="prod">
                                    <span>{{ $product['title'] }}</span>
                                </td>
                                <td class="text-center td-gin">{{ $product['price'] }}@lang('product.amd')</td>
                                <td class="text-center">
                                    <div class="prod-inf">
                                        <div class="quantity-wrap clearfix">
                                            <div>
                                                <div class="quantity-form"
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
                                                </div>
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
                                    <span class="freeshipping" {{ $total >=
                                        $min_amount_free_shipping ? '' : 'hidden' }}>@lang('global.free_shipping')
                                    </span>
                                    <span class="shipping" {{ $total < $min_amount_free_shipping ? '' : 'hidden' }}>@lang('global.shipping'): {{ $shipping }} @lang('product.amd')</span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row" id="show_error">
                    <!-- basket-form row-->
                    <div class="basket-form">
                        <ul class="list-inline prc-ul clearfix">
                            <li>@lang('product.total')</li>
                            <li>
                                <span id="total">{{ $total + $final_shipping }}</span>
                                @lang('product.amd')
                            </li>
                        </ul>
                        <hr>
                        <div class="basket-form-div">
                            {{ csrf_field() }}
                            <div class="basket-first-inps">

                                <!-- Name Field -->
                                <label for="Yname">@lang('global.insert your name')</label>
                                <input class="{{ $errors->has('name') ? 'inputDanger' : '' }}" id="Yname" name="name" type="text" value="{{ old('name') }}" placeholder="@lang('global.your name')">
                                <span class="star">*</span>
                                <p class="{{ $errors->has('name') ? 'show' : '' }}">{{ $errors->first('name') }}</p>

                                <!-- Phone Field -->
                                <label for="Yphone">@lang('global.insert your phone')</label>
                                <input class="{{ $errors->has('phone') ? 'inputDanger' : '' }}" id="Yphone" name="phone" id="phone" type="text" value="{{ old('phone') }}" placeholder="(099) 999-999" >
                                <span class="star">*</span>
                                <p class="{{ $errors->has('phone') ? 'show' : '' }}">{{ $errors->first('phone') }}</p>

                                <!-- Promo Field -->
                                <label for="Ypromo"> @lang('global.Do you have a promo code?')</label>
                                @if(isset($_COOKIE['promo_code']))
                                    <input class="{{ $errors->has('promo_code') ? 'inputDanger' : '' }}" id="Ypromo" name="promo_code" maxlength="4" minlength="4" type="text" value="{{ $_COOKIE['promo_code'] }}" placeholder="1234">
                                @else
                                    <input class="{{ $errors->has('promo_code') ? 'inputDanger' : '' }}" id="Ypromo" name="promo_code" maxlength="4" minlength="4" type="text" value="{{ old('promo_code') ? old('promo_code') : '' }}" placeholder="1234">
                                @endif
                                <span class="greencheck" style="display: none">
                                    <img src="../images/greencheck.png" alt="green">
                                </span>
                                <span class="redcross" style="display: none">
                                    <img src="../images/redcross.png" alt="green">
                                </span>
                                <p class="{{ $errors->has('promo_code') ? 'show' : '' }}">{{ $errors->first('promo_code') }}</p>

                                <!-- Trainer search field -->
                                <label>Շնորհակա՞լ եք Առողջ Խորհուրդի Համար։</br>
                                    Նշեք Ձեր Խորհրդատուին և Պարգևեք Անակնկալ Ձեր Անունից :)</label>
                                <div class="marzich-search">
                                    <input type="text" name="search" placeholder="@lang('global.counselor name')">
                                    <span><i class="fa fa-search" aria-hidden="true"></i></span>
                                </div>

                                <div class="v-voq">
                                    <input {{ old('trainer') == "0" ? 'checked' : '' }} type="checkbox" value="0" id="tr4-na" name="trainer">
                                    <label for="tr4-na" id="tr4-cover"></label>
                                    <label for="tr4-na">@lang('global.nobody')</label>
                                </div>

                                <!-- Sale amount -->
                                <ul class="list-inline prc-ul" style="margin-top: 20px; display: none">
                                    <li>@lang('global.discounted')</li>
                                    <li class="old-price"></li>
                                    <li>
                                        <span id="zexchvats"></span>
                                        <span>@lang('product.amd')</span>
                                    </li>
                                </ul>

                                <hr>

                            </div>
                            <button type="submit" {{ count($products) == 0 ? 'disabled' : '' }} class="submit universal-buton">@lang('global.order')</button>
                            @if($errors->has('trainer'))
                                <div class="alert alert-danger" style="margin-top: 10px; background-color: #FF2036; color: #ffffff; border-radius: 15px">
                                    <p>{{ $errors->first('trainer') }}</p>
                                </div>
                            @endif
                        </div> <!-- basket-form-div end -->
                    </div> <!-- basket-form -->
                </div>
                <div class="row trainer-select-main">
                @foreach($trainers as $trainer)
                <div class="col-sm-3">
                    <div class="trainer-select">
                        <input type="radio" {{ old('trainer') == $trainer->id ? 'checked' : '' }} value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="trainer" class="add-to-s">
                        <label for="tr{{ $trainer->id }}">
                            <div class="trainer-inner-content">
                                <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
                                <div>
                                    <span>{{ $trainer->name }}</span>
                                    <p>{{ $trainer->gym ? $trainer->gym->name : '' }}</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
            </form>
        </div>
        @else
        <div class="empty">
            @if(session('success'))
            <div class="col-md-offset-4 col-md-4">
                <div class="alert alert-success" style="margin-top: 30px; text-align: center">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script>
var min_amount_free_shipping = '{{ $min_amount_free_shipping }}';
{{--var total = '{{ $total }}';--}}
var bsk_empty = '{{ trans('global.basket is empty') }}';
var shipping = '{{ $shipping }}';
</script>
@if(count($errors) > 0)
    <script>
        $('html, body').animate({
            scrollTop: $("#show_error").offset().top
        }, 1000);
    </script>
@endif
<script src="/js/basket.js"></script>

<script src="/js/maskedinput.js" type="text/javascript"></script>

    <script>
        $("#Yphone").mask("(999) 999-999");
    </script>
@endsection