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
    	</div>
    </main>
@endsection

@section('scripts')
    <script>
        var token = '{{ csrf_token() }}';
        var locale = '{{ App::getLocale() }}'
    </script>
    <script src="/js/basket.js"></script>
@endsection