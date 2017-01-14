<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductImageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index($product_id){

        $product = Product::find($product_id);
        if($product){
            $images = $product->images->toArray();
            dd($images);
            return view('admin.product_image', compact($images));
        }
        else{
            abort(404);
        }

    }
}
