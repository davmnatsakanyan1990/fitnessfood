<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;


class ProductController extends AdminBaseController
{
    /**
     * ProductController constructor.
     */
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    /**
     * Show products list
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
//        $product = Product::find(21);
//        dd($product);
//        dd(json_decode($product->description)->en);
        $products = Product::with('thumb_image')->orderBy('created_at', 'desc')->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show create product form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.products.create');
    }

    /**
     * Create new product
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse'
     */
    public function save(Request $request){
        $this->validate($request, [
//            'name'=>'required',
            'price'=>'required',
            'status'=>'required'
        ]);

        Product::create([
            'title' => json_encode($request->name, JSON_UNESCAPED_UNICODE),
            'price'=>$request->price,
            'description'=>json_encode($request->description, JSON_UNESCAPED_UNICODE),
            'nutritional_value' => $request->nutritional_value,
            'proteins' => $request->proteins,
            'carbs' => $request->carbs,
            'fats' => $request->fats,
            'calories' => $request->calories,
            'weight' => $request->weight,
            'status'=>$request->status
        ]);

        return redirect('admin/products')->with('message', 'Product was created successfully');
    }

    /**
     * Show product edit form
     *
     * @param $product_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($product_id){
        $product = Product::with('images')->find($product_id);
        if($product)
            return view('admin.products.edit', compact('product'));
        else
            abort(404);
    }

    /**
     * Update product
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request){

        $this->validate($request, [
//            'name'  => 'required',
            'price' =>'required',
            'status'=>'required'
        ]);

        Product::find($request->product_id)->update([
            'title'=>json_encode($request->name, JSON_UNESCAPED_UNICODE),
            'price'=>$request->price,
            'description'=>json_encode($request->description, JSON_UNESCAPED_UNICODE),
            'nutritional_value' => $request->nutritional_value,
            'proteins' => $request->proteins,
            'carbs' => $request->carbs,
            'fats' => $request->fats,
            'calories' => $request->calories,
            'weight' => $request->weight,
            'status'=>$request->status
        ]);

        return redirect()->back()->with('message', 'Product was successfully updated');
    }

    /**
     * Delete product
     *
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($product_id){
        Product::find($product_id)->delete();

        return response()->json(['message' => 'Product was deleted']);
    }

    /**
     * Show product's image upload form
     *
     * @param $product_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function newImage($product_id){

        $product = Product::find($product_id);
        if($product){

            return view('admin.products.image_upload', compact('product_id'));
        }
        else{
            abort(404);
        }
    }

    /**
     * Upload images
     *
     * @param Request $request
     * @param $product_id
     */
    public function uploadImage(Request $request, $product_id){

        $this->validate($request, [
            'file.*' => 'image|mimes:jpeg,png,jpg|dimensions:min_width=1024,min_height=480'
        ]);
        foreach($request->file('file') as $image){


            $destinationPath = 'images/products';
            $randomNumber = str_random(5);
            $ext = $image->getClientOriginalExtension();

            $fileName = time().$randomNumber.'.'.$ext;

            $image->move($destinationPath, $fileName);

            Image::create(['name'=>$fileName, 'imageable_type'=>'products', 'imageable_id'=>$product_id, 'role'=>0]);
        }
    }

    /**
     * Delete product image
     *
     * @param $id
     */
    public function deleteImage($id){
        $image = Image::find($id);

        $image->delete();

        if(file_exists('images/products/'.$image->name))
            unlink('images/products/'.$image->name);
    }

    /**
     * Set image as thumbnail image for product
     *
     * @param $product_id
     * @param $image_id
     */
    public function setThumbnail($product_id, $image_id){
        $thum_img = Image::where('imageable_id', $product_id)->where('role', 1)->first();
        if($thum_img){
            Image::where('imageable_id', $product_id)->where('role', 1)->update(['role'=>0]);
        }
        Image::find($image_id)->update(['role'=>1]);
    }
}
