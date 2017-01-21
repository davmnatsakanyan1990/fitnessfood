<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }
    
    public function index(){

        $orders = Order::with('products', 'counselor')->get();
        foreach($orders as $order){
            $order->amount = $order->products->sum('price');
        }

        return view('admin.orders.index', compact('orders'));
    }

    public function show($order_id){
        $order = Order::with(['products'=>function($products){
            return $products->with('thumb_image');
        }])->find($order_id);

        $total = 0;
        foreach($order->products as $product){
            $total = $total + $product->price * $product->pivot->count;
        }
        $order->total = $total;

        if($order)
            return view('admin.orders.single', compact('order'));
        else
            abort(404);
    }

    public function statusUpdate(Request $request, $order_id){
        Order::where('id', $order_id)->update(['status' => $request->status]);
    }

    public function orderSeen($order_id){
        Order::where('id', $order_id)->update(['is_seen'=>1]);
    }
}
