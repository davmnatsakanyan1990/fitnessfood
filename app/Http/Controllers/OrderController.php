<?php

namespace App\Http\Controllers;


use App\Events\NewOrderEvent;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

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
            'phone' => 'required'
        ]);
        
        $name = $request->name;
        $phone = $request->phone;
        $trainer = $request->is_addvised ? $request->trainer : null;
        $trainer_percent  = $request->is_addvised ? Trainer::find($request->trainer)->percent : null;
        $products = json_decode($_COOKIE['basket']);

        $order = DB::table('orders')->insertGetId([
            'customer_name' => $name,
            'customer_phone' => $phone,
            'trainer_id' => $trainer,
            'trainer_percent' => $trainer_percent,
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
