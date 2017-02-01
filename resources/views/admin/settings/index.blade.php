@extends('admin.layouts.index')
@section('styles')
    <link href="/template/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="middle-box text-center animated fadeInRightBig">
        <div class="row">
            <div class="col-md-10">
                @if(session('message'))
                    <div class="alert alert-success">
                        <p>{{ session('message') }}</p>
                    </div>
                @endif
                <form method="post" action="{{ url('admin/settings/update') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Default percent for trainer</label>
                        <input class="trainer_percent" type="text" value="{{ $data->trainer_percent }}" name="trainer_percent"/>
                    </div>
                    <div class="form-group">
                        <label>Shipping Price</label>
                        <input class="touchspin2" type="text" value="{{ $data->shipping_price }}" name="shipping_price">
                    </div>
                    <div class="form-group">
                        <label>Min amount for free shipping</label>
                        <input class="touchspin1" type="text" value="{{ $data->min_amount_free_shipping }}" name="min_amount_free_shipping">
                    </div>
                    <div class="form-group">
                        <label>Min payment amount</label>
                        <input class="touchspin3" type="text" value="{{ $data->min_payment_amount }}" name="min_payment_amount">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- TouchSpin -->
    <script src="/template/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script>
    $(".trainer_percent").TouchSpin({
        min: 0,
        max: 100,
        step: 0.5,
        decimals: 1,
        boostat: 5,
        maxboostedstep: 10,
        postfix: '%',
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white'
    });

    $(".touchspin1").TouchSpin({
        min: 0,
        max: 10000000,
        step: 100,
        postfix: 'AMD',
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white'
    });
    $(".touchspin2").TouchSpin({
        min: 0,
        max: 10000000,
        step: 50,
        postfix: 'AMD',
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white'
    });
    $(".touchspin3").TouchSpin({
        min: 0,
        max: 10000000,
        step: 50,
        postfix: 'AMD',
        buttondown_class: 'btn btn-white',
        buttonup_class: 'btn btn-white'
    });
</script>
@endsection