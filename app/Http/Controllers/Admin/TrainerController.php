<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gym;
use App\Models\Message;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PromoCode;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
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

    /**
     * Show all trainers page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){

        $trainers = Trainer::with([
            'orders' => function($orders){
                    return $orders->with('products');
                },
            'image',
            'payments',
            'promoCode'
        ])->orderBy('created_at', 'desc')->get();

        foreach($trainers as $trainer){

            $total_bonus = $this->getBonus($trainer);

            $paid = $this->getPaidAmount($trainer);

            $pending = $this->getPendingAmount($trainer);

            $trainer->active_bonus = $total_bonus - $paid - $pending;
            $trainer->gym = Gym::where('id', $trainer->gym_id)->first();
        }

        return view('admin.trainers.index', compact('trainers'));
    }

    /**
     * Show single trainer page
     *
     * @param $trainer_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($trainer_id){
        $trainer = Trainer::with([
                'image',
                'payments' => function($payments){
                        return $payments->orderBy('created_at', 'desc');
                    },
                'orders' => function($orders){
                        return $orders->with('products');
                    },
                ])->find($trainer_id);
        
        $trainer->total_bonus = $this->getBonus($trainer);

        $trainer->paid = $this->getPaidAmount($trainer);

        $trainer->pending = $this->getPendingAmount($trainer);
        
        $trainer->gym = Gym::where('id', $trainer->gym_id)->first();

        if($this->isJSON($trainer->custom_name)){
            $trainer->name_is_configured = true;
        }

        return view('admin.trainers.profile', compact('trainer'));
    }

    /**
     * Load more payments
     *
     * @param $trainer_id
     * @param $count
     * @return mixed
     */
    public function morePayments($trainer_id, $count){
        $data['payments'] = DB::table('payments')->where('trainer_id', $trainer_id)->orderBy('created_at', 'desc')->skip($count)->take(10)->get();
        $data['exist'] = DB::table('payments')->where('trainer_id', $trainer_id)->orderBy('created_at', 'desc')->skip($count+10)->take(1)->get();
        return $data;
    }

    /**
     * Update trainer settings
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){
        $name = json_encode(preg_replace('/\s\s+/', ' ', $request->name), JSON_UNESCAPED_UNICODE);
        
        $percent = $request->percent;
        Trainer::where('id', $id)->update(['percent' => $percent, 'custom_name' => $name]);
        
        return redirect()->back()->with('message', 'Data was successfully updated');
    }

    /**
     * Delete trainer
     *
     * @param $id
     */
    public function delete($id){
        Trainer::find($id)->delete();
    }

    /**
     * Approve trainer
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id){
        Trainer::where('id', $id)->update(['is_approved' => 1]);
        return redirect()->back()->with('message', 'Profile Approved');
    }

    /**
     * Mark messages as seen for current trainer
     *
     * @param $trainer_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function paymentsSeen($trainer_id){
        $count = Payment::where('trainer_id', $trainer_id)->where('is_seen', 0)->count();
        $payments = Payment::where('trainer_id', $trainer_id)->where('is_seen', 0)->get();
        Payment::where('trainer_id', $trainer_id)->update(['is_seen' => 1]);


        return response()->json(['count' => $count, 'payments' => $payments]);
    }

    /**
     * Mark trainer as seen
     *
     * @param $id
     */
    public function seen($id){
        Trainer::where('id', $id)->update(['is_seen' => 1]);
    }

    public function getBonus($trainer){
        $os = Order::with('products')->where('trainer_id', $trainer->id)->where('status', 1)->get();

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

    public function getPaidAmount($trainer){
        $amount = 0;
        foreach($trainer->payments->toArray() as $payment){
            if(!is_null($payment['payment_date'])){
                $amount += $payment['amount'];
            }
        }
        return $amount;
    }

    public function getPendingAmount($trainer){
        $amount = collect($trainer->payments->toArray())->where('payment_date', null)->sum('amount');

        return $amount;
    }
}
