@extends('admin.layouts.index')

@section('styles')
<!-- FooTable -->
<link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">

<!-- Sweet Alert -->
<link href="/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

<link href="/template/css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

@endsection
@section('content')
    <div class="wrapper wrapper-content">
        @if(session('message'))
            <div class="alert alert-success"><p>{{ session('message') }}</p></div>
        @endif
        <div class="row animated fadeInRight">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile Detail</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right">
                            <img alt="image" class="img-responsive text-center"
                                 src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'no-image.jpg' }}">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong>{{ $trainer->first_name}} {{  $trainer->last_name }}</strong></h4>

                            <p><i class="fa fa-map-marker"></i>{{ $trainer->address }}</p>

                            <p><i class="fa fa-envelope"></i> {{ $trainer->email }}</p>

                            <p><i class="fa fa-phone"></i> {{ $trainer->phone }}</p>

                            <p><i class="fa fa-building"> </i> {{ $trainer->gym ? $trainer->gym->name : ''}}</p>

                            <div class="row m-t-lg">
                                <div class="col-md-3">
                                    <span>Total</span>
                                    <h5> {{ $trainer->total }}<strong> AMD</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Bonus</span>
                                    <h5> {{ $trainer->total_bonus }} <strong> AMD</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Paid</span>
                                    <h5>{{ $trainer->paid }} <strong> AMD</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Active</span>
                                    <h5>{{  $trainer->total_bonus - $trainer->paid }} <strong> AMD</strong></h5>
                                </div>
                            </div>
                            @if(! $trainer->is_approved)
                                <a href="{{ url('admin/trainers/approve/'.$trainer->id) }}">
                                    <button class="btn btn-primary full-width">Approve</button>
                                </a>
                            @endif
                            <button class="btn btn-default full-width delete" data-id="{{ $trainer->id }}">Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="ibox">
                    <div style="min-height: 61px" class="ibox-title">
                        <h5>Activites</h5>
                        <button data-trainer_id="{{ $trainer->id }}"
                                class="pull-right btn btn-sm btn-warning new_payment">New Payment
                        </button>
                    </div>
                    <div class="ibox-content">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active tab" id="tab1"><a data-toggle="tab" href="#tab-1">Messages</a></li>
                                <li class="tab" id="tab2"><a data-toggle="tab" href="#tab-2">Payments</a></li>
                                <li class="tab" id="tab3"><a data-toggle="tab" href="#tab-3">Settings</a></li>
                            </ul>
                            <div class="tab-content">
                                {{-- Messages Tab --}}
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <div>
                                            <div class="feed-activity-list">
                                                @if(count($trainer->messages) > 0)
                                                    @foreach($trainer->messages as $message)
                                                        <div class="feed-element">
                                                            <div class="media-body ">
                                                                <small class="pull-right text-navy">{{ $message->created_at }}</small>
                                                                <strong>Trainer</strong> wants to get
                                                                <strong>{{ $message->amount }} AMD</strong> from Active
                                                                Account. <br>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="feed-element">
                                                        <div class="media-body ">
                                                            <p class="text-center">There aren't any messages</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            @if($messages_count > 10)
                                                <button class="messages_more btn btn-primary btn-block m"><i
                                                            class="fa fa-arrow-down"></i> Show More
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- Payments Tab --}}
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="footable table table-stripped toggle-arrow-tiny"
                                               data-page-size="8">
                                            <thead>
                                            <tr>
                                                <th data-toggle="true">Date</th>
                                                <th>Amount</th>
                                                <th data-sort-ignore="true">Note</th>
                                                <th data-sort-ignore="true">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($trainer->payments) > 0)
                                                @foreach($trainer->payments as $payment)
                                                    <tr>
                                                        <td>{{ $payment->created_at }}</td>
                                                        <td>{{ $payment->amount }}</td>
                                                        <td>{{ $payment->note }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button data-amount="{{ $payment->amount }}"
                                                                        data-id="{{ $payment->id }}"
                                                                        class="btn-white btn btn-xs edit_payment">Edit
                                                                </button>
                                                                <button data-id="{{ $payment->id }}"
                                                                        class=" delete btn-white btn btn-xs delete_payment">
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-center" colspan="4">There aren't any payments</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <ul class="pagination pull-right"></ul>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                {{-- Settings Tab --}}
                                <div id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <form method="post" action="{{ url('admin/trainers/update/'.$trainer->id) }}">
                                            {{ csrf_field() }}
                                            {{--<div class="form-group">--}}
                                            {{--<label>Հայերեն</label>--}}
                                            {{--<div class="row">--}}
                                            {{--<div class="col-md-6">--}}
                                            {{--<input type="text" class="form-control" name="first_name[am]" value="{{ $trainer->name_is_json ? json_decode($trainer->first_name, true)['am'] : $trainer->first_name }}" placeholder="Անուն">--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-6">--}}
                                            {{--<input type="text" class="form-control" name="last_name[am]" value="{{ $trainer->name_is_json ? json_decode($trainer->last_name, true)['am'] : $trainer->last_name }}" placeholder="Ազգանուն">--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group">--}}
                                            {{--<label>Русский</label>--}}
                                            {{--<div class="row">--}}
                                            {{--<div class="col-md-6">--}}
                                            {{--<input class="form-control" type="text" name="first_name[ru]" value="{{ $trainer->name_is_json ? json_decode($trainer->first_name, true)['ru'] : $trainer->first_name }}" placeholder="Имя">--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-6">--}}
                                            {{--<input class="form-control" type="text" name="last_name[ru]" value="{{ $trainer->name_is_json ? json_decode($trainer->last_name, true)['ru'] : $trainer->last_name }}" placeholder="Фамилия">--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="form-group">--}}
                                            {{--<label>English</label>--}}
                                            {{--<div class="row">--}}
                                            {{--<div class="col-md-6">--}}
                                            {{--<input type="text" class="form-control" name="first_name[en]" value="{{ $trainer->name_is_json ? json_decode($trainer->first_name, true)['en'] : $trainer->first_name }}" placeholder="First Name">--}}
                                            {{--</div>--}}
                                            {{--<div class="col-md-6">--}}
                                            {{--<input type="text" class="form-control" name="last_name[en]" value= "{{ $trainer->name_is_json ? json_decode($trainer->last_name, true)['en'] : $trainer->last_name }}" placeholder="Last Name">--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            <div class="form-group">
                                                <label>Bonus Percent</label>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input class="percent" type="text"
                                                               value="{{ $trainer->percent }}" name="percent"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="submit">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
            <!-- Peity -->
    <script src="/template/js/plugins/peity/jquery.peity.min.js"></script>

    <!-- Peity -->
    <script src="/template/js/demo/peity-demo.js"></script>

    <!-- FooTable -->
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- TouchSpin -->
    <script src="/template/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <script>
        var trainer_id = '{{ $trainer->id }}';
        var trainer_is_seen = '{{ $trainer->is_seen }}';
    </script>

    <!-- Custom Scripts -->
    <script src="/admin/js/trainer_profile.js"></script>

@endsection