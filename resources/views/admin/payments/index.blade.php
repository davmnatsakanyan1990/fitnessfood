@extends('admin.layouts.index')
@section('styles')
        <!-- FooTable -->
<link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">
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
                                <th data-hide="all"></th>
                                <th data-hide="all">Completed</th>
                                <th data-hide="all">Task</th>
                                <th data-hide="all">Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($payments)>0)
                            @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ $payment->trainer->first_name }} {{ $payment->trainer->last_name }}</td>
                                <td>{{ $payment->amount }} AMD </td>
                                <td>Inceptos Hymenaeos Ltd</td>
                                <td><span class="pie">0.52/1.561</span></td>
                                <td>20%</td>
                                <td>Jul 14, 2013</td>
                                <td><a href="#"><i class="fa fa-check text-navy"></i></a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">There aren't any payments</td>
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
@endsection
@section('scripts')
        <!-- FooTable -->
<script src="/template/js/plugins/footable/footable.all.min.js"></script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

</script>
@endsection