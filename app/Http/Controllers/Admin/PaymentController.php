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

    public function index(){
        $payments = Payment::with('trainer')->orderBy('created_at', 'desc')->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function update(Request $request, $id){
        Payment::where('id', $id)->update(['amount' => $request->amount]);
    }

    public function create(Request $request){
        Payment::create(['trainer_id' => $request->trainer_id, 'amount' => $request->amount]);
    }

    public function delete($id){
        Payment::where('id', $id)->delete();
    }
}
