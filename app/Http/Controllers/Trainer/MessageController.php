<?php

namespace App\Http\Controllers\Trainer;

use App\Events\NewMessageEvent;
use App\Models\Message;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class MessageController extends Controller
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
     * Send new payment message
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request){
        $this->validate($request, [
            'amount' => 'required'
        ]);

        $trainer = Trainer::with('image')->find($this->trainer->id);

        $os = Order::with('products')->where('trainer_id', $this->trainer->id)->where('status', 1)->get();

        $total_bonus = 0;
        foreach($os as $order){
            foreach($order->products as $product){
                $order->amount += $product->price * $product->pivot->count;
            }
            $total_bonus += $order->amount * $order->trainer_percent/100;
        }

        $paid = $trainer->payments->sum('amount');
        $active = $total_bonus - $paid;


        if($request->amount > $active){
            return redirect()->back()->with('error', trans('validation.amount_error'));
        }

        // Minimum amount
        $min_payment_amount = Setting::first()->min_payment_amount;
        if($active < $min_payment_amount){
            return redirect()->back()->with('error', trans('validation.min_amount', ['attribute' => $min_payment_amount]));
        }

        $message = Message::create(['trainer_id' => $this->trainer->id, 'amount' => $request->amount]);
        $sender = Trainer::with('image')->find($this->trainer->id)->toArray();

        Event::fire(new NewMessageEvent($sender, $message));
        return redirect()->back()->with('message', 'Ձեզ հետ կկապնվի մեր օպերատորը գումարի փոախանցման հարցով');
    }
}
