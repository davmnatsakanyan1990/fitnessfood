<?php

namespace App\Http\Controllers\Trainer;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    protected $trainer;
    public $locale;

    public function __construct(Request $request){
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }

        $this->middleware('auth:trainer');

        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    public function index(){
        
    }

    public function create(){

    }

    public function update(){

    }

    public function delete(){

    }
}
