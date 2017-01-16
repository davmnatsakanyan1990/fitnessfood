<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;


class ProductController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function index(){
        $products = Product::with('thumb_image')->paginate(6);

        return view('admin.products.index', compact('products'));
    }

    public function create(){

    }
    
    public function edit($product_id){
        $product = Product::find($product_id);
        
        return view('admin.products.edit', compact('product'));
    }

    public function delete(Request $request){
        Product::find($request->product_id)->delete();
        return redirect()->back();
    }
}
