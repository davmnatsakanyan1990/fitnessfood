<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gym;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GymController extends AdminBaseController
{
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    public function index(){
        $gyms = Gym::all();
        return view('admin.gyms.index', compact('gyms'));
    }

    public function create(){
        return view('admin.gyms.create');
    }

    public function save(Request $request){
        Gym::create(['name' => $request->name]);
        return redirect('admin/gyms')->with('message', 'Gym was created');
    }

    public function edit($id){
        $gym = Gym::find($id);

        return view('admin.gyms.edit', compact('gym'));
    }

    public function update(Request $request, $id){
        Gym::where('id', $id)->update(['name' => $request->name]);
        return redirect('admin/gyms')->with('message', 'Data was updated');
    }

    public function delete($id){
        Gym::where('id', $id)->delete();
        return redirect('admin/gyms')->with('message', 'Gym was deleted');
    }
}
