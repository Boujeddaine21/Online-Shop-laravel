<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->order()->with('product')->latest()->paginate(10);
        return view('user.orders', [
            'orders' => $orders,
        ]);
    }
}
