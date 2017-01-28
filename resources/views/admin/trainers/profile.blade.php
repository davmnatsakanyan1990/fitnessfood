@extends('admin.layouts.index')

@section('styles')
        <!-- FooTable -->
<link href="/template/css/plugins/footable/footable.core.css" rel="stylesheet">

<!-- Sweet Alert -->
<link href="/template/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
@endsection
@section('content')
    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile Detail</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right">
                            <img alt="image" class="img-responsive text-center" src="/images/trainerImages/{{ $trainer->image ? $trainer->image->name : 'no-image.jpg' }}">
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong>{{ $trainer->first_name }} {{ $trainer->last_name }}</strong></h4>
                            <p><i class="fa fa-map-marker"></i>{{ $trainer->address }}</p>

                            <p><i class="fa fa-envelope"></i> {{ $trainer->email }}</p>
                            <p><i class="fa fa-phone"></i> {{ $trainer->phone }}</p>
                            <p><i class="fa fa-building"> </i> {{ $trainer->workplace }}</p>

                            <div class="row m-t-lg">
                                <div class="col-md-3">
                                    <span>Total</span>
                                    <h5> {{ $trainer->total }}<strong> AMD</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Bonus</span>
                                    <h5> {{ $trainer->bonus }} <strong> AMD</strong></h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Paid</span>
                                    <h5>{{ $trainer->paid }} <strong> AMD</strong> </h5>
                                </div>
                                <div class="col-md-3">
                                    <span>Active</span>
                                    <h5>{{ $trainer->bonus - $trainer->paid }} <strong> AMD</strong> </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="ibox float-e-margins">
                    <div style="min-height: 61px" class="ibox-title">
                        <h5>Activites</h5>
                        <button data-trainer_id="{{ $trainer->id }}" class="pull-right btn btn-sm btn-warning new_payment">New Payment</button>
                    </div>
                    <div class="ibox-content">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active tab" id="tab1"><a data-toggle="tab" href="#tab-1">Messages</a></li>
                                <li class="tab" id="tab2"><a data-toggle="tab" href="#tab-2">Payments</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <div>
                                            <div class="feed-activity-list">
                                                @if(count($trainer->messages) > 0)
                                                    @foreach($trainer->messages as $message)
                                                    <div class="feed-element">
                                                        <div class="media-body ">
                                                            <small class="pull-right text-navy">{{ $message->created_at }}</small>
                                                            <strong>Trainer</strong> wants to get <strong>{{ $message->amount }} AMD</strong> from Active Account. <br>
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

                                            <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                                        </div>
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="8">
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
                                                            <button data-amount="{{ $payment->amount }}" data-id="{{ $payment->id }}" class="btn-white btn btn-xs edit_payment">Edit</button>
                                                            <button data-id="{{ $payment->id }}" class=" delete btn-white btn btn-xs delete_payment">Delete</button>
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


    <!-- Page-Level Scripts -->
    <script src="/admin/js/trainer_profile.js"></script>

    <script>

        var trainer_id = '{{ $trainer->id }}';

        $('#tab1').on('click', function(){
            messagesSeen();
        });

        if($('#tab1').hasClass('active')){
            messagesSeen();
        }

        function messagesSeen(){
            $.ajax({
                url: BASE_URL+'/admin/trainer/messages/seen/'+trainer_id,
                type: 'get',
                success: function(data){
                    var new_messages_count = ($('.new_messages_count')[0]).innerHTML;
                    if(data.count != 0) {
                        if (new_messages_count - 1 == 0)
                            $('.new_messages_count').remove();
                        else
                            $('.new_messages_count').html(new_messages_count - 1);
                    }

                }
            });
        }

    </script>
@endsection