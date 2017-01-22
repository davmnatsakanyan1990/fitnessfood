<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function index(){
        $products = Product::with('images', 'thumb_image')->get()->chunk(4);
//dd($products);
        return view('home', compact('products'));
    }
}
