<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public $locale;

    public function __construct(Request $request){
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }
    }

   public function  index(){
       return view('contact');
   }

    /**
     * Send new message
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'text' => 'required'
        ]);

        Mail::raw($request->text, function ($message) use ($request) {
            $message->from($request->email, 'FitnessFood');

            $message->to(env('SUPPORT_MAIL'));
        });

        return redirect()->back()->with('message', 'Message was sent');
    }
}
