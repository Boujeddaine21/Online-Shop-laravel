<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with(['user', 'product'])->latest()->paginate(10);
        return view("/admin/orders",[
            "orders"=> $orders,
        ]);
    }

    public function updateStatus(Request $request, Order $order){
        $request->validate([
            'payment_status' => 'required|string|in:pending,paid,shipped,cancelled',
        ]);

        $order->update([
            'payment_status' => $request->payment_status,
        ]);

        return redirect('/admin/orders')->with('statusUpdated', 'Bestellstatus aktualisiert');
    }
}
