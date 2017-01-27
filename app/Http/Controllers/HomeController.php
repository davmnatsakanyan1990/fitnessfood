<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{

    public $locale;

    public function __construct(Request $request){
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }
    }

    public function index(){
        if($this->locale)
            $locale = $this->locale;
        else
            $locale = 'am';

        $products = Product::with('images', 'thumb_image')->get();
        if(count($products)>0) {
            foreach ($products as $product) {
                $product->description = json_decode($product->description)->$locale;
                $product->title = json_decode($product->title)->$locale;
            }
        }
        $products = $products->chunk(4);

        return view('home', compact('products'));
    }
}
