@extends('admin.layouts.index')
@section('styles')
    <!-- FooTable -->
    <link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">

    <link href="/template/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">


        {{--<div class="ibox-content m-b-sm border-bottom">--}}
            {{--<div class="row">--}}
                {{--<div class="col-sm-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label" for="order_id">Order ID</label>--}}
                        {{--<input type="text" id="order_id" name="order_id" value="" placeholder="Order ID" class="form-control">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label" for="status">Order status</label>--}}
                        {{--<input type="text" id="status" name="status" value="" placeholder="Status" class="form-control">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label" for="customer">Customer</label>--}}
                        {{--<input type="text" id="customer" name="customer" value="" placeholder="Customer" class="form-control">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-sm-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label" for="date_added">Date added</label>--}}
                        {{--<div class="input-group date">--}}
                            {{--<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_added" type="text" class="form-control" value="03/04/2014">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label" for="date_modified">Date modified</label>--}}
                        {{--<div class="input-group date">--}}
                            {{--<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="date_modified" type="text" class="form-control" value="03/06/2014">--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-sm-4">--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="control-label" for="amount">Amount</label>--}}
                        {{--<input type="text" id="amount" name="amount" value="" placeholder="Amount" class="form-control">--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">

                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                            <thead>
                            <tr>

                                <th>Order ID</th>
                                <th data-hide="phone">Customer Name</th>
                                <th data-hide="phone">Customer Email</th>
                                <th>Customer Phone</th>
                                <th data-hide="phone">Amount</th>
                                <th data-hide="phone">Date added</th>
                                <th data-hide="phone,tablet" >Date modified</th>
                                <th data-hide="phone">Status</th>
                                <th class="text-right">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                <tr>
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td>
                                        {{ $order->customer_name }}
                                    </td>
                                    <td>
                                        {{ $order->customer_email }}
                                    </td>
                                    <td>
                                        {{ $order->customer_phone }}
                                    </td>
                                    <td>
                                        {{ $order-> }}
                                    </td>
                                    <td>
                                        03/04/2015
                                    </td>
                                    <td>
                                        03/05/2015
                                    </td>
                                    <td>
                                        <span class="label label-primary">Pending</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <button class="btn-white btn btn-xs">View</button>
                                            <button class="btn-white btn btn-xs">Edit</button>
                                            <button class="btn-white btn btn-xs">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="text-center">There aren't any orders</tr>
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