@foreach($product->images as $k => $image)
    <div class="item {{ $k == 0 ? 'active' : '' }}" style="background: url(/images/products/{{ $image->name }}); background-repeat: no-repeat; min-height: 500px; background-size: cover; background-position: center center;">

    </div>
@endforeach