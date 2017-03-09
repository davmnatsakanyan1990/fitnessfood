
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
