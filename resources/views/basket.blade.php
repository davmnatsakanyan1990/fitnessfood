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
                      <td class="text-right">2900դր</td>
                      <td class="text-right"><a href="#">&#10005;</a></td>
                    </tr>
                    <tr>
                      <td class="name-td">
                        <img src="/images/basket-prod.png" alt="prod">
                        <span>Կաթնաշոռային Չիզ Քեյք</span>
                      </td>
                      <td class="text-center">900դր</td>
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
            <div class="row"><!-- basket-form row-->  
              <div class="col-md-4 col-md-offset-8 col-sm-6 col-sm-offset-6 basket-form">
                <ul class="list-inline">
                  <li>Ընդհանուր</li>
                  <li>5600դր</li>
              </ul>
              <hr>
              <div class="basket-form-div">
                <form action="#">
                  <input type="name" placeholder="Անուն">
                  <input type="number" placeholder="Հեռ.">

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
                  <input type="button" value="Ալեքսանդր Հարությունյան">
                  <span>&#10006;</span>
                    <div class="check-box">
                      <input type="checkbox" name="xorhurd">
                      <label for="#"></label>
                      <span>Առաքում</span>
                      <span>(600դր)</span>
                    </div>
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
    </script>
    <script src="/js/basket.js"></script>
@endsection