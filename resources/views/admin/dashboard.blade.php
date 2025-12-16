@extends('components.layout')

@section('dashboard')
<div class="flex gap-10 mt-10">
    <div class="relative z-10 bg-white/30 backdrop-blur-lg rounded-xl shadow-xl p-8 w-60 flex flex-col gap-6">
        <h3 class="text-gray-200 text-sm font-medium uppercase tracking-wide">Orders</h3>
        <h1 class="text-3xl font-bold text-white">{{ $total_orders }}</h1>
        <a href="/admin/orders" class="text-blue-300 font-medium text-sm hover:underline">See Details</a>
    </div>
    <div class="relative z-10 bg-white/30 backdrop-blur-lg rounded-xl shadow-xl p-8 w-60 flex flex-col gap-6">
        <h3 class="text-gray-200 text-sm font-medium uppercase tracking-wide">Products</h3>
        <h1 class="text-3xl font-bold text-white">{{ $total_products }}</h1>
        <a href="/admin/products" class="text-blue-300 font-medium text-sm hover:underline">See Details</a>
    </div>
    <div class="relative z-10 bg-white/30 backdrop-blur-lg rounded-xl shadow-xl p-8 w-60 flex flex-col gap-6">
        <h3 class="text-gray-200 text-sm font-medium uppercase tracking-wide">Categories</h3>
        <h1 class="text-3xl font-bold text-white">{{ $total_categories }}</h1>
        <a href="categories" class="text-blue-300 font-medium text-sm hover:underline">See Details</a>
    </div>
    <div class="relative z-10 bg-white/30 backdrop-blur-lg rounded-xl shadow-xl p-8 w-60 flex flex-col gap-6">
        <h3 class="text-gray-200 text-sm font-medium uppercase tracking-wide">Activ Users</h3>
        <h1 class="text-3xl font-bold text-green-700">21</h1>
        <!--<a href="#" class="text-blue-300 font-medium text-sm hover:underline">See Details</a>-->
    </div>

</div>
@endsection

