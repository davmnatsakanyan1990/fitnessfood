@extends('admin.layouts.index')
@section('styles')

@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @foreach($trainers as $trainer)
            <div class="col-lg-4">
                <div class="contact-box">
                    <div class="col-sm-4">
                        <div>
                            <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ $trainer->image ? '/images/trainerImages/'.$trainer->image->name : '/images/profile-icon.png' }}">
                            <div class="m-t-xs font-bold">Trainer</div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>{{ $trainer->first_name }} {{ $trainer->last_name }}</strong></h3>
                        <p><i class="fa fa-map-marker"></i> {{ $trainer->address }}</p>
                        <address>
                            <i class="fa fa-envelope"></i> {{ $trainer->email }}<br>
                            <i class="fa fa-phone"></i> {{ $trainer->phone }}<br>
                            <i class="fa fa-building"> </i> {{ $trainer->workplace }}
                        </address>
                        <div class="hr-line-dashed"></div>
                        <p>
                            Bonus: 20.000 AMD<br>
                        </p>
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')

@endsection