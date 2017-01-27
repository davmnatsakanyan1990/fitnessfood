<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;

class BasketController extends Controller
{
    public $locale;

    public function __construct(Request $request){
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }
    }

    public function index(){
        return view('basket');
    }

    public function products(Request $request){
        $locale = $this->locale;
        $pds = $request->products;

        $products = array();
        foreach($pds as $item){
            $product = Product::with('thumb_image')->find($item['product_id'])->toArray();
            $product['count'] = $item['count'];
            $product['title'] = json_decode($product['title'])->$locale;
            array_push($products, $product);
        }

        return view('ajax.basket', compact('products'));

    }
}
