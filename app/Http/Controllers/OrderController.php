<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::paginate(10);
        return view("/admin/orders",[
            "orders"=> $orders,
        ]);
    }
}
