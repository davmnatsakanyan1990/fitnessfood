<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SettingsController extends AdminBaseController
{
    /**
     * SettingsController constructor.
     */
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    /**
     * Show admin settings page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $data = Setting::first();
        return view('admin.settings.index', compact('data'));
    }

    /**
     * Update settings
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){
        
        Setting::first()->update([
            'trainer_percent' => $request->trainer_percent,
            'shipping_price' => $request->shipping_price,
            'min_amount_free_shipping' => $request->min_amount_free_shipping,
            'min_payment_amount' => $request->min_payment_amount,
            'wrk_hr_from' => $request->wrk_hr_from,
            'wrk_hr_to' => $request->wrk_hr_to
        ]);
        return redirect()->back()->with('message', 'Data was successfully updated');
    }
}
