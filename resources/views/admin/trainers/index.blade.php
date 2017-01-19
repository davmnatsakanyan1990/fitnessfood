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
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ $trainer->image ? '/images/trainerImages/'.$trainer->image->name : '/images/profile-icon.png' }}">
                            <div class="m-t-xs font-bold">Graphics designer</div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <h3><strong>John Smith</strong></h3>
                        <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>
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