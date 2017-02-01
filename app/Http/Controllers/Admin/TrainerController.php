<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gym;
use App\Models\Message;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class TrainerController extends AdminBaseController
{
    protected $locale;

    public function __construct(Request $request)
    {
        parent::__construct();

//        if($request->route()->parameter('locale')){
//            $this->locale = $request->route()->parameter('locale');
//            App::setLocale($this->locale);
//        }

    }
    
    public function index(){

        $trainers = Trainer::with([
            'orders' => function($orders){
                    return $orders->with('products');
                },
            'image',
            'messages' =>function($messages){
                    return $messages->where('is_seen', 0);
                },
            'payments'
        ])->orderBy('created_at', 'desc')->get();

        foreach($trainers as $trainer){

            $total_bonus = 0;
            foreach($trainer->orders as $order){
                foreach($order->products as $product) {
                    $order->amount += $product->price * $product->pivot->count;
                }
                $total_bonus += ($order->amount * $order->trainer_percent)/100;
            }

            $trainer->active_bonus = $total_bonus - $trainer->payments->sum('amount');
            $trainer->gym = Gym::where('id', $trainer->gym_id)->first();
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
        $total_bonus = 0;

        if(count($trainer->orders)>0) {
            foreach ($trainer->orders as $order) {
                foreach ($order->products as $product) {
                    $trainer->total += $product->price * $product->pivot->count;
                    $order->amount += $product->price * $product->pivot->count;
                }

                $trainer->total_bonus += ($order->amount * $order->trainer_percent)/100;
            }
        }

        $trainer->paid = $trainer->payments->sum('amount');
        $trainer->gym = Gym::where('id', $trainer->gym_id)->first();

        return view('admin.trainers.profile', compact('trainer'));
    }
    
    public function update(Request $request, $id){
//        $first_name = json_encode($request->first_name);
//        $last_name = json_encode($request->last_name);
        $percent = $request->percent;
        Trainer::where('id', $id)->update(['percent' => $percent]);
        
        return redirect()->back()->with('message', 'Data was successfully updated');
    }

    public function delete($id){
        Trainer::find($id)->delete();
    }

    public function approve($id){
        Trainer::where('id', $id)->update(['is_approved' => 1]);
        return redirect()->back()->with('message', 'Profile Approved');
    }

    public function messagesSeen($trainer_id){
        $count = Message::where('trainer_id', $trainer_id)->where('is_seen', 0)->count();
        $messages = Message::where('trainer_id', $trainer_id)->where('is_seen', 0)->get();
        Message::where('trainer_id', $trainer_id)->update(['is_seen' => 1]);


        return response()->json(['count' => $count, 'messages' => $messages]);
    }

    public function seen($id){
        Trainer::where('id', $id)->update(['is_seen' => 1]);
    }
}
