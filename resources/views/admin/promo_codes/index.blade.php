@extends('admin.layouts.index')
@section('styles')
    <link rel="stylesheet" href="">
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
                        <h4 class="pull-left">All Promo Codes</h4>
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
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="6"
                               data-filter=#filter>
                            <thead>
                            <tr>
                                <th data-sort-ignore="true">Code</th>
                                <th data-toggle="true">Percent</th>
                                <th data-toggle="true">Trainer</th>
                                <th class="text-right" data-sort-ignore="true">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($promoCodes) > 0)
                                @foreach($promoCodes as $code)
                                    <tr>
                                        <td>
                                            {{ $code->code  }}
                                        </td>
                                        <td>
                                            {{$code->percent }}%
                                        </td>
                                        <td>
                                            {{ $code->trainer->name }}
                                        </td>
                                        <td class="text-right action">
                                            <div class="btn-group">
                                                {{--<button class="btn-white btn btn-xs edit" data-id="{{ $code->id }}" data-toggle="modal" data-target="#editPromoCode">Edit</button>--}}
                                                {{--<button style="color: #337ab7" data-id="{{ $code->id }}"--}}
                                                        {{--class=" delete btn-white btn btn-xs">Delete--}}
                                                {{--</button>--}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="10">There aren't any promo codes</td>
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

    {{-- New promo code--}}
    {{--<div id="newPromoCode" class="modal fade" role="dialog">--}}
        {{--<div class="modal-dialog">--}}

            {{--<!-- Modal content-->--}}
            {{--<div class="modal-content">--}}
                {{--<div class="modal-header">--}}
                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                    {{--<h4 class="modal-title">New Promo Code</h4>--}}
                {{--</div>--}}
                {{--<div class="modal-body">--}}
                    {{--<div class="errors"></div>--}}
                    {{--<form id="newPromo" method="post" action="{{ url('admin/promo/create') }}">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<div class="form-group">--}}
                            {{--<input type="number" max="100" name="percent" class="form-control" placeholder="Percent" required>--}}
                        {{--</div>--}}
                        {{--<div class="form-group">--}}
                            {{--<select name="trainer" class="form-control" required>--}}
                                {{--<option value="">Select Trainer</option>--}}
                                {{--@foreach($trainers as $traoner)--}}
                                    {{--<option value="{{ $traoner->id }}">{{ $traoner->name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                    {{--<button type="submit" form="newPromo" class="btn btn-primary" >Create</button>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}

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
    {{--{{ $products->links() }}--}}
@endsection
@section('scripts')
    <script src="/template/js/plugins/footable/footable.all.min.js"></script>

    <!-- Sweet alert -->
    <script src="/template/js/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom scripts -->
    <script src="/admin/js/editPromo.js"></script>

@endsection