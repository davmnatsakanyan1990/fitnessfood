<?php

namespace App\Http\Controllers;


use App\Events\NewOrderEvent;
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
        $data['shipping'] = $request->shipping;
        $data['products'] = json_decode($request->products);

       $validator = $this->validator($data);
        if($validator->fails()){
            return  response($validator->errors()->all(), 422);
        }


        $order = DB::table('orders')->insertGetId([
            'customer_name' => $data['name'],
            'customer_phone' => $data['phone'],
            'trainer_id' => $data['trainer'],
            'is_shipping' => $data['shipping'] ? 1 : 0,
            'created_at' => date("Y-m-d H:i:s")
        ]);

        foreach($data['products'] as $product){
            OrderProduct::create(['order_id' => $order, 'product_id' => $product->product_id, 'count'=>$product->count]);
        }

        Event::fire(new NewOrderEvent($order));

    }
}
