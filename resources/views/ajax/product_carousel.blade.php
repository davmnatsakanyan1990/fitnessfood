@foreach($product->images as $k => $image)
    <div class="item {{ $k == 0 ? 'active' : '' }}" style="background: url(/images/products/{{ $image->name }}); background-repeat: no-repeat; min-height: 400px; background-size: cover; background-position: center center;">

        <div class="container">
            <div class="modal-product-info">
                <h2>Nutrition Facts</h2>
                <h4>Per {{ $product->nutritional_value }}g</h4>
                <hr>
                <ul>
                    <li>Protein <span>{{ $product->proteins }} g</span></li>
                    <li>Fat <span>{{ $product->fats }} g</span></li>
                    <li>Carbo <span>{{ $product->carbs }} g</span></li>
                    <li>Calories <span>{{ $product->calories }} k</span></li>
                    <li>Weight <span>{{ $product->weight }} g</span></li>
                </ul>
                <hr>
                <p>
                    <span>Ingredients:</span>
                    {{ $product->description }}
                </p>
            </div>
        </div>
    </div>
@endforeach