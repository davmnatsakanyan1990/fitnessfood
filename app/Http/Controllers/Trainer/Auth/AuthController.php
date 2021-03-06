<?php

namespace App\Http\Controllers\Trainer\Auth;

use App\Events\NewTrainerEvent;
use App\Models\PromoCode;
use App\Models\Setting;
use App\Models\Trainer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Event;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $registerView = 'trainer.auth.register';
    protected $redirectTo;
    protected $redirectAfterLogout;
    protected $guard = 'trainer';
    protected $loginView = 'trainer.auth.login';
//    protected $username = 'username';
    public $locale;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }

        $this->redirectTo = 'trainer/profile/'.$this->locale;
        $this->redirectAfterLogout = 'trainer/login/'.$this->locale;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:trainers',
            'phone' => 'required',
            'password' => 'regex:/^(?=.*[a-zA-Z])(?=.*[0-9])/|required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $percent = Setting::first()->trainer_percent;
        $trainer = Trainer::create([
            'name' => preg_replace('/\s\s+/', ' ', $data['name']),
            'email' => $data['email'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'percent' => $percent,
            'gym_id' => $data['gym'] == "" ? null : $data['gym'],
            'password' => bcrypt($data['password']),
        ]);

        $this->generatePromoCode($trainer->id);

        Event::fire(new NewTrainerEvent($trainer));

        return $trainer;
    }

    public function generatePromoCode($trainer_id){
        $code = rand(1000, 9999);
        $obj = PromoCode::where('code', $code)->first();
        
        if($obj){
            $this->generatePromoCode($trainer_id);
        }
        else{
            PromoCode::create([
                'code' => $code,
                'trainer_id' => $trainer_id
            ]);
        }
    }

}
