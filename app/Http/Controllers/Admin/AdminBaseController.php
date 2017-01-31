<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use App\Models\Order;
use App\Models\Trainer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;
use Illuminate\Support\Facades\App;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        $notifications = [];
        $new_orders = Order::where('is_seen', 0)->get()->toArray();
        foreach($new_orders as $new_order){
            $new_order['type'] = 'order';
            array_push($notifications, $new_order);
        }

        $new_trainers = Trainer::where('is_seen', 0)->get()->toArray();
        foreach($new_trainers as $new_trainer){
            $new_trainer['type'] = 'trainer';
            array_push($notifications, $new_trainer);
        }
        $notifications = collect($notifications)->sortByDesc('created_at');
        view()->share('notifications', $notifications);


        $new_messages = Message::with(['sender' => function($sender){
                return $sender->with('image');
            }])->where('is_seen', 0)->get();

        view()->share('new_messages', $new_messages);
    }
}
