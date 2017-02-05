<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;

class BasketController extends Controller
{
    public $locale;

    /**
     * BasketController constructor.
     * @param Request $request
     */
    public function __construct(Request $request){
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }
    }

    /**
     * Show basket page
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $locale = $this->locale;
        
        // get basket items
        if(isset($_COOKIE['basket'])) {
            $pds = json_decode($_COOKIE['basket']);
        }
        else{
            $pds = [];
        }

        $products = array();
        $total = 0;
        if(count($pds) > 0) {
            foreach ($pds as $item) {
                $product = Product::with('thumb_image')->find($item->product_id)->toArray();
                $product['count'] = $item->count;
                $total += $item->count * $product['price'];
                $product['title'] = json_decode($product['title'])->$locale;
                
                array_push($products, $product);
            }
        }

        $trainers = Trainer::with('image')->where('is_approved', 1)->get();
        $shipping = Setting::first()->shipping_price;

        $min_amount_free_shipping = Setting::first()->min_amount_free_shipping;

        return view('basket', compact('trainers', 'shipping', 'min_amount_free_shipping', 'products', 'total'));
    }

    // Ajax call
    public function products(Request $request){
        $products = [];
        foreach($request->basket as $product){
            $object = Product::find($product['product_id']);
            $object->count = $product['count'];
            array_push($products, $object);
        }

        return $products;
    }
}
