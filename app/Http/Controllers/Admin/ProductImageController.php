<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductImageController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function index($product_id){

        $product = Product::find($product_id);
        if($product){
            $images = $product->images->toArray();

            return view('admin.products.images', compact('images', 'product'));
        }
        else{
            abort(404);
        }

    }

    public function addImage(Request $request, $product_id){

        foreach($request->file('files') as $image){

            $destinationPath = 'images\productImages';
            $randomNumber = str_random(5);
            $ext = $image->getClientOriginalExtension();

            $fileName = time().$randomNumber.'.'.$ext;

            $image->move($destinationPath, $fileName);

            Image::create(['name'=>$fileName, 'imageable_type'=>'products', 'imageable_id'=>$product_id, 'role'=>0]);
        }


    }
}
