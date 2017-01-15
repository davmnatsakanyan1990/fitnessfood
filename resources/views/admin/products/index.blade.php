@extends('admin.layouts.index')
@section('styles')
    <link rel="stylesheet" href="/admin/css/products.css">
@endsection
@section('content')
    <div class="container">
        <h3>All Products</h3>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td class="img_td"><img class="img-thumbnail img_tmb" src="{{  $product->thumb_image ? '/images/productImages/'.$product->thumb_image->name : '/images/productImages/noimage.gif'  }}"></td>
                    <td class="title_td">{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection