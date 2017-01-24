<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Trainer;
use App\Models\Image;
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
        $trainer = Trainer::with('image')->find($this->trainer->id);
        return view('trainer.settings', compact('trainer'));
    }

    public function update(Request $request){

        if(empty($request->current_password) && empty($request->password) && empty($request->password_conformation)){
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'image' => 'image'
            ]);

            Trainer::where('id', $this->trainer->id)->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email
            ]);

            if($request->hasFile('image')){

                $destinationPath = 'images/trainerImages';
                $ext = $request->file('image')->clientExtension();
                $fileName = time().'.'.$ext;

                $request->file('image')->move($destinationPath, $fileName);

                Image::create(['name' => $fileName, 'imageable_type' => 'trainers', 'imageable_id' => $this->trainer->id, 'role' => 0]);
            }

            return redirect()->back()->with('message', 'Changes was saved');
        }
        else{
            $this->validate($request, [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'image' => 'image',
                'current_password' => 'required',
                'password' => 'required|confirmed'
            ]);

            if(Hash::check($request->current_password, $this->trainer->password)){
                Trainer::where('id', $this->trainer->id)->update([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)

                ]);

                if($request->hasFile('image')){

                    $destinationPath = 'images/trainerImages';
                    $ext = $request->file('image')->clientExtension();
                    $fileName = time().'.'.$ext;

                    $request->file('image')->move($destinationPath, $fileName);

                    Image::create(['name' => $fileName, 'imageable_type' => 'trainers', 'imageable_id' => $this->trainer->id, 'role' => 0]);
                }

                return redirect()->back()->with('message', 'Changes was saved');
            }
            else{
                return redirect()->back()->with('error', 'Incorrect password');
            }
        }

    }
}
