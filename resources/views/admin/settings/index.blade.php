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
</script>
@endsection