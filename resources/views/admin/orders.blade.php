@extends('components.layout')

@section('login')
    <div class="p-2">
        <h1 class="text-3xl font-bold text-gray-300 mb-6">All Orders</h1>

        <div class="min-h-screen">
            <div class="overflow-x-auto rounded-xl shadow">
                <table class="min-w-full bg-white text-gray-900">
                    <thead class="bg-gray-100 border-b border-gray-300">
                        <tr class="">
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Order-ID</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Order-Number</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Name</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Address</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Products</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Total</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Payment Method</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-center border-b hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 font-medium text-gray-700">{{ $order->id }}</td>
                                <td class="px-4 py-3">{{ $order->order_number }}</td>
                                <td class="px-4 py-3">{{ $order->user->firstname }} {{ $order->user->lastname }}</td>
                                <td class="px-4 py-3">##</td>
                                <td class="px-4 py-3">
                                    <div class="text-left">
                                        @foreach ($order->product as $product)
                                            <p class="text-sm text-gray-600 ml-5">{{ $product->name }}, {{ $product->price }}€ x
                                                {{ $product->pivot->quantity }} = {{ $product->pivot->total }}€</p>
                                        @endforeach
                                    </div>

                                </td>
                                <td class="px-4 py-3">{{ $order->total }}€</td>
                                <td class="px-4 py-3">{{ $order->payment_method }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                {{ $orders->links() }}
            </div>
        </div>
    @endsection
