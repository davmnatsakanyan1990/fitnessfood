<?php

namespace App\Http\Controllers\Admin;

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
            $total = 0;
            foreach($trainer->orders as $order){
                foreach($order->products as $product) {
                    $total = $total + ($product->price * $product->pivot->count);
                }
            }
            $trainer->total = $total;
            $trainer->total_bonus = $total/10;
            $trainer->new_messages = $trainer->messages->count();
            $trainer->active = $trainer->total_bonus - $trainer->payments->sum('amount');
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
        foreach($trainer->orders as $order){
            foreach($order->products as $product) {
                $total = $total + ($product->price * $product->pivot->count);
            }
        }
        $trainer->total = $total;
        $trainer->bonus = $total/10;
        $trainer->paid = $trainer->payments->sum('amount');

        return view('admin.trainers.profile', compact('trainer'));
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
