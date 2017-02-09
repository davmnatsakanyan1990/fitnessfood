<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    /**
     * Show all payments
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $payments = Payment::with('trainer')->orderBy('created_at', 'desc')->get();
        
        return view('admin.payments.index', compact('payments'));
    }

    public function create(Request $request){
        Payment::create(['trainer_id' => $request->trainer_id, 'amount' => $request->amount, 'payment_date' => date("Y-m-d H:i:s"), 'is_seen' => 1] );
    }

    /**
     * Update payment
     *
     * @param Request $request
     * @param $id
     */
    public function update(Request $request){
        $payment = Payment::find($request->payment_id);
        if(is_null($payment->payment_date) && $request->status == 1)
            Payment::where('id', $request->payment_id)->update(['payment_date' => date("Y-m-d H:i:s"), 'amount' => $request->amount]);
        elseif(!is_null($payment->payment_date) && $request->status == 0)
            Payment::where('id', $request->payment_id)->update(['payment_date' => null, 'amount' => $request->amount]);
        else
            Payment::where('id', $request->payment_id)->update(['amount' => $request->amount]);


        return redirect()->back();
    }

    /**
     * Delete payment
     *
     * @param $id
     */
    public function delete($id){
        Payment::where('id', $id)->delete();
    }
}
