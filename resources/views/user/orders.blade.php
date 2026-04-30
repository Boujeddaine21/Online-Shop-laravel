@extends('components.layout')

@section('content')
<div class="min-h-screen">
    <h1 class="text-3xl font-bold text-gray-300 mb-6">Meine Bestellungen</h1>

    @if($orders->isEmpty())
        <div class="relative z-10 bg-white/20 backdrop-blur-lg rounded-xl shadow-xl p-10 text-center">
            <p class="text-white text-lg">Du hast noch keine Bestellungen.</p>
            <a href="/shop" class="inline-block mt-4 bg-teal-600 hover:bg-teal-700 text-white px-6 py-2 rounded-lg transition">
                Jetzt einkaufen
            </a>
        </div>
    @else
        <div class="space-y-6">
            @foreach ($orders as $order)
                <div class="relative z-10 bg-white/20 backdrop-blur-lg rounded-xl shadow-xl p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-white font-bold text-lg">{{ $order->order_number }}</h3>
                            <p class="text-gray-300 text-sm">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            @if($order->payment_status === 'pending')
                                <span class="px-3 py-1 text-xs bg-amber-200 text-amber-800 rounded-full font-medium">Ausstehend</span>
                            @elseif($order->payment_status === 'paid')
                                <span class="px-3 py-1 text-xs bg-green-200 text-green-800 rounded-full font-medium">Bezahlt</span>
                            @elseif($order->payment_status === 'shipped')
                                <span class="px-3 py-1 text-xs bg-blue-200 text-blue-800 rounded-full font-medium">Versendet</span>
                            @elseif($order->payment_status === 'cancelled')
                                <span class="px-3 py-1 text-xs bg-red-200 text-red-800 rounded-full font-medium">Storniert</span>
                            @endif
                            <span class="text-white font-bold text-lg">{{ number_format($order->total, 2) }} €</span>
                        </div>
                    </div>

                    <div class="border-t border-white/20 pt-3">
                        <div class="grid grid-cols-3 gap-2 text-sm text-gray-300 font-medium mb-2">
                            <span>Produkt</span>
                            <span class="text-center">Menge</span>
                            <span class="text-right">Preis</span>
                        </div>
                        @foreach ($order->product as $product)
                            <div class="grid grid-cols-3 gap-2 text-sm text-white py-1">
                                <span>{{ $product->name }}</span>
                                <span class="text-center">{{ $product->pivot->quantity }}x</span>
                                <span class="text-right">{{ number_format($product->pivot->total, 2) }} €</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-white/20 pt-3 mt-3 flex justify-between text-sm text-gray-300">
                        <span>Zahlungsart: <b class="text-white">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</b></span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 text-gray-200">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
