@extends('admin.layouts.index')
@section('styles')
    <!-- FooTable -->
    <link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
@endsection
@section('content')
    <div class="  wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <h4>Payments</h4>
                        <div class="hr-line-dashed"></div>
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($payments)>0)
                                @foreach($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->created_at }}</td>
                                        <td>{{ $payment->trainer->first_name.' '.$payment->trainer->last_name }} </td>
                                        <td>{{ $payment->amount }} AMD</td>
                                        <td>{!! is_null($payment->payment_date) ? '<div class="label label-warning">Pending</div>' : '<div class="label label-primary">Paid</div>' !!}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button data-amount="{{ $payment->amount }}"
                                                        data-id="{{ $payment->id }}"
                                                        data-status="{{ is_null($payment->payment_date) ? 0 : 1 }}"
                                                        data-toggle="modal"
                                                        data-target="#editPaymentModal"
                                                        class="btn-white btn btn-xs edit_payment">Edit
                                                </button>
                                                <button data-id="{{ $payment->id }}"
                                                        class=" delete btn-white btn btn-xs delete_payment">Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">There aren't any payments</td>
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
            </div>
        </div>
    </div>

    <!-- Edit Payment Modal -->
    <div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Payment</h4>
                </div>
                <div class="modal-body">
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
                                    <input type="radio" name="status" class="paid" value="1">Paid
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

    <!-- FooTable -->
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <script src="/admin/js/payments.js"></script>

    <!-- Custom scripts -->
    <script>
        $(document).ready(function () {
            $('.footable').footable();
            $('.footable2').footable();
        });
    </script>
@endsection