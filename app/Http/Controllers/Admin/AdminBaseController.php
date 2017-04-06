<?php

namespace App\Http\Controllers\Admin;

use App\Models\CardOrder;
use App\Models\Message;
use App\Models\Order;
use App\Models\Payment;
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

        $new_card_orders = CardOrder::with(['promo_code' => function($promo_code){
            return $promo_code->with(['trainer' => function($trainer){
                $trainer->with('image');
            }]);
        }])->where('is_seen', 0)->orderBy('created_at', 'desc')->get();
        view()->share('new_card_orders', $new_card_orders);

        $new_orders = Order::where('is_seen', 0)->orderBy('created_at', 'desc')->get();
        view()->share('new_orders', $new_orders);

        $new_trainers = Trainer::where('is_seen', 0)->orderBy('created_at', 'desc')->get();
        view()->share('new_trainers', $new_trainers);


        $new_payments = Payment::with(['sender' => function($sender){
                return $sender->with('image');
            }])->where('is_seen', 0)->orderBy('created_at', 'desc')->get();

        view()->share('new_payments', $new_payments);
    }

    function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
}
