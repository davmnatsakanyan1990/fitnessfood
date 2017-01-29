<?php

namespace App\Http\Controllers\Trainer;

use App\Events\NewMessageEvent;
use App\Models\Message;
use App\Models\Order;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class MessageController extends Controller
{
    protected $trainer;

    public function __construct(){
        $this->middleware('auth:trainer');

        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    public function create(Request $request){

        $trainer = Trainer::with('image')->find($this->trainer->id);

        $os = Order::with('products')->where('trainer_id', $this->trainer->id)->where('status', 1)->get();
        foreach($os as $order){
            foreach($order->products as $product){
                $order->amount += $product->price * $product->pivot->count;
            }
        }

        $total = $os->sum('amount');

        $paid = $trainer->payments->sum('amount');
        $active = $total/10 - $paid;

        // Minimum amount 5000 AMD
        if($request->amount > $active){
            return redirect()->back()->with('error', 'Դուք չունեք բավականաչափ գումար ձեր հաշվի վրա');
        }
        if($active < 5000){
            return redirect()->back()->with('error', 'Նվազագույն գումարի չափը 5000դր է');
        }

        $message = Message::create(['trainer_id' => $this->trainer->id, 'amount' => $request->amount]);

        Event::fire(new NewMessageEvent($this->trainer, $message));
        return redirect()->back()->with('message', 'Ձեզ հետ կկապնվի մեր օպերատորը գումարի փոախանցման հարցով');
    }
}
