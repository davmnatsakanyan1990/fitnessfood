
    @foreach($products as $product)
        <tr>
            <td class="name-td">
                <img src="/images/products/{{ $product['thumb_image'] ? $product['thumb_image']['name'] : 'noimage.gif' }}" alt="prod">
                <span>{{ $product['title'] }}</span>
            </td>
            <td class="text-center">{{ $product['price'] }}@lang('product.amd')</td>
            <td class="text-center">
                <div class="prod-inf">
                    <div class="quantity-wrap clearfix">
                        <div>
                            <form class="quantity-form" method="POST" action="#">
                                <div>
                                    <input type="text" name="quantity" value="{{ $product['count'] }}" class="qty">
                                </div>
                                <div>
                                    <input type="button" value="+" class="qtyplus" field="quantity">
                                    <input type="button" value="−" class="qtyminus" field="quantity">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
            <td class="text-right td-prc">{{ $product['price'] * $product['count'] }}@lang('product.amd')</td>
            <td class="text-right close-prod"><a style="cursor: pointer; text-decoration: none;" class="remove" data-id="{{ $product['id'] }}">&#10005;</a></td>
        </tr>
    @endforeach
