<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    
    protected $trainer;
    
    public function __construct(){
        $this->middleware('auth:trainer');
        
        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    public function index(){
        $trainer = Trainer::with(['orders' => function($orders){
            return $orders->with('products');
        }])->find($this->trainer->id);

dd($trainer->toArray());
        
        return view('trainer.profile', compact('trainer'));
    }
}

