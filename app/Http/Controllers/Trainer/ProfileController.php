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

    /**
     * Shoe trainer profile
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $trainer = Trainer::with('image')->find($this->trainer->id);

        // get all orders for trainer
        $orders = Order::with('products')->where('trainer_id', $this->trainer->id)->where('status', 1)->orderBy('created_at', 'desc')->simplePaginate(10);

        $total_bonus = $this->getBonus();

        $paid = $this->getPaidAmount();

        $pending = $this->getPendingAmount();

        $active_bonus = $total_bonus - $paid -$pending;

        return view('trainer.profile', compact('trainer', 'orders', 'total_bonus', 'active_bonus', 'pending', 'paid'));
    }

    public function getBonus(){
        $os = Order::with('products')->where('trainer_id', $this->trainer->id)->where('status', 1)->get();

        $total_bonus = 0;
        foreach($os as $order){
            foreach($order->products as $product){
                $order->amount += $product->price * $product->pivot->count;
                $order->products_count += $product->pivot->count;
            }
            $total_bonus += $order->amount * $order->trainer_percent/100;
        }
        
        return $total_bonus;
    }

    public function getPaidAmount(){
        $amount = collect($this->trainer->payments->toArray())->where('status', '1')->sum('amount');

        return $amount;
    }

    public function getPendingAmount(){
        $amount = collect($this->trainer->payments->toArray())->where('status', '0')->sum('amount');

        return $amount;
    }
}

