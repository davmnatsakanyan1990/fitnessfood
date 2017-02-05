<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Payment;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    protected $trainer;

    public function __construct(){
        $this->middleware('auth:trainer');

        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    /**
     * Shoe trainer payment history
     */
    public function index(){
        $payments = $this->trainer->payments;
        dd($payments);
    }
}
