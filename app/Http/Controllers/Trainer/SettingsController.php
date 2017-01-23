<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    protected $trainer;

    public function __construct(){
        $this->middleware('auth:trainer');

        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    public function index(){
        $trainer = $this->trainer;
        return view('trainer.settings', compact('trainer'));
    }

    public function update(Request $request){
        if(empty($request->current_password) && empty($request->password) && empty($request->password_conformation)){
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required'
            ]);

            Trainer::where('id', $this->trainer->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email
            ]);

            return redirect()->back()->with('message', 'Changes was saved');
        }
        else{
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'current_password' => 'required',
                'password' => 'required|confirmed'
            ]);

            if(Hash::check($request->current_password, $this->trainer->password)){
                Trainer::where('id', $this->trainer->id)->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => $request->password

                ]);

                return redirect()->back()->with('message', 'Changes was saved');
            }
            else{
                return redirect()->back()->with('error', 'Incorrect password');
            }
        }

    }
}
