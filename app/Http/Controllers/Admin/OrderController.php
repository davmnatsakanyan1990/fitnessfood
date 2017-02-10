<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Setting;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class OrderController extends AdminBaseController
{
    public $locale;

    public function __construct(){

        $this->middleware('auth:admin');
        parent::__construct();
        $this->locale = App::getLocale();
    }

    /**
     * Show all orders
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $orders = Order::with('products', 'counselor');

        // filter by trainer
        if($request->trainer && $request->trainer != ""){
            $orders = $orders->where('trainer_id', $request->trainer);
        }

        // filter by status
        if(isset($request->status) && $request->status != ""){
            $orders = $orders->where('status', $request->status);
        }

        $orders = $orders->orderBy('created_at', 'desc')->get();
        foreach($orders as $order){
            foreach($order->products as $product){
                $order->amount += $product->price * $product->pivot->count;
            }
            if($order->counselor)
                $order->counselor->name_is_json = $this->isJSON($order->counselor->first_name);
        }

        $trainers = Trainer::where('is_approved', 1)->get();

        return view('admin.orders.index', compact('orders', 'trainers'));
    }

    /**
     * Show single order
     *
     * @param $order_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($order_id){
        $locale = $this->locale;
        $order = Order::with(['products'=>function($products){
            return $products->with('thumb_image');
        },
        'counselor'])->find($order_id);

        $total = 0;
        foreach($order->products as $product){
            $total = $total + $product->price * $product->pivot->count;
            $product->title = json_decode($product->title)->$locale;
        }
        $order->total = $total;

        if($order->counselor)
            $order->counselor->name_is_json = $this->isJSON($order->counselor->first_name);

        $shipping = Setting::first()->shipping_price;
        $min_amount_free_shipping = Setting::first()->min_amount_free_shipping;


        if($order)
            return view('admin.orders.single', compact('order', 'shipping', 'min_amount_free_shipping'));
        else
            abort(404);
    }

    /**
     * Update order status
     *
     * @param Request $request
     * @param $order_id
     */
    public function statusUpdate(Request $request, $order_id){
        Order::where('id', $order_id)->update(['status' => $request->status]);
    }

    /**
     * Mark order as seen
     *
     * @param $order_id
     */
    public function orderSeen($order_id){
        Order::where('id', $order_id)->update(['is_seen'=>1]);
    }
}
