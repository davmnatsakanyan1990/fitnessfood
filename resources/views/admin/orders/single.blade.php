@extends('admin.layouts.index')
@section('styles')
    <link rel="stylesheet" href="/admin/css/orders.css">
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-6">
                                <dl class="dl-horizontal">
                                    <dt>Ordered by:</dt>
                                    <dd>{{ $order->customer_name }}</dd>
                                    <dt>Phone:</dt>
                                    <dd>{{ $order->customer_phone }}</dd>
                                    <dt>Counselor:</dt>
                                    <dd>{{ $order->counselor ? $order->counselor->first_name : 'NO'}} </dd>
                                    <dt>Order ID:</dt>
                                    <dd>{{ $order->id }}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group order_status">
                                    <label>Update Status</label>
                                    <select class="form-control" name="status">
                                        <option {{ $order->status == 0 ? 'selected' : '' }} value="0">Pending</option>
                                        <option {{ $order->status == 1 ? 'selected' : '' }} value="1">Confirmed</option>
                                        <option {{ $order->status == 2 ? 'selected' : '' }} value="2">Canceled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Count</th>
                                <th>Product Price</th>
                                <th>Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $k=>$product)
                                <tr>
                                    <td>{{ $k+1 }}</td>
                                    <td><img width="70" class="img-thumbnail"
                                             src="/images/products/{{ $product->thumb_image ? $product->thumb_image->name : 'noimage.gif'}}">
                                    </td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->pivot->count }}</td>
                                    <td> {{ $product->price }} AMD</td>
                                    <td> {{ $product->price * $product->pivot->count }} AMD</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="text-right total_sum" colspan="6">
                                    <strong>Total: </strong>{{ $min_amount_free_shipping > $order->total ? $order->total.' + '.$shipping.' = '.($order->total+$shipping) : $order->total }}
                                    AMD
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

    <script>
        var order_id = '{{ $order->id }}';
        var order_is_seen = '{{ $order->is_seen }}';
    </script>
    <script src="/admin/js/order.js"></script>

@endsection