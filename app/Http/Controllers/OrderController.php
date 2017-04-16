<?php

namespace App\Http\Controllers;


use App\Events\NewOrderEvent;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public $locale;

    /**
     * OrderController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }
    }

    /**
     * Create new order
     * 
     * @param Request $request
     * @return $this
     */
    public function create(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|digits:8',
            'promo_code' => 'exists:promo_codes,code|size:4',
            'trainer' => 'required'
        ]);

        //When address is filled
        $address = '';
        if($request->has("address.street")){

            if($request->has('address.flat')){
                $address.=$request->address['flat'].' Flat, ';
            }
            if($request->has('address.house')){
                $address.=$request->address['house'].' House, ';
            }

            $address.= $request->address['street'];

        }

        // when trainer was choosen
        if($request->trainer){
            $trainer_id = $request->trainer;
        }
        // when promo code was inserted
        elseif($request->promo_code){
            $trainer_id = PromoCode::where('code', $request->promo_code)->first()->trainer_id;
        }
        // when no one was choosen
        else{
            $trainer_id = null;
        }

        $trainer_percent  = $trainer_id ? Trainer::find($trainer_id)->percent : null;
        $products = json_decode($_COOKIE['basket']);

        $order = DB::table('orders')->insertGetId([
            'customer_name' => $request->name,
            'customer_phone' => '+374'.$request->phone,
            'customer_address' => $address,
            'additional_info' => $request->address['additional_info'],
            'trainer_id' => $trainer_id,
            'trainer_percent' => $trainer_percent,
            'promo_code' => $request->promo_code ? $request->promo_code : null,
            'promo_percent' => $request->promo_code ? PromoCode::where('code', $request->promo_code)->first()->percent : null,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $amount = 0;
        foreach($products as $product){
            OrderProduct::create(['order_id' => $order, 'product_id' => $product->product_id, 'count'=>$product->count]);
            $prd = Product::find($product->product_id);
            $amount += $prd->price * $product->count;
        }

        $obj = Order::with('counselor', 'products')->find($order)->toArray();
        if($request->promo_code){
            $promo_code_percent = PromoCode::where('code', $request->promo_code)->first()->percent;

        }
        else{
            $promo_code_percent = 0;
        }


        $sale = $amount * $promo_code_percent/100;

        $obj['amount'] = $amount - $sale;


        $settings = Setting::first();
        $obj['shipping'] = $amount >=$settings->min_amount_free_shipping ? 0 : $settings->shipping_price;

        Event::fire(new NewOrderEvent($obj));

        //when data should be remembered
        if($request->has('remember_address')){
            return redirect()->back()->with('success', 'global.success_order')
                ->cookie('basket', '', -1)
                ->cookie('promo_code',      $request->promo_code ? $request->promo_code : '', time() + (10 * 365 * 24 * 60 * 60))
                ->cookie('customer_phone',  $request->phone, time() + (10 * 365 * 24 * 60 * 60))
                ->cookie('customer_name',   $request->name, time() + (10 * 365 * 24 * 60 * 60))
                ->cookie('customer_street', $request->address['street'], time() + (10 * 365 * 24 * 60 * 60))
                ->cookie('customer_flat',   $request->address['flat'], time() + (10 * 365 * 24 * 60 * 60))
                ->cookie('customer_house',  $request->address['house'], time() + (10 * 365 * 24 * 60 * 60));
        }
        else{
            return redirect()->back()->with('success', 'global.success_order')
                ->cookie('basket', '', -1);

        }
    }
}
