<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }
    
    public function index(){
        $data = Setting::first();
        return view('admin.settings.index', compact('data'));
    }
    
    public function update(Request $request){
        
        Setting::first()->update(['trainer_percent' => $request->trainer_percent, 'min_amount_free_shipping' => $request->min_amount_free_shipping ]);
        return redirect()->back()->with('message', 'Data was successfully updated');
    }
}
