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
            $product = Product::find($item['product_id'])->toArray();
            $product['count'] = $item['count'];
            array_push($products, $product);
        }

        return view('ajax.basket', compact('products'));

    }
}
