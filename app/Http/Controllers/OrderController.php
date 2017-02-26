<?php

namespace App\Http\Controllers;


use App\Events\NewOrderEvent;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\PromoCode;
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
            'phone' => 'required|regex:/^\([0-9]{3}\)\ [0-9]{3}-[0-9]{3}$/',
            'promo_code' => 'exists:promo_codes,code|size:4',
            'trainer' => 'required'
        ]);

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
            'customer_phone' => $request->phone,
            'trainer_id' => $trainer_id,
            'trainer_percent' => $trainer_percent,
            'promo_code' => $request->promo_code ? $request->promo_code : null,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        $amount = 0;
        foreach($products as $product){
            OrderProduct::create(['order_id' => $order, 'product_id' => $product->product_id, 'count'=>$product->count]);
            $prd = Product::find($product->product_id);
            $amount += $prd->price * $product->count;
        }

        $obj = Order::with('counselor')->find($order)->toArray();
        $obj['amount'] = $amount;
        
        Event::fire(new NewOrderEvent($obj));

       return redirect()->back()->with('success', 'global.success_order')->cookie('basket', '', -1);

    }
}
