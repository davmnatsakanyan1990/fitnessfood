<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }
    
    public function index(){
        $this->ordersSeen();
        $orders = Order::with('products', 'counselor')->get();
        dd($orders->toArray());
        return view('admin.orders.index', compact('orders'));
    }

    public function ordersSeen(){
        Order::where('status', 0)->update(['status'=>1]);
    }
}
