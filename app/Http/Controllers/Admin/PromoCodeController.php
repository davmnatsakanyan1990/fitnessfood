<?php

namespace App\Http\Controllers\Admin;

use App\Models\PromoCode;
use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PromoCodeController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function index(){
        $promoCodes = PromoCode::with('trainer')->get();
        $trainers = Trainer::all();

        return view('admin.promo_codes.index', compact('promoCodes', 'trainers'));
    }

    public function getCodeData($id){
        $data = PromoCode::with(['trainer' => function($trainer){
                return $trainer->with('image', 'gym');
            }])
            ->find($id);

        return $data->toArray();
    }

//    public function create(Request $request){
//        $code = $this->generatePromoCode();
//
//        PromoCode::create([
//            'code' => $code,
//            'trainer_id' => $request->trainer,
//            'percent' => $request->percent
//        ]);
//
//        return redirect()->back()->with('message', 'Promo Code was successfully generated');
//    }

//    public function getPromo($id){
//        $promo = PromoCode::with('trainer')->find($id);
//
//        return $promo;
//    }
//
//    public function edit(Request $request){
//        PromoCode::where('id', $request->id)->update(['percent' => $request->percent]);
//
//        return redirect()->back()->with('message', 'Data was successfully updated');
//    }
//
//    public function generatePromoCode(){
//        $code = rand(1000, 9999);
//        $obj = PromoCode::where('code', $code)->first();
//
//        if($obj){
//            $this->generatePromoCode();
//        }
//        else{
//            return $code;
//        }
//    }

//    public function delete($id){
//        PromoCode::where('id', $id)->delete();
//    }
}
