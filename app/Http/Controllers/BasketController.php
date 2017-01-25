<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class BasketController extends Controller
{
    public function index(){
        return view('basket');
    }

    public function products(Request $request){
        $pds = $request->products;

        $products = array();
        foreach($pds as $item){
            $product = Product::with('thumb_image')->find($item['product_id'])->toArray();
            $product['count'] = $item['count'];
            array_push($products, $product);
        }
//dd($products);
        return view('ajax.basket', compact('products'));

    }
}
