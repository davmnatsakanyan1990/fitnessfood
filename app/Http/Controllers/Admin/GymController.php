<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gym;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GymController extends AdminBaseController
{
    /**
     * GymController constructor.
     */
    public function __construct(){
        $this->middleware('auth:admin');
        parent::__construct();
    }

    /**
     * Show gyms list
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $gyms = Gym::all();
        return view('admin.gyms.index', compact('gyms'));
    }

    /**
     * Show gym create form
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        return view('admin.gyms.create');
    }

    /**
     * Create new gym
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request){
        Gym::create(['name' => $request->name]);
        return redirect('admin/gyms')->with('message', 'Gym was created');
    }

    /**
     * Show edit gym form
     * 
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $gym = Gym::find($id);

        return view('admin.gyms.edit', compact('gym'));
    }

    /**
     * Update gym
     * 
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id){
        Gym::where('id', $id)->update(['name' => $request->name]);
        return redirect('admin/gyms')->with('message', 'Data was updated');
    }

    /**
     * Delete gym
     * 
     * @param $id
     */
    public function delete($id){
        Gym::where('id', $id)->delete();
    }
}
