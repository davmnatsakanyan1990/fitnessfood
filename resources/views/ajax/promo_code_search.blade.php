
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
                    <button {{ $code->trainer->image ? '' : 'disabled' }} class="btn-white btn btn-xs export" data-toggle="modal" data-target="#exportData" data-id="{{ $code->id }}"><i class="fa fa-upload"></i> Export</button>
                </div>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td class="text-center" colspan="10">There aren't any promo codes</td>
    </tr>
@endif
