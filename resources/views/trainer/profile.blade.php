@extends('layouts.app')
@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="profile-top">
                    <span>Log-out</span>
                    <a href="{{ url('trainer/settings/'.App::getLocale()) }}">
                        <img src="/images/profile/astxik.png" alt="profile/astxik.png">
                    </a>
                    <div>
                        <img src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'profile-icon.png' }}" alt="profile/face.png">
                        <h2>{{ $trainer->first_name }} {{ $trainer->last_name }}</h2>
                    </div>
                </div><!-- Profile top end -->
            </div><!-- Row end -->

            <div class="row for-table"><!--Row For table -->           
                <table class="table">
                  <thead>
                    <tr>
                      <th>@lang('global.buyer')</th>
                      <th class="text-center">%</th>
                      <th class="text-center">@lang('product.count')</th>
                      <th class="text-right">@lang('product.total')</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td class="name-td">{{ $order->customer_name }}</td>
                      <td class="text-center">10 %</td>
                      <td class="text-center">{{ $order->products->count() }}</td>
                      <td class="text-right">{{ $order->amount }}դր</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div><!-- Row For table end -->
            {{ $orders->links() }}

            <div class="row stanal" id="info"><!-- Stanal row -->
                <div class="col-md-4 col-md-offset-8 col-sm-6 col-sm-offset-6 stanal-info"><!-- Stanal info -->
                    <ul class="list-inline">
                        <li>Ընդհանուր</li>
                        <li>{{ $total }}դր</li>
                    </ul>
                    <ul class="list-inline">
                        <li>Տոկոսագումարը</li>
                        <li>{{ $total/10 }}դր</li>
                    </ul>
                    <ul class="list-inline">
                        <li>Վճարված է</li>
                        <li>{{ $paid }}դր</li>
                    </ul>
                    <ul class="list-inline">
                        <li>Ակտիվ</li>
                        <li>{{ $active }}դր</li>
                    </ul>
                    <hr>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif
                    <form action="{{ url('trainer/message/new').'#info' }}" method="post" class="kkapnvenq" id="message">
                        {{ csrf_field() }}
                        <input type="number" name="amount" placeholder="Գումար">
                    </form>
                    @if(session('message'))
                        <p>{{ session('message') }}</p>
                    @endif
                    <div class="text-center">
                        <button type="submit" form="message" class="universal-buton">ՍՏԱՆԱԼ</button>
                    </div>

                </div><!-- Stanal info end-->
            </div><!-- Stanal row end-->
        </div><!-- Container end -->
    </main>
@endsection