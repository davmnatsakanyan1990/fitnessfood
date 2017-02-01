@extends('layouts.app')
@section('styles')
    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>

@endsection
@section('content')
    <main class="basket-main">
        <div class="container">
            <h3 class="basket-title">@lang('global.basket')</h3>
            @if(count($products) > 0)
                <div class="not_empty">
                    <div class="row for-table basket-table"><!--Row For table -->
                        <table class="table">
                            <thead>
                            <tr>
                                <th>@lang('product.name')</th>
                                <th class="text-center">@lang('product.price')</th>
                                <th class="text-center">@lang('product.count')</th>
                                <th class="text-right">@lang('product.total')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="name-td">
                                        <img src="/images/products/{{ $product['thumb_image'] ? $product['thumb_image']['name'] : 'noimage.gif' }}"
                                             alt="prod">
                                        <span>{{ $product['title'] }}</span>
                                    </td>
                                    <td class="text-center">{{ $product['price'] }}@lang('product.amd')</td>
                                    <td class="text-center">
                                        <div class="prod-inf">
                                            <div class="quantity-wrap clearfix">
                                                <div>
                                                    <form class="quantity-form" method="POST" action="#"
                                                          data-id="{{ $product['id'] }}"
                                                          data-price="{{ $product['price'] }}">
                                                        <div>
                                                            <input type="text" name="quantity"
                                                                   value="{{ $product['count'] }}" class="qty">
                                                        </div>
                                                        <div>
                                                            <input type="button" value="+" class="qtyplus"
                                                                   field="quantity">
                                                            <input type="button" value="−" class="qtyminus"
                                                                   field="quantity">
                                                        </div>
                                                    </form>
                                                    <input type="hidden" value="{{ $total }}" name="total">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-right td-prc">
                                        <span class="amount">{{ $product['price'] * $product['count'] }}</span>@lang('product.amd')
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
                                    <span class="freeshipping" {{ $total > $min_amount_free_shipping ? '' : 'hidden' }}>@lang('global.free_shipping')</span>
                                    <span class="shipping" {{ $total < $min_amount_free_shipping ? '' : 'hidden' }}>@lang('global.shipping'): {{ $shipping }}</span>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="row"><!-- basket-form row-->
                        <div class="basket-form">
                            <ul class="list-inline">
                                <li>@lang('product.total')</li>
                                <li>
                                    <span id="total">{{ $total }}</span>@lang('product.amd')
                                    <span {{ $total > $min_amount_free_shipping ? 'hidden' : '' }} class="shipping_amount">+ {{ $shipping }}@lang('product.amd')</span>
                                </li>
                            </ul>
                            <hr>
                            <div class="basket-form-div">
                                <form action="{{ url('orders/new') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="basket-first-inps">
                                        <input name="name" type="name" placeholder="@lang('auth.name')">
                                        <input name="phone" type="number" placeholder="@lang('auth.tel').">
                                    </div>

                                    <div class="check-box">
                                        <input type="checkbox" name="is_addvised">
                                        <label for="#"></label>
                                        <span for="#">@lang('global.advised by trainer')</span>
                                    </div>

                                    <div class="marzich-search" style="display: none; margin-top: 20px">
                                        <select name="trainer" class="trainer form-control"
                                                style="width: 100% !important; ">
                                            @foreach($trainers as $trainer)
                                                <option data-image="{{ $trainer->image ? $trainer->image->name : ''}}"
                                                        value="{{ $trainer->id }}">{{ $trainer->first_name }} {{ $trainer->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit"
                                            {{ count($products) == 0 ? 'disabled' : '' }} class="submit universal-buton">@lang('global.order')</button>
                                </form>
                            </div><!-- basket-form-div end -->
                        </div><!-- basket-form -->
                    </div><!-- Row -->
                </div>
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
        </div><!-- Container -->
    </main>
@endsection

@section('scripts')
    <script src="{{ url('select2-4.0.3/dist/js/select2.min.js') }}"></script>
    <script src="{{ url('select2-4.0.3/dist/js/i18n/en.js') }}"></script>

    <script type="text/javascript">

        var token = '{{ csrf_token() }}';
        var locale = '{{ App::getLocale() }}';
        var min_amount_free_shipping = '{{ $min_amount_free_shipping }}';

        $("select.trainer").select2({
            language: "ru",
            templateResult: formatTrainer
        });

        function formatTrainer(trainer) {

            if (!trainer.id) {
                return trainer.first_name;
            }
            var image = trainer.element.attributes[0].value;
            var $trainer = $(
                    '<span><img width="20" height="20" src="/images/trainerImages/' + image + '" /> ' + trainer.text + '</span>'
            );
            return $trainer;
        }
        ;
    </script>
    <script src="/js/basket.js"></script>
@endsection