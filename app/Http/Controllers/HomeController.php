<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index(){
        $local = 'ru';
        $products = Product::with('images', 'thumb_image')->get();
        foreach($products as $product){
            $product->description = json_decode($product->description)->$local;
            $product->title = json_decode($product->title)->$local;
        }
        $products = $products->chunk(4);
//        dd($products);
        return view('home', compact('products'));
    }
}
