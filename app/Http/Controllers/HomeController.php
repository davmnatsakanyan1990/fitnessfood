<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    public $locale;

    public function __construct(Request $request){
        if($request->route()->parameter('locale')){
            $this->locale = $request->route()->parameter('locale');
            App::setLocale($this->locale);
        }
    }

    /**
     * Show home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request){
        $cat = $request->cat;

        if($this->locale)
            $locale = $this->locale;
        else
            $locale = 'am';

        if($cat){
            $products = Product::with('images', 'thumb_image')->where('category_id', $cat)->get();
        }
        else {

            $products = Product::with('images', 'thumb_image')->where('first_page', 1)->get();
        }

        if(count($products)>0) {
            foreach ($products as $product) {
                $product->description = json_decode($product->description)->$locale;
                $product->title = json_decode($product->title)->$locale;
            }

//            $products = $products->chunk(3);
        }
        else{
            $products = [];
        }

        $categories = Category::all();
        foreach($categories as $category){
            $category->name = json_decode($category->name)->$locale;
        }

        return view('home', compact('products', 'categories'));

    }

    //Ajax call | Get single product info
    public function getProduct($id){
        $locale = $this->locale;
        $product = Product::with('images', 'thumb_image')->find($id);
        $product->description = json_decode($product->description)->$locale;
        $product->title = json_decode($product->title)->$locale;
        
        $data = [];
        $data['view'] = View::make('ajax.product_carousel', compact('product'))->render();
        $data['data'] = $product;
        return $data;
    }
}
