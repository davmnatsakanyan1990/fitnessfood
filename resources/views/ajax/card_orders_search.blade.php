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