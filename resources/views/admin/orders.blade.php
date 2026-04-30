@extends('components.layout')

@section('login')
    <div class="p-2">
        <h1 class="text-3xl font-bold text-gray-300 mb-6">All Orders</h1>

        @if(session('statusUpdated'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('statusUpdated') }}
            </div>
        @endif

        <div class="min-h-screen">
            <div class="overflow-x-auto rounded-xl shadow">
                <table class="min-w-full bg-white text-gray-900">
                    <thead class="bg-gray-100 border-b border-gray-300">
                        <tr class="">
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Order-ID</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Order-Number</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Name</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Products</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Total</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Payment</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Status</th>
                            <th class="text-center px-4 py-3 text-gray-700 font-medium text-sm">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($orders as $order)
                            <tr class="text-center border-b hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-4 py-3 font-medium text-gray-700">{{ $order->id }}</td>
                                <td class="px-4 py-3 text-sm font-mono">{{ $order->order_number }}</td>
                                <td class="px-4 py-3">{{ $order->user->firstname }} {{ $order->user->lastname }}</td>
                                <td class="px-4 py-3">
                                    <div class="text-left">
                                        @foreach ($order->product as $product)
                                            <p class="text-sm text-gray-600 ml-5">{{ $product->name }}, {{ $product->price }}€ x
                                                {{ $product->pivot->quantity }} = {{ $product->pivot->total }}€</p>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-bold">{{ number_format($order->total, 2) }}€</td>
                                <td class="px-4 py-3 text-sm">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                                <td class="px-4 py-3">
                                    @if($order->payment_status === 'pending')
                                        <span class="px-3 py-1 text-xs bg-amber-200 text-amber-800 rounded-full font-medium">Pending</span>
                                    @elseif($order->payment_status === 'paid')
                                        <span class="px-3 py-1 text-xs bg-green-200 text-green-800 rounded-full font-medium">Paid</span>
                                    @elseif($order->payment_status === 'shipped')
                                        <span class="px-3 py-1 text-xs bg-blue-200 text-blue-800 rounded-full font-medium">Shipped</span>
                                    @elseif($order->payment_status === 'cancelled')
                                        <span class="px-3 py-1 text-xs bg-red-200 text-red-800 rounded-full font-medium">Cancelled</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <form action="/admin/orders/{{ $order->id }}/status" method="POST" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="payment_status"
                                            class="text-xs border border-gray-300 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-teal-400">
                                            <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="shipped" {{ $order->payment_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                                            <option value="cancelled" {{ $order->payment_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit"
                                            class="px-2 py-1 text-xs bg-teal-500 text-white rounded hover:bg-teal-600 hover:cursor-pointer transition">
                                            Update
                                        </button>
                                    </form>
                                </td>
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
