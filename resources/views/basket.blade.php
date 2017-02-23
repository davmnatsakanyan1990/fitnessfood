@extends('layouts.app')
@section('styles')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
@endsection
@section('content')
<div class="responsive-height-block"><!-- Important --></div>
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
                                <img src="/images/products/{{ $product['thumb_image'] ? $product['thumb_image']['name'] : 'noimage.gif' }}" alt="prod">
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
                                <span class="freeshipping" {{ $total >=
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
                            <span {{ $total >=
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


                            {{ csrf_field() }}
                            <div class="basket-first-inps">
                                <input name="name" type="text" value="{{ old('name') }}" placeholder="@lang('auth.name')">
                                <input name="phone" id="phone" type="text" value="{{ old('phone') }}" placeholder="(999) 999-999" ></div>
                                <input type="text" placeholder="12345">
                                <ul class="list-inline prc-ul" style="margin-top: 20px;">
                                    <li>Զեղչված</li>
                                    <li>
                                        <span id="zexchvats">5400</span>
                                        <span>դր</span>
                                    </li>
                                </ul>
                                <hr>
                            </div>


                            <button type="submit" {{ count($products) == 0 ? 'disabled' : '' }} class="submit universal-buton">@lang('global.order')</button>

                            <div class="check-box">
                                <span style="display:block; margin-bottom: 20px; font-size:18px;">@lang('global.advised by trainer')</span>
                            </div>
                            <div class="m-searchPlusCheck">
                                <div class="marzich-search">
                                    <input type="text" name="search" placeholder="@lang('global.trainer\'s name')">
                                </div>
                                <!-- <div class="trainer-select-main">
                                    @foreach($trainers as $trainer)
                                    Trainer
                                    <div class="trainer-select">
                                        <input type="radio" value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="trainer" class="add-to-s">
                                        <label for="tr{{ $trainer->id }}">
                                            <div class="trainer-inner-content">
                                                <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
                                                <div>
                                                    <span>{{ $trainer->first_name }} {{ $trainer->last_name }}</span>
                                                    <p>{{ $trainer->gym ? $trainer->gym->name : '' }}</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>  -->
                                <div class="v-voq">
                                    <input type="radio" value="0" id="tr4" name="trainer">
                                    <label for="tr4" id="tr4-cover"></label>
                                    <label for="tr4">@lang('global.nobody')</label>
                                </div>
                            </div>
                    </div>
                    <!-- basket-form-div end --> </div>
                <!-- basket-form --> </div>
                    <div class="row trainer-select-main">
                        <div class="col-sm-3">
                            <div class="trainer-select">
                                <input type="radio" value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="trainer" class="add-to-s">
                                <label for="tr{{ $trainer->id }}">
                                    <div class="trainer-inner-content">
                                        <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
                                        <div>
                                            <span>{{ $trainer->first_name }} {{ $trainer->last_name }}</span>
                                            <p>{{ $trainer->gym ? $trainer->gym->name : '' }}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="trainer-select">
                                <input type="radio" value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="trainer" class="add-to-s">
                                <label for="tr{{ $trainer->id }}">
                                    <div class="trainer-inner-content">
                                        <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
                                        <div>
                                            <span>{{ $trainer->first_name }} {{ $trainer->last_name }}</span>
                                            <p>{{ $trainer->gym ? $trainer->gym->name : '' }}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="trainer-select">
                                <input type="radio" value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="trainer" class="add-to-s">
                                <label for="tr{{ $trainer->id }}">
                                    <div class="trainer-inner-content">
                                        <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
                                        <div>
                                            <span>{{ $trainer->first_name }} {{ $trainer->last_name }}</span>
                                            <p>{{ $trainer->gym ? $trainer->gym->name : '' }}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="trainer-select">
                                <input type="radio" value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="trainer" class="add-to-s">
                                <label for="tr{{ $trainer->id }}">
                                    <div class="trainer-inner-content">
                                        <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
                                        <div>
                                            <span>{{ $trainer->first_name }} {{ $trainer->last_name }}</span>
                                            <p>{{ $trainer->gym ? $trainer->gym->name : '' }}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="trainer-select">
                                <input type="radio" value="{{ $trainer->id }}" id="tr{{ $trainer->id }}" name="trainer" class="add-to-s">
                                <label for="tr{{ $trainer->id }}">
                                    <div class="trainer-inner-content">
                                        <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="">
                                        <div>
                                            <span>{{ $trainer->first_name }} {{ $trainer->last_name }}</span>
                                            <p>{{ $trainer->gym ? $trainer->gym->name : '' }}</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
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

<script src="/js/maskedinput.js" type="text/javascript"></script>

    <script>
        $("#phone").mask("(999) 999-999");
    </script>
@endsection