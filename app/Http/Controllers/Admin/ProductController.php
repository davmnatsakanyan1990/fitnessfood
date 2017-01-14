<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function create(){
        return view('admin.create_product');
    }


    public function addImage(Request $request){
        foreach($request->file('files') as $image){

                $destinationPath = 'images\productImages';
                $randomNumber = str_random(5);
                $ext = $image->getClientOriginalExtension();

                $fileName = time().$randomNumber.'.'.$ext;

                $image->move($destinationPath, $fileName);
        }
    }
}
