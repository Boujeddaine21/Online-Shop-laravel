<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view("admin.dashboard", [
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_categories'=> Categorie::count(),
            'total_users' => User::role('user')->count(),
            'total_revenue' => Order::where('payment_status', '!=', 'cancelled')->sum('total'),
        ]);
    }
}
