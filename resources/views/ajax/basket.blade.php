<table>
    @foreach($products as $product)
        <tr>
            <td>{{ $product['title'] }}</td>
            <td>{{ $product['price'] }}</td>
            <td>{{ $product['count'] }}</td>
            <td><button data-id="{{ $product['id'] }}" class="remove">Remove</button></td>
        </tr>
    @endforeach
</table>