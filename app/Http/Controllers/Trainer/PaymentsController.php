<?php

namespace App\Http\Controllers\Trainer;

use App\Events\NewMessageEvent;
use App\Events\NewPaymentEvent;
use App\Models\Message;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class PaymentsController extends Controller
{
    protected $trainer;

    public function __construct(Request $request){
        $this->middleware('auth:trainer');

        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }

        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    /**
     * Create new payment request
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request){
//        $this->validate($request, [
//            'amount' => 'required'
//        ]);

        $total_bonus = $this->getBonus();

        $paid = $this->getPaidAmount();

        $pending = $this->getPendingAmount();

        $active = $total_bonus - $paid - $pending;

        // Minimum amount
        $min_payment_amount = Setting::first()->min_payment_amount;

        // case: text field is empty and amount is 0
        if(empty($request->amount)){
            $request->amount = $min_payment_amount;
            if($active == 0){
                return redirect()->back()->with('error', trans('validation.amount_error'));
            }
        }

        // case: inserted amount is greater than active bonus
        if($request->amount > $active){
            return redirect()->back()->with('error', trans('validation.amount_error'));
        }

        // case: when user bonus is less than minimum payment amount
        if($active < $min_payment_amount){
            return redirect()->back()->with('error', trans('validation.min_amount', ['attribute' => $min_payment_amount]));
        }

        // case: inserted amount is less than min payment amount
        if($request->amount < $min_payment_amount){
            return redirect()->back()->with('error', trans('validation.min_amount', ['attribute' => $min_payment_amount]));
        }

        $payment = Payment::create(['trainer_id' => $this->trainer->id, 'amount' => $request->amount]);
        $sender = Trainer::with('image')->find($this->trainer->id)->toArray();

        Event::fire(new NewPaymentEvent($sender, $payment));
        return redirect()->back()->with('message', 'Ձեզ հետ կկապնվի մեր օպերատորը գումարի փոախանցման հարցով');
    }


    /**
     * Get total bonus for current trainer
     *
     * @return float|int
     */
    public function getBonus(){
        $os = Order::with('products')->where('trainer_id', $this->trainer->id)->where('status', 1)->get();

        $total_bonus = 0;
        foreach($os as $order){
            foreach($order->products as $product){
                $order->amount += $product->price * $product->pivot->count;
            }

            if($order->promo_code)
                $sale = PromoCode::where('code', $order->promo_code)->first()->percent;
            else
                $sale = 0;

            $total_bonus += $order->amount * ($order->trainer_percent - $sale)/100;
        }
        return $total_bonus;
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
        $amount = collect($this->trainer->payments->toArray())->where('payment_date',  null)->sum('amount');

        return $amount;
    }
}
