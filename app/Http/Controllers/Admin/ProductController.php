<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $products = Product::with('thumb_image')->paginate(6);

        return view('admin.products.index', compact('products'));
    }

    public function create(){

    }
}
