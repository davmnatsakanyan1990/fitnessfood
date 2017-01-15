<?php

namespace App\Http\Controllers;


use App\Events\NewOrderEvent;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class OrderController extends Controller
{
    public function create(Request $request){
        $customer_name = 'Jon';
        $customer_email = 'Jon@gmail.com';
        $products = [2,3,4];

        $trainer_id = 1;

        $order = DB::table('orders')->insertGetId([
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'trainer_id' => $trainer_id
        ]);

        foreach($products as $product){
            OrderProduct::create(['order_id' => $order, 'product_id' => $product]);
        }

        Event::fire(new NewOrderEvent($order));

    }
}
