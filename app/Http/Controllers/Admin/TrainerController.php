<?php

namespace App\Http\Controllers\Admin;

use App\Models\Trainer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TrainerController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(){
        $trainers = Trainer::with('orders', 'image')->get();
//        dd($trainers->toArray());
//        dd($trainers);
        return view('admin.trainers.index', compact('trainers'));
    }
}
