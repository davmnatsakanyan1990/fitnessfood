@extends('layouts.app')

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
                  <li>5600դր</li>
              </ul>
              <hr>
              <div class="basket-form-div">
                <form action="#">
                  <div class="basket-first-inps">
                    <input type="name" placeholder="Անուն">
                    <input type="number" placeholder="Հեռ.">
                  </div>

                  <div class="check-box">
                    <input type="checkbox" name="xorhurd">
                    <label for="#"></label>
                    <span for="#">Ինձ խորհուրդ է տվել մարզիչը</span>
                  </div>

                  <div class="marzich-search">
                    <input type="search" placeholder="Մարզիչի Անունը">
                  </div>

                  <ul>
                    <li>
                      <a href="#">
                        <img src="/images/basket-marzich.png" alt="b-marzich">
                        <span>Ալեքսանդր Հարությունյան</span>
                      </a>
                    </li>
                    <li>
                      <a href="#"></a>
                    </li>
                  </ul>
                  <div class="remove-trainer">
                    <input type="button" value="Ալեքսանդր Հարությունյան">
                    <span>&#10006;</span>
                  </div>
                    <div class="check-box">
                      <input type="checkbox" name="xorhurd">
                      <label for="#"></label>
                      <span>Առաքում</span>
                      <span>(600դր)</span>
                    </div>
                    <button class="universal-buton">Պատվիրել</button>
                </form>
              </div><!-- basket-form-div end -->
            </div><!-- basket-form -->
          </div><!-- Row -->
    	</div><!-- Container -->
    </main>
@endsection

@section('scripts')
    <script>
        var token = '{{ csrf_token() }}';
        var locale = '{{ App::getLocale() }}'
    </script>
    <script src="/js/basket.js"></script>
@endsection