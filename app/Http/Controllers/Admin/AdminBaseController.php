<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        $new_orders_count = Order::where('is_seen', 0)->count();
        view()->share('new_orders_count', $new_orders_count);
    }
}
