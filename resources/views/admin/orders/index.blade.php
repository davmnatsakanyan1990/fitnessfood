@extends('admin.layouts.index')
@section('styles')
    <!-- FooTable -->
    <link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="/template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <link href="/admin/css/orders.css" rel="stylesheet">

@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <h4>Orders</h4>
                        <div class="hr-line-dashed"></div>
                        <table class="footable table table-stripped toggle-arrow-tiny order-table" data-page-size="15">
                            <thead>
                            <tr>

                                <th data-hide="phone">Customer Name</th>
                                <th>Customer Phone</th>
                                <th>Counselor</th>
                                <th data-hide="phone">Amount</th>
                                <th data-hide="phone">Date added</th>
                                <th data-hide="phone">Status</th>
                                <th class="text-right">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                <tr class="{{ $order->is_seen == 0 ? 'new_order' : '' }}">
                                    <td>
                                        {{ $order->customer_name }}
                                    </td>
                                    <td>
                                        {{ $order->customer_phone }}
                                    </td>
                                    <td>
                                        {{ $order->counselor ? $order->counselor->name_is_json ? json_decode($order->counselor->first_name, true)['en'] : $order->counselor->first_name  : '' }}
                                        {{ $order->counselor ? $order->counselor->name_is_json ? json_decode($order->counselor->last_name, true)['en'] : $order->counselor->last_name  : '' }}
                                    </td>
                                    <td>
                                        {{ $order->amount }}
                                    </td>
                                    <td>
                                        {{ $order->created_at }}
                                    </td>
                                    <td>
                                        @if($order->status == 0)
                                            <span class="label label-warning">Pending</span>
                                        @elseif($order->status == 1)
                                            <span class="label label-primary">Confirmed</span>
                                        @elseif($order->status == 2)
                                            <span class="label label-danger">Canceled</span>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a href="{{ url('admin/orders/show/'.$order->id) }}"><button class="btn-white btn btn-xs">View</button></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="text-center"><td colspan="9">There aren't any orders</td></tr>
                            @endif


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="7">
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
@endsection
@section('scripts')
    <!-- Data picker -->
    <script src="/template/js/plugins/datapicker/bootstrap-datepicker.js"></script>

    <!-- FooTable -->
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();

            $('#date_added').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

            $('#date_modified').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });

        });

    </script>
@endsection