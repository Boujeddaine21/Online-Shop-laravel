@extends('components.layout')

@section('page-title', 'Suche: ' . $query)

@section('content')
<div class="min-h-screen">

    <!-- Search Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">Suchergebnisse</h1>
        @if($query)
            <p class="text-gray-400">
                {{ $products->count() }} Ergebnis{{ $products->count() !== 1 ? 'se' : '' }} für
                <span class="text-teal-400 font-semibold">"{{ $query }}"</span>
            </p>
        @else
            <p class="text-gray-400">Bitte gib einen Suchbegriff ein.</p>
        @endif
    </div>

    <!-- Search Bar -->
    <form action="/search" method="GET" class="mb-10">
        <div class="relative max-w-xl">
            <input type="text" name="q" value="{{ $query }}" placeholder="Produkte suchen..."
                class="w-full px-5 py-3 pl-12 bg-white/10 border border-white/15 rounded-xl text-white placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50 focus:bg-white/15 transition">
            <svg class="absolute left-4 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </form>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <a href="/product/{{ $product->id }}" class="group">
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group-hover:-translate-y-1">
                        <div class="w-full h-44 flex items-center justify-center bg-gray-50 p-4">
                            <img src="/images/{{ $product->image }}" alt="{{ $product->name }}" class="object-contain h-full group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 text-sm truncate">{{ $product->name }}</h3>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $product->description }}</p>
                            <div class="flex items-center justify-between mt-3">
                                <span class="text-lg font-bold text-teal-600">{{ number_format($product->price, 2) }} €</span>
                                @if($product->quantity > 0)
                                    <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full font-medium">Verfügbar</span>
                                @else
                                    <span class="text-xs text-red-600 bg-red-50 px-2 py-0.5 rounded-full font-medium">Ausverkauft</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @elseif($query)
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-12 text-center border border-white/10">
            <div class="text-5xl mb-4">🔍</div>
            <h3 class="text-xl font-bold text-white mb-2">Keine Ergebnisse gefunden</h3>
            <p class="text-gray-400 mb-6">Versuche es mit einem anderen Suchbegriff.</p>
            <a href="/shop" class="inline-block bg-teal-600 hover:bg-teal-500 text-white px-6 py-2 rounded-lg transition font-medium text-sm">
                Zum Shop
            </a>
        </div>
    @endif

</div>
@endsection
