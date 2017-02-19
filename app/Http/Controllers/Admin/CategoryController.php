<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoryController extends AdminBaseController
{
    /**
     * CategoryController constructor.
     */
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function index(){
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create(Request $request){
        $this->validate($request, [
            'name.*' => 'required'
        ]);

        Category::create(['name' => json_encode($request->name, JSON_UNESCAPED_UNICODE)]);

        return redirect()->back()->with('message', 'Category was added');
    }

    public function update(Request $request){

        Category::where('id', $request->cat_id)->update([
            'name' => json_encode($request->name, JSON_UNESCAPED_UNICODE)
        ]);

        return redirect()->back()->with('message', 'Category was updated');
    }

    public function delete($id){
        Category::where('id', $id)->delete();
    }

    public function getCategory($id){
        $category = Category::find($id);

        return $category;
    }

}
