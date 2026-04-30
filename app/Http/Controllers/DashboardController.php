<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Umsatz der letzten 7 Tage
        $dailyRevenue = Order::where('payment_status', '!=', 'cancelled')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total) as revenue')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // 7 Tage Array aufbauen (auch Tage ohne Umsatz)
        $revenueChart = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayLabel = now()->subDays($i)->format('D');
            $revenueChart[] = [
                'day' => $dayLabel,
                'date' => $date,
                'revenue' => isset($dailyRevenue[$date]) ? (float) $dailyRevenue[$date]->revenue : 0,
            ];
        }

        $maxRevenue = max(array_column($revenueChart, 'revenue'));
        if ($maxRevenue == 0) $maxRevenue = 1;

        // Letzte 5 Bestellungen
        $recentOrders = Order::with('user', 'product')->latest()->take(5)->get();

        return view("admin.dashboard", [
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_categories' => Categorie::count(),
            'total_users' => User::role('user')->count(),
            'total_revenue' => Order::where('payment_status', '!=', 'cancelled')->sum('total'),
            'revenueChart' => $revenueChart,
            'maxRevenue' => $maxRevenue,
            'recentOrders' => $recentOrders,
        ]);
    }
}
