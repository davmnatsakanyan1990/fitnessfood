<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Message;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $trainer;

    public function __construct(){
        $this->middleware('auth:trainer');

        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    public function create(Request $request){
        Message::create(['trainer_id' => $this->trainer->id, 'amount' => $request->amount]);
    }
}
