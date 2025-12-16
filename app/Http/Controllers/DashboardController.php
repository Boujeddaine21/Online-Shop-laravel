<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view("admin.dashboard", [
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_categories'=> Categorie::count(),
        ]);
    }
}
