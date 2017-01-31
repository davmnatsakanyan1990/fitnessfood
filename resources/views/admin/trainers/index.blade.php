@extends('admin.layouts.index')
@section('styles')

@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row trainers">
            @foreach($trainers as $trainer)
            <div class="col-lg-4">
                <div class="contact-box">
                    <div class="col-sm-4">
                        <a href="{{ url('admin/trainers/show/'.$trainer->id) }}">
                            <div class="text-center">
                                <img alt="image" style="margin-bottom: 10px" class="img-circle m-t-xs img-responsive center-block" src="{{ $trainer->image ? '/images/trainerImages/'.$trainer->image->name : '/images/profile-icon.png' }}">
                                @if($trainer->is_approved)
                                <div class="label small label-primary">Approved</div>
                                @else
                                <div class="label label-danger">Pending</div>
                                @endif
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-8">
                        <a href="{{ url('admin/trainers/show/'.$trainer->id) }}"><h3><strong>{{  $trainer->first_name }} {{  $trainer->last_name }}</strong></h3></a>
                        <p><i class="fa fa-map-marker"></i> {{ $trainer->address }}</p>
                        <address>
                            <i class="fa fa-envelope"></i> {{ $trainer->email }}<br>
                            <i class="fa fa-phone"></i> {{ $trainer->phone }}<br>
                            <i class="fa fa-building"> </i> {{ $trainer->workplace }}
                        </address>
                        <div class="hr-line-dashed"></div>
                        <p>
                            Active: {{ $trainer->active_bonus }} AMD<br>
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