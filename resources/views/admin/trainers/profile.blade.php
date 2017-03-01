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
                            <h4><strong>{{ $trainer->name}}</strong></h4>

                            <p><i class="fa fa-map-marker"></i> {{ $trainer->address }}</p>

                            <p><i class="fa fa-envelope"></i> {{ $trainer->email }}</p>

                            <p><i class="fa fa-phone"></i> {{ $trainer->phone }}</p>

                            <p><i class="fa fa-building"> </i> {{ $trainer->gym ? $trainer->gym->name : ''}}</p>

                            <p>Promo Code: <span class="label label-default promo_code">{{ $trainer->promoCode->code }}</span></p>

                            <div class="row m-t-lg">
                                <div class="col-md-3">
                                    <span>Total Bonus</span>
                                    <h5> {{ $trainer->total_bonus }}<strong> AMD</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Paid</span>
                                    <h5> {{ $trainer->paid }} <strong> AMD</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Pending</span>
                                    <h5>{{ $trainer->pending }} <strong> AMD</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Active</span>
                                    <h5>{{  $trainer->total_bonus - $trainer->paid - $trainer->pending }} <strong> AMD</strong></h5>
                                </div>
                            </div>
                            @if(! $trainer->is_approved)
                                <a href="{{ url('admin/trainers/approve/'.$trainer->id) }}">
                                    <button class="btn btn-primary full-width">Approve</button>
                                </a>
                            @endif
                            <button class="btn btn-default full-width delete" style="color: #e6763e;" data-id="{{ $trainer->id }}">Delete
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
                                class="pull-right btn btn-warning new_payment"><i style="padding-right: 7px" class="fa fa-plus"></i>&nbsp;New Payment
                        </button>
                    </div>
                    <div class="ibox-content">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active tab" id="tab1"><a data-toggle="tab" href="#tab-1">Payments</a></li>
                                <li class="tab" id="tab2"><a data-toggle="tab" href="#tab-2">Settings</a></li>
                            </ul>
                            <div class="tab-content">
                                {{-- Payments Tab --}}
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <table class="footable table table-stripped toggle-arrow-tiny"
                                               data-page-size="8">
                                            <thead>
                                            <tr>
                                                <th data-toggle="true">Date</th>
                                                <th>Amount</th>
                                                <th>Status</th>
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
                                                        <td>{!!  is_null($payment->payment_date) ? '<div class="label label-warning">Pending</span>' : '<div class="label label-primary">Paid</span>'  !!}</td>
                                                        <td>{{ $payment->note }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button
                                                                        data-id="{{ $payment->id }}"
                                                                        data-status="{{ is_null($payment->payment_date) ? 0 : 1 }}"
                                                                        data-amount="{{ $payment->amount }}"
                                                                        data-toggle="modal"
                                                                        data-target="#editPaymentModal"
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
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <form method="post" action="{{ url('admin/trainers/update/'.$trainer->id) }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Անուն</label>
                                                        <input type="text" class="form-control" name="name[am]"
                                                               value="{{ $trainer->name_is_configured ? json_decode($trainer->custom_name)->am : $trainer->name }}"
                                                               placeholder="Անուն">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Имя</label>
                                                        <input class="form-control" type="text" name="name[ru]"
                                                               value="{{ $trainer->name_is_configured ? json_decode($trainer->custom_name)->ru : $trainer->name }}"
                                                               placeholder="Имя">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control" name="name[en]"
                                                               value="{{ $trainer->name_is_configured ? json_decode($trainer->custom_name)->en : $trainer->name }}"
                                                               placeholder="Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
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
    <!-- Edit Payment Modal -->
    <div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" style="max-width: 400px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Payment</h4>
                </div>
                <div class="modal-body" style="padding: 8px">
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            <form method="post" action="{{ url('admin/payments/update') }}" id="edit_payment_form">
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" name="amount" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="payment_id">
                                    {{ csrf_field() }}
                                    <label>Status</label></br>
                                    <input type="radio" name="status" class="pending" value="0">Pending
                                    <input type="radio" name="status" style="margin-left: 20px" class="paid" value="1">Paid
                                    {{--<select class="form-control" name="status">--}}
                                        {{--<option value="0">Pending</option>--}}
                                        {{--<option value="1">Paid</option>--}}
                                    {{--</select>--}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="edit_payment_form" class="btn btn-primary btn-sm">Save</button>
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