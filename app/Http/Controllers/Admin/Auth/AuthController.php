<?php

namespace App\Http\Controllers\Admin\Auth;


use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

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
    protected $redirectTo;
    protected $redirectAfterLogout;
    protected $guard = 'admin';
    protected $loginView = 'admin.auth.login';
    protected $username = 'username';
    protected $locale;

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

        $this->redirectTo = 'admin/trainers/'.$this->locale;
        $this->redirectAfterLogout = 'admin/login/'.$this->locale;
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

}
