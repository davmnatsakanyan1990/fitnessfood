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
        $products = Product::with('thumb_image')->orderBy('created_at', 'desc')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create(){
        return view('admin.products.create');
    }

    public function save(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'price'=>'required',
            'status'=>'required'
        ]);

        Product::create([
            'title' => $request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'status'=>$request->status
        ]);

        return redirect('admin/products')->with('message', 'Product was created successfully');
    }
    
    public function edit($product_id){
        $product = Product::find($product_id);
        
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request){
        $this->validate($request, [
            'title' => $request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'status'=>$request->status
        ]);

        Product::find($request->product_id)->update([
            'title'=>$request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'status'=>$request->status
        ]);
    }

    public function delete($product_id){
        Product::find($product_id)->delete();

        return response()->json(['message' => 'Product was deleted']);
    }
}
