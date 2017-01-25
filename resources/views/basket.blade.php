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
                    <tr>
                      <td class="name-td">
                      	<img src="/images/basket-prod.png" alt="prod">
                      	<span>Կաթնաշոռային Չիզ Քեյք</span>
                      </td>
                      <td class="text-center">700դր</td>
                      <td class="text-center">
                      	<div class="prod-inf">
                      	<div class="quantity-wrap clearfix">
                      	<div>
                            <form class="quantity-form" method="POST" action="#">
                                <div>
                                    <input type="text" name="quantity" value="1" class="qty">
                                </div>
                                <div>
                                    <input type="button" value="+" class="qtyplus" field="quantity">
                                    <input type="button" value="−" class="qtyminus" field="quantity">
                                </div>
                            </form>
                        </div>
                        </div>
                        </div>
                      </td>
                      <td class="text-right">2800դր</td>
                      <td class="text-right"><a href="#">&#10005;</a></td>
                    </tr>
                    
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