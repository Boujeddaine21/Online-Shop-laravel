@extends('components.layout')

@section('page-title', 'Wunschliste')

@section('content')
<div class="min-h-screen">
    <h1 class="text-3xl font-bold text-white mb-2">❤️ Meine Wunschliste</h1>
    <p class="text-gray-400 mb-8">{{ $products->count() }} Produkt{{ $products->count() !== 1 ? 'e' : '' }}</p>

    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden relative group">
                    <form action="/wishlist/toggle" method="POST" class="absolute top-3 right-3 z-10">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="bg-white/90 hover:bg-red-50 p-2 rounded-full shadow transition hover:cursor-pointer">
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </form>
                    <a href="/product/{{ $product->id }}">
                        <div class="w-full h-44 flex items-center justify-center bg-gray-50 p-4">
                            <img src="/images/{{ $product->image }}" alt="{{ $product->name }}" class="object-contain h-full group-hover:scale-105 transition-transform duration-300">
                        </div>
                    </a>
                    <div class="p-4">
                        <a href="/product/{{ $product->id }}"><h3 class="font-semibold text-gray-800 text-sm truncate hover:text-teal-600 transition">{{ $product->name }}</h3></a>
                        <div class="flex items-center justify-between mt-3">
                            <span class="text-lg font-bold text-teal-600">{{ number_format($product->price, 2) }} €</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-12 text-center border border-white/10">
            <div class="text-5xl mb-4">💔</div>
            <h3 class="text-xl font-bold text-white mb-2">Deine Wunschliste ist leer</h3>
            <p class="text-gray-400 mb-6">Stöbere im Shop und füge Produkte hinzu!</p>
            <a href="/shop" class="inline-block bg-teal-600 hover:bg-teal-500 text-white px-6 py-2 rounded-lg transition font-medium text-sm">Zum Shop</a>
        </div>
    @endif
</div>
@endsection
