<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

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

        $shipping = Setting::first()->shipping_price;

        $min_amount_free_shipping = Setting::first()->min_amount_free_shipping;
        
        if($total >= $min_amount_free_shipping)
            $final_shipping = 0;
        else
            $final_shipping = $shipping;

        $trainers = Trainer::with('image', 'gym')->where('is_approved', 1)->take(8)->get();

        return view('basket', compact('trainers', 'shipping', 'final_shipping', 'min_amount_free_shipping', 'products', 'total'));
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

    /**
     * Trainer search - Ajax call
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchTrainer(Request $request){
        $text = $request->text;
        $trainers = Trainer::where('is_approved', 1)
            ->where(function($query) use ($text){
                $query->where(DB::raw("CONCAT(`custom_first_name`, ' ', `custom_last_name`)"), 'like', '%'.$text.'%')
                ->orWhere(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'like', '%'.$text.'%');
                })
            ->get();
        return view('ajax.trainer_search', compact('trainers'));
    }

    /**
     * Promo Code search - Ajax call
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchPromoCode(Request $request){
        $code = $request->text;
        $promo = PromoCode::with(['trainer' => function($trainer){
            return $trainer->with('image');
        }])->where('code', $code)->first();
        if($promo){
            if($promo->trainer->is_approved)
                $trainers[0] = $promo->trainer;
            else
                $trainers = null;
        }
        else{
            $trainers = null;
        }

        $data['view'] = view('ajax.trainer_search', compact('trainers'))->render();
        $data['promo'] = $promo;
        
        return $data;
    }
}
