<?php

namespace App\Http\Controllers\Trainer;

use App\Models\Trainer;
use App\Models\Image;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    protected $trainer;
    protected $locale;

    public function __construct(Request $request){
        $this->middleware('auth:trainer');

        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }

        if(Auth::guard('trainer')->check())
            $this->trainer = Auth::guard('trainer')->user();
    }

    /**
     * Show trainer settings page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $trainer = Trainer::with('image')->find($this->trainer->id);
        return view('trainer.settings', compact('trainer'));
    }

    /**
     * Update trainer settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){

        if(empty($request->current_password) && empty($request->password) && empty($request->password_conformation)){
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'image' => 'image'
            ]);

            Trainer::where('id', $this->trainer->id)->update([
                'name' => preg_replace('/\s\s+/', ' ', $request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'gym_id' => $request->gym
            ]);

            if($request->hasFile('image')){

                $destinationPath = 'images/trainerImages';
                $ext = $request->file('image')->clientExtension();
                $fileName = time().'.'.$ext;

                $request->file('image')->move($destinationPath, $fileName);

                if($this->trainer->image) {
                    unlink('images/trainerImages/' . $this->trainer->image->name);
                    $this->trainer->image->update(['name' => $fileName]);
                }
                else {
                    Image::create(['name' => $fileName, 'imageable_type' => 'trainers', 'imageable_id' => $this->trainer->id, 'role' => 0]);
                }
            }

            return redirect()->back()->with('message', 'Changes was saved');
        }
        else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'image' => 'image',
                'current_password' => 'required',
                'password' => 'required|confirmed'
            ]);

            if(Hash::check($request->current_password, $this->trainer->password)){
                Trainer::where('id', $this->trainer->id)->update([
                    'name' => preg_replace('/\s\s+/', ' ', $request->name),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'gym_id' => $request->gym,
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

    public function updateImage(Request $request)
    {
        if($request->hasFile('image')){

            $destinationPath = 'images/trainerImages';
            $ext = $request->file('image')->clientExtension();
            $fileName = time().'.'.$ext;

            $request->file('image')->move($destinationPath, $fileName);

            if($this->trainer->image) {
                unlink('images/trainerImages/' . $this->trainer->image->name);
                $this->trainer->image->update(['name' => $fileName]);
            }
            else {
                Image::create(['name' => $fileName, 'imageable_type' => 'trainers', 'imageable_id' => $this->trainer->id, 'role' => 0]);
            }
        }

        return redirect()->back();
    }

    function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) ? true : false;
    }
}
