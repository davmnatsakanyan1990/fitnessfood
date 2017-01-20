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
        $trainers = Trainer::with(['orders' => function($orders){
            return $orders->with('products');
        }, 'image'])->get();
        foreach($trainers as $trainer){
            $total = 0;
            foreach($trainer->orders as $order){
                $total = $total + $order->products->sum('price');
            }
            $trainer->total = $total;
            $trainer->total_bonus = $total/10;
        }

        return view('admin.trainers.index', compact('trainers'));
    }
}
