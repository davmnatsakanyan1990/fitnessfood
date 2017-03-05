<?php

namespace App\Http\Controllers\Trainer;

use App\Events\NewCardOrderEvent;
use App\Models\CardOrder;
use App\Models\Order;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

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
        $trainer = Trainer::with('image', 'promoCode')->find($this->trainer->id);

        $orders = Order::with('products')->where('trainer_id', $this->trainer->id)->where('status', 1)->orderBy('created_at', 'desc')->simplePaginate(10);

        $total_bonus = 0;

        foreach($orders->items() as $order){
            foreach($order->products as $product){
                $order->amount += $product->price * $product->pivot->count;
                $order->products_count += $product->pivot->count;
            }

            if($order->promo_code)
                $order->sale = $order->promo_percent;
            else
                $order->sale = 0;

            $total_bonus += $order->amount * ($order->trainer_percent - $order->sale)/100;
        }

        $paid = $this->getPaidAmount();

        $pending = $this->getPendingAmount();

        $active_bonus = $total_bonus - $paid -$pending;

        $payments = $this->trainer->payments;

        // Minimum amount
        $min_payment_amount = Setting::first()->min_payment_amount;

        // All promo codes for current trainer
        $promo_codes = PromoCode::where('trainer_id', $this->trainer->id)->get();

        return view('trainer.profile', compact(
            'min_payment_amount',
            'trainer',
            'orders',
            'total_bonus',
            'active_bonus',
            'pending',
            'paid',
            'payments',
            'promo_codes'));
    }

    /**
     * Get paid amount
     *
     * @return mixed
     */
    public function getPaidAmount(){
        $amount = 0;
        foreach($this->trainer->payments->toArray() as $payment){
            if(!is_null($payment['payment_date'])){
                $amount += $payment['amount'];
            }
        }
        return $amount;
    }

    /**
     * Get pending amount
     *
     * @return mixed
     */
    public function getPendingAmount(){
        $amount = collect($this->trainer->payments->toArray())->where('payment_date', null)->sum('amount');

        return $amount;
    }

    public function newCardOrder(Request $request){
        $order = CardOrder::create(['promo_code_id' => $request->card_id, 'count' => $request->count]);

        $card_order = CardOrder::with(['promo_code' => function($promo_code){
            return $promo_code->with(['trainer' => function($trainer){
                return $trainer->with('image');
            }]);
        }])->find($order->id)->toArray();

        Event::fire(new NewCardOrderEvent($card_order));

        return redirect()->back();
    }

    function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
}

