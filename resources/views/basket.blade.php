@extends('layouts.app')
@section('styles')
        <!-- select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
    <main>
    	<div class="container">
    		<h3 class="basket-title">@lang('global.basket')</h3>
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

                    
                  </tbody>
                </table>
            </div>
            <div class="row"><!-- basket-form row-->
              <div class="basket-form">
                <ul class="list-inline">
                  <li>Ընդհանուր</li>
                  <li><span id="total"></span>@lang('product.amd')</li>
              </ul>
              <hr>
              <div class="basket-form-div">
                  <div class="message"></div>
                <form action="#">
                  <div class="basket-first-inps">
                    <input name="name" type="name" placeholder="Անուն">
                    <input name="phone" type="number" placeholder="Հեռ.">
                  </div>

                  <div class="check-box">
                    <input type="checkbox" name="is_addvised">
                    <label for="#"></label>
                    <span for="#">Ինձ խորհուրդ է տվել մարզիչը</span>
                  </div>

                  <div class="marzich-search" style="display: none; margin-top: 20px">
                    <select name="trainer" class="trainer form-control" style="width: 100% !important; ">
                        @foreach($trainers as $trainer)
                        <option data-image="{{ $trainer->image ? $trainer->image->name : ''}}" value="{{ $trainer->id }}">{{ $trainer->first_name }} {{ $trainer->last_name }}</option>
                        @endforeach
                    </select>
                  </div>

                  {{--<ul>--}}
                    {{--<li>--}}
                      {{--<a href="#">--}}
                        {{--<img src="/images/basket-marzich.png" alt="b-marzich">--}}
                        {{--<span>Ալեքսանդր Հարությունյան</span>--}}
                      {{--</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                      {{--<a href="#"></a>--}}
                    {{--</li>--}}
                  {{--</ul>--}}
                  {{--<div class="remove-trainer">--}}
                    {{--<input type="button" value="Ալեքսանդր Հարությունյան">--}}
                    {{--<span>&#10006;</span>--}}
                  {{--</div>--}}
                    <div class="check-box">
                      <input type="checkbox" name="shipping">
                      <label for="#"></label>
                      <span>Առաքում</span>
                      <span>(600դր)</span>
                    </div>
                    <button  type="button" disabled class="submit universal-buton">Պատվիրել</button>
                </form>
              </div><!-- basket-form-div end -->
            </div><!-- basket-form -->
          </div><!-- Row -->
    	</div><!-- Container -->
    </main>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">

        var token = '{{ csrf_token() }}';
        var locale = '{{ App::getLocale() }}';

        $("select.trainer").select2({
            templateResult: formatTrainer
        });

        function formatTrainer (trainer) {

            if (!trainer.id) { return trainer.first_name; }
            var image = trainer.element.attributes[0].value;
            var $trainer= $(
                    '<span><img width="20" height="20" src="/images/trainerImages/' + image + '" /> ' + trainer.text + '</span>'
            );
            return $trainer;
        };
        // click on submit button
        $('.submit').on('click', function(){
            var products = localStorage.getItem('basket');
            var name = $(document).find('input[name="name"]').val();
            var phone = $(document).find('input[name="phone"]').val();
            if($(document).find('input[name="is_addvised"]').is(':checked')){
                var trainer =  $(document).find('select[name="trainer"]').val();
            }
            else{
                var trainer = null;
            }
            var is_shipping = $(document).find('input[name="shipping"]').is(':checked');

            $.ajax({
                url: BASE_URL+'/orders/new',
                type: 'post',
                data: {
                    _token: token,
                    products: products,
                    name: name,
                    phone: phone,
                    trainer: trainer,
                    shipping: is_shipping
                },
                success: function(data){
                    var html = '<div class="alert alert-success"><ul><p>Ձեր պատվերը ուղարկված է</p></ul></div>'
                    $(document).find('.message').html(html);

                    localStorage.removeItem('basket');
                    $(document).find('input[name="name"]').val('');
                    $(document).find('input[name="phone"]').val('');
                    if($(document).find('input[name="is_addvised"]').is(':checked')){
                        $(document).find('input[name="is_addvised"]').attr('checked', false)
                    }

                    if($(document).find('input[name="shipping"]').is(':checked')){
                        $(document).find('input[name="shipping"]').attr('checked', false)

                    }

                    $(document).find('.basket-table tbody').html('');
                    $('.basket_count').text(0);
                },
                error: function(errors){
                    var allErrors = errors.responseJSON;

                    var html = '<div class="alert alert-danger"><ul>';
                    $.each(allErrors, function(index, value){
                        html = html+'<p>'+value+'</p>'
                    });
                    html = html+'</ul></div>';

                    $(document).find('.message').html(html);

                }
            })

        })
    </script>
    <script src="/js/basket.js"></script>
@endsection