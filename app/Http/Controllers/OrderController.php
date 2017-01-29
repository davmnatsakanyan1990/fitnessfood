<?php

namespace App\Http\Controllers;


use App\Events\NewOrderEvent;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;

class OrderController extends Controller
{
    public function validator($data){
        return Validator::make($data, [
            'name' => 'required',
            'phone' => 'required|numeric',
            'products' => 'required'
        ]);
    }

    public function create(Request $request){

        $data = [];
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['trainer'] = $request->trainer == '' ? null : $request->trainer;
        if($request->shipping === true){
            $data['shipping'] = 1;
        }
        else{
            $data['shipping'] = 0;
        }
        $data['products'] = json_decode($request->products);

       $validator = $this->validator($data);
        if($validator->fails()){
            return  response($validator->errors()->all(), 422);
        }


        $order = DB::table('orders')->insertGetId([
            'customer_name' => $data['name'],
            'customer_phone' => $data['phone'],
            'trainer_id' => $data['trainer'],
            'is_shipping' => $data['shipping'],
            'created_at' => date("Y-m-d H:i:s")
        ]);

        foreach($data['products'] as $product){
            OrderProduct::create(['order_id' => $order, 'product_id' => $product->product_id, 'count'=>$product->count]);
        }

        $obj = Order::find($order);
        Event::fire(new NewOrderEvent($obj));

    }
}
