@extends('components.layout')
@section('page-title', 'Admin Dashboard')
@section('dashboard')
<div>
    <h1 class="text-3xl font-bold text-white mb-8">📊 Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-10">
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-5 border border-white/10">
            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Orders</p>
            <p class="text-2xl font-bold text-white">{{ $total_orders }}</p>
            <a href="/admin/orders" class="text-teal-400 text-xs hover:underline mt-2 inline-block">Details →</a>
        </div>
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-5 border border-white/10">
            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Products</p>
            <p class="text-2xl font-bold text-white">{{ $total_products }}</p>
            <a href="/admin/products" class="text-teal-400 text-xs hover:underline mt-2 inline-block">Details →</a>
        </div>
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-5 border border-white/10">
            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Categories</p>
            <p class="text-2xl font-bold text-white">{{ $total_categories }}</p>
        </div>
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-5 border border-white/10">
            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Users</p>
            <p class="text-2xl font-bold text-green-400">{{ $total_users }}</p>
        </div>
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-5 border border-white/10">
            <p class="text-gray-400 text-xs font-medium uppercase tracking-wide mb-1">Revenue</p>
            <p class="text-2xl font-bold text-emerald-400">{{ number_format($total_revenue, 2) }} €</p>
        </div>
    </div>

    <!-- Revenue Chart (CSS only) -->
    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/10 mb-10">
        <h2 class="text-lg font-bold text-white mb-4">Umsatz der letzten 7 Tage</h2>
        <div class="flex items-end justify-between gap-3" style="height: 180px;">
            @foreach ($revenueChart as $day)
                @php
                    $heightPercent = $maxRevenue > 0 ? ($day['revenue'] / $maxRevenue) * 100 : 0;
                    $minHeight = $day['revenue'] > 0 ? max($heightPercent, 8) : 4;
                @endphp
                <div class="flex-1 flex flex-col items-center gap-2">
                    <span class="text-xs text-teal-300 font-medium">
                        {{ $day['revenue'] > 0 ? number_format($day['revenue'], 0) . '€' : '' }}
                    </span>
                    <div class="w-full rounded-t-lg transition-all duration-500"
                        style="height: {{ $minHeight }}%; background: linear-gradient(to top, #14b8a6, #06b6d4); min-height: 4px;">
                    </div>
                    <span class="text-xs text-gray-400">{{ $day['day'] }}</span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Orders -->
    @if($recentOrders->count() > 0)
    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-white">Letzte Bestellungen</h2>
            <a href="/admin/orders" class="text-teal-400 text-sm hover:underline">Alle anzeigen →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-400 text-xs uppercase border-b border-white/10">
                        <th class="text-left py-2 px-3">Order</th>
                        <th class="text-left py-2 px-3">Kunde</th>
                        <th class="text-right py-2 px-3">Total</th>
                        <th class="text-center py-2 px-3">Status</th>
                        <th class="text-right py-2 px-3">Datum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentOrders as $order)
                    <tr class="border-b border-white/5 text-gray-300 hover:bg-white/5 transition">
                        <td class="py-3 px-3 font-mono text-xs">{{ $order->order_number }}</td>
                        <td class="py-3 px-3">{{ $order->user->firstname }} {{ $order->user->lastname }}</td>
                        <td class="py-3 px-3 text-right font-bold text-white">{{ number_format($order->total, 2) }} €</td>
                        <td class="py-3 px-3 text-center">
                            @if($order->payment_status === 'pending')
                                <span class="px-2 py-0.5 text-xs bg-amber-500/20 text-amber-300 rounded-full">Pending</span>
                            @elseif($order->payment_status === 'paid')
                                <span class="px-2 py-0.5 text-xs bg-green-500/20 text-green-300 rounded-full">Paid</span>
                            @elseif($order->payment_status === 'shipped')
                                <span class="px-2 py-0.5 text-xs bg-blue-500/20 text-blue-300 rounded-full">Shipped</span>
                            @elseif($order->payment_status === 'cancelled')
                                <span class="px-2 py-0.5 text-xs bg-red-500/20 text-red-300 rounded-full">Cancelled</span>
                            @endif
                        </td>
                        <td class="py-3 px-3 text-right text-xs text-gray-400">{{ $order->created_at->format('d.m.Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
