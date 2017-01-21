<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrainerController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(){
        $trainers = Trainer::with([
            'orders' => function($orders){
                    return $orders->with('products');
                },
            'image',
            'messages' =>function($messages){
                    return $messages->where('is_seen', 0);
                }
        ])->get();

        foreach($trainers as $trainer){
            $total = 0;
            foreach($trainer->orders as $order){
                $total = $total + $order->products->sum('price');
            }
            $trainer->total = $total;
            $trainer->total_bonus = $total/10;
            $trainer->new_messages = $trainer->messages->count();
        }

        return view('admin.trainers.index', compact('trainers'));
    }

    public function show($trainer_id){
        $trainer = Trainer::with([
                'image', 'payments' => function($payments){
                        return $payments->orderBy('created_at', 'desc');
                    },
                'orders' => function($orders){
                        return $orders->with('products');
                    },
                'messages',
            ])->find($trainer_id);

        $total  = 0;
        foreach($trainer->orders as $order){
            $total = $total + $order->products->sum('price');
        }
        $trainer->total = $total;
        $trainer->bonus = $total/10;
        $trainer->paid = $trainer->payments->sum('amount');

        return view('admin.trainers.profile', compact('trainer'));
    }

    public function messagesSeen($trainer_id){
        $count = Message::where('trainer_id', $trainer_id)->where('is_seen', 0)->count();
        Message::where('trainer_id', $trainer_id)->update(['is_seen' => 1]);

        return response()->json(['count' => $count]);
    }
}
