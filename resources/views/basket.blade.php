@extends('layouts.app')

@section('content')
    <main>
    	<div class="container">
    		<h3 class="basket-title">Զամբյուղ</h3>
    		<div class="row for-table basket-table"><!--Row For table -->    
                <table class="table">
                  <thead>
                    <tr>
                      <th>Անվանում</th>
                      <th class="text-center">Գինը</th>
                      <th class="text-center">Քանակը</th>
                      <th class="text-right">Ընդհանուր</th>
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
    </script>
    <script src="/js/basket.js"></script>
@endsection