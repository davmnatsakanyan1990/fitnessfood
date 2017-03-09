@extends('admin.layouts.index')
@section('styles')
    <link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <h4 class="pull-left">All Card Orders</h4>
                        {{--<button class="btn btn-warning pull-right " type="button" data-toggle="modal" data-target="#newPromoCode">--}}
                        {{--<i style="padding-right: 7px" class="fa fa-plus"></i>&nbsp;New Promo Code--}}
                        {{--</button>--}}

                        <div style="border-top: none; border-bottom: 1px dashed #e7eaec; height: 25px"
                             class="hr-line-dashed"></div>
                        @if(session('message'))
                            <div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
                                <p>{{ session('message') }}</p>
                            </div>
                        @endif
                        <div class="row">
                            <form method="get" action="{{ url('admin/promo_card/orders') }}" class="form-inline">
                                <div class="col-md-4 col-sm-3">
                                    <label for="trainer">Search By </label>
                                    <input value="{{ request('trainer') ? request('trainer') : '' }}" type="search" id="trainer" name="trainer" placeholder="Trainer Name" class="form-control">
                                </div>
                                <div class="col-md-8 col-sm-9">
                                    <button class="btn btn-primary btn-sm" type="submit">Search</button>
                                </div>
                            </form>
                        </div>

                        <div style="border-top: none; border-bottom: 1px dashed #e7eaec; height: 25px"
                             class="hr-line-dashed"></div>
                        <table class="footable table table-stripped toggle-arrow-tiny card_orders" data-page-size="6"
                               data-filter=#filter>
                            <thead>
                            <tr>
                                <th data-sort-ignore="true">Date</th>
                                <th data-sort-ignore="true">Code</th>
                                <th data-toggle="true">Percent</th>
                                <th data-toggle="true">Trainer</th>
                                <th data-toggle="true">Count</th>
                                <th class="text-right" data-sort-ignore="true">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr class="{{ $order->is_seen ? '' : 'success' }}">
                                        <td>
                                            {{ $order->created_at  }}
                                        </td>
                                        <td>
                                            {{ $order->promo_code->code  }}
                                        </td>
                                        <td>
                                            {{$order->promo_code->percent }}%
                                        </td>
                                        <td>
                                            {{ $order->promo_code->trainer->name }}
                                        </td>
                                        <td>
                                            {{ $order->count }}
                                        </td>
                                        <td class="text-right action">
                                            <div class="btn-group">
                                                <button {{ $order->promo_code->trainer->image ? '' : 'disabled' }} class="btn-white btn btn-xs export" data-toggle="modal" data-target="#exportData" data-id="{{ $order->promo_code->id }}"><i class="fa fa-upload"></i> Export</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="10">There aren't any card orders</td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
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

   {{-- Trainer data export Modal --}}
    <div id="exportData" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Card Info</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form method="post" action="{{ url('admin/card_data/export') }}" id="form_export">
                            {{ csrf_field() }}
                        <div class="col-sm-8">
                            <dl class="dl-horizontal">

                                <dt>Trainer :</dt>
                                <dd class="trainer_name"><span></span> <i class="fa fa-pencil edit"></i></dd>
                                <input name="trainer" type="hidden">

                                <dt>Phone :</dt>
                                <dd class="trainer_phone"><span></span> <i class="fa fa-pencil edit"></i> </dd>
                                <input name="phone" type="hidden">

                                <dt>Gym :</dt>
                                <dd class="trainer_gym"><span class="gym"></span> </dd>
                                <input name="gym" type="hidden">

                                <dt>Promo Code :</dt>
                                <dd class="promo_code"></dd>
                                <input name="promo_code" type="hidden">

                                <dt>Percent :</dt>
                                <dd class="promo_percent"><span class="percent"></span>%</dd>
                                <input name="percent" type="hidden">

                            </dl>
                        </div>
                        <div class="col-sm-4">
                            <img class="trainer_img" width="150" height="150" src="">
                            <input name="image_name" type="hidden">
                        </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" form="form_export" class="btn btn-primary">Export</button>
                </div>
            </div>

        </div>
    </div>

    {{-- Edit Promo Code--}}
    {{--<div id="editPromoCode" class="modal fade" role="dialog">--}}
    {{--<div class="modal-dialog">--}}

    {{--<!-- Modal content-->--}}
    {{--<div class="modal-content">--}}
    {{--<div class="modal-header">--}}
    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
    {{--<h4 class="modal-title">Edit Promo Code</h4>--}}
    {{--</div>--}}
    {{--<div class="modal-body">--}}
    {{--<div class="errors"></div>--}}
    {{--<address>--}}
    {{--<i>Trainer: <strong class="trainer_name"></strong> </i><br>--}}
    {{--<i>Promo Code: <strong class="promo"></strong> </i>--}}
    {{--</address>--}}
    {{--<form id="editPromo" method="post" action="{{ url('admin/promo/edit') }}">--}}
    {{--{{ csrf_field() }}--}}
    {{--<input name="id" type="hidden">--}}
    {{--<div class="form-group">--}}
    {{--<input type="number" max="100" name="percent" class="form-control" placeholder="Percent" required>--}}
    {{--</div>--}}
    {{--</form>--}}
    {{--</div>--}}
    {{--<div class="modal-footer">--}}
    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
    {{--<button type="submit" form="editPromo" class="btn btn-primary" >Save</button>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</div>--}}
    {{--</div>--}}
@endsection
@section('scripts')
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>
    <script>
        var new_card_orders_array = '{{ json_encode($new_card_orders_array) }}';
    </script>
    <script src="/admin/js/card_orders.js"></script>
@endsection