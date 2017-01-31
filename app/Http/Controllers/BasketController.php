<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Trainer;
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

        $trainers = Trainer::with('image')->where('is_approved', 1)->get();
        foreach ($trainers as $trainer){
            $trainer->first_name = $this->isJSON($trainer->first_name) ? json_decode($trainer->first_name, true)[$this->locale] : $trainer->first_name;
            $trainer->last_name = $this->isJSON($trainer->last_name) ? json_decode($trainer->last_name, true)[$this->locale] : $trainer->last_name;
        }

        return view('basket', compact('trainers'));
    }

    public function products(Request $request){
        $locale = $this->locale;
        $pds = $request->products;

        $products = array();
        $total = 0;
        foreach($pds as $item){

            $product = Product::with('thumb_image')->find($item['product_id'])->toArray();
            $product['count'] = $item['count'];
            $total += $item['count'] * $product['price'];
            $product['title'] = json_decode($product['title'])->$locale;
            array_push($products, $product);
        }

        return view('ajax.basket', compact('products', 'total'));

    }
    function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }

}
