<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Order;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    protected $trainer;
    public $locale;
    
    public function __construct(Request $request){
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }

        $this->middleware('auth:trainer');
        
        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    public function index(){
        $locale = $this->locale;
        $trainer = Trainer::with('image')->find($this->trainer->id);
        
        $trainer->name_is_json = $this->isJSON($trainer->first_name);

        $os = Order::with('products')->where('trainer_id', $this->trainer->id)->where('status', 1)->get();
        foreach($os as $order){
            foreach($order->products as $product){
                $order->amount += $product->price * $product->pivot->count;
            }
        }

        $total = $os->sum('amount');

        $orders = Order::with('products')->where('trainer_id', $this->trainer->id)->where('status', 1)->orderBy('created_at', 'desc')->simplePaginate(10);
        foreach($orders->items() as $order){
            foreach($order->products as $product){
                $order->amount += $product->price * $product->pivot->count;
            }
        }

        $paid = $trainer->payments->sum('amount');
        $active = $total/10-$paid;

        return view('trainer.profile', compact('trainer', 'orders', 'total', 'paid', 'active'));
    }

    function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
}

