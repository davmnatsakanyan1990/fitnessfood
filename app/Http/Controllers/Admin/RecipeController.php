<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Recipe;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RecipeController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function index(){
        $recipes = Recipe::with('profile_image')->get();

        return view('admin.recipes.index', compact('recipes'));
    }

    public function edit($id){
        $recipe = Recipe::find($id);

        return view('admin.recipes.edit', compact('recipe'));
    }

    public function update(Request $request, $id){
        Recipe::where('id', $id)->update(['title' => json_encode($request->title), 'text' => json_encode($request->text)]);

        if($request->profile_image){
            $this->update_image($request->file('profile_image'), $id);
        }

        return redirect()->back();

    }

    public function update_image($profile_image, $id){

        $image = Recipe::find($id)->profile_image;

        $destinationPath = 'images/recipes';

        $fileName = time().'.'.$profile_image->getClientOriginalExtension();

        $profile_image->move($destinationPath, $fileName);

        if($image){

            if(file_exists(asset('images/recipes/'.$image->name)))
                unlink(asset('images/recipes/'.$image->name));

            $image->update(['name' => $fileName]);
        }
        else{
            Image::create(['name' => $fileName, 'imageable_type' => 'recipe', 'imageable_id' => $id, 'role' => 1]);
        }
    }

    public function create(){
        return view('admin.recipes.create');
    }

    public function save(Request $request){
        $recipe = Recipe::create(['title' => json_encode($request->title), 'text' => json_encode($request->text)]);

        if($request->profile_image){
            $this->update_image($request->file('profile_image'), $recipe->id);
        }

        return redirect('admin/recipes/all')->send();
    }

    public function delete($id){
        $image = Recipe::find($id)->profile_image;

        if($image){
            $image_name = $image->name;

            $image->delete();

            if(file_exists(asset('images/recipes/'.$image_name)))
                unlink('/images/recipes/'.$image_name);
        }

        Recipe::find($id)->delete();

        return redirect('admin/recipes/all')->send();
    }
}
