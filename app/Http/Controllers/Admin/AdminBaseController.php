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
        App::setLocale('en');
        $new_orders = Order::where('is_seen', 0)->get();
        view()->share('new_orders', $new_orders);

        $new_trainers = Trainer::where('is_seen', 0)->get();
        view()->share('new_trainers', $new_trainers);


        $new_messages = Message::with(['sender' => function($sender){
                return $sender->with('image');
            }])->where('is_seen', 0)->get();

        view()->share('new_messages', $new_messages);
    }

    function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
}
