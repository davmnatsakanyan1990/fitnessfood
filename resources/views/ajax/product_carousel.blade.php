@if(count($product->images) > 0)
@foreach($product->images as $k => $image)
    <div class="item {{ $k == 0 ? 'active' : '' }}" style="background: url(/images/products/{{ $image->name }}); background-repeat: no-repeat; min-height: 340px; background-size: cover; background-position: center center;">

    </div>
@endforeach
@else
    <div class="item active" style="background: url(/images/products/noimage.gif); background-repeat: no-repeat; min-height: 340px; background-size: cover; background-position: center center;">
    </div>
@endif