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
        foreach ($payments as $payment){
            $payment->trainer->name_is_json = $this->isJSON($payment->trainer->first_name);
        }
        
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Update payment
     *
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id){
        Payment::where('id', $id)->update(['amount' => $request->amount]);
    }

    /**
     * Create new payment
     *
     * @param Request $request
     */
    public function create(Request $request){
        Payment::create(['trainer_id' => $request->trainer_id, 'amount' => $request->amount]);
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
