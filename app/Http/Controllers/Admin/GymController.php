<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gym;
use Illuminate\Http\Request;
use App\Http\Requests;

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
     * Create new gym
     *
     * @param Request $request
     */
    public function save(Request $request){
        Gym::create(['name' => $request->name]);
    }

    /**
     * Update gym
     * 
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id){
        Gym::where('id', $id)->update(['name' => $request->name]);
    }

    /**
     * Delete gym
     * 
     * @param $id
     */
    public function delete($id){
        Gym::where('id', $id)->delete();
    }

    /**
     * Get single gym
     *
     * @param $id
     * @return mixed
     */
    public function getGym($id){
        $gym = Gym::find($id);

        return $gym;
    }
}
