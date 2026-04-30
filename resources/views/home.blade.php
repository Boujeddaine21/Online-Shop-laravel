@extends('components.layout')

@section('page-title', 'Startseite')

@section('content')
<div class="-mt-8">

    <!-- ========== HERO SECTION ========== -->
    <section class="relative overflow-hidden rounded-2xl mb-16" style="min-height: 420px;">
        <div class="absolute inset-0 bg-gradient-to-br from-teal-600 via-cyan-700 to-slate-800 rounded-2xl"></div>
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 right-10 w-72 h-72 bg-teal-300 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 bg-cyan-400 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 flex flex-col items-center justify-center text-center px-6 py-20">
            <span class="inline-block bg-white/15 text-white text-xs font-semibold px-4 py-1.5 rounded-full mb-6 backdrop-blur-sm">
                🚀 Neu: Kostenloser Versand ab 50€
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 max-w-3xl">
                Entdecke die <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-200 to-cyan-200">besten Produkte</span> für dich
            </h1>
            <p class="text-lg text-white/80 max-w-xl mb-8 leading-relaxed">
                Bücher, Tablets, Laptops und Smartphones – alles an einem Ort, zu fairen Preisen mit schnellem Versand.
            </p>
            @auth
                <a href="/shop" class="inline-flex items-center gap-2 bg-white text-slate-800 font-bold px-8 py-3.5 rounded-full text-base hover:bg-gray-100 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Jetzt einkaufen
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            @else
                <a href="/register" class="inline-flex items-center gap-2 bg-white text-slate-800 font-bold px-8 py-3.5 rounded-full text-base hover:bg-gray-100 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Kostenlos registrieren
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            @endauth
        </div>
    </section>

    <!-- ========== TRUST BADGES ========== -->
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 text-center border border-white/10">
            <div class="text-3xl mb-3">🚚</div>
            <h3 class="text-white font-bold text-sm mb-1">Schneller Versand</h3>
            <p class="text-gray-400 text-xs">Lieferung in 1-3 Werktagen</p>
        </div>
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 text-center border border-white/10">
            <div class="text-3xl mb-3">🔒</div>
            <h3 class="text-white font-bold text-sm mb-1">Sichere Bezahlung</h3>
            <p class="text-gray-400 text-xs">SSL-verschlüsselt & geschützt</p>
        </div>
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 text-center border border-white/10">
            <div class="text-3xl mb-3">💬</div>
            <h3 class="text-white font-bold text-sm mb-1">Top Kundenservice</h3>
            <p class="text-gray-400 text-xs">Mo-Fr 9-18 Uhr erreichbar</p>
        </div>
    </section>

    <!-- ========== KATEGORIEN ========== -->
    <section class="mb-16">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-white">Unsere Kategorien</h2>
            @auth
                <a href="/shop" class="text-teal-400 hover:text-teal-300 text-sm font-medium transition flex items-center gap-1">
                    Alle anzeigen
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            @endauth
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            @foreach ($categories as $categorie)
                <a href="{{ auth()->check() && auth()->user()->hasRole('user') ? '/shop/categorie/'.$categorie->id.'/products' : '/login' }}" class="group">
                    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/10 transition-all duration-300 group-hover:bg-white/20 group-hover:border-teal-400/30 group-hover:-translate-y-1 group-hover:shadow-xl group-hover:shadow-teal-500/10">
                        <div class="w-full h-32 flex items-center justify-center mb-4">
                            <img src="/images/{{ $categorie->description }}" alt="{{ $categorie->name }}" class="object-contain h-full drop-shadow-lg group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <h3 class="text-white font-bold text-center text-base">{{ $categorie->name }}</h3>
                        <p class="text-gray-400 text-center text-xs mt-1">{{ $categorie->product_count }} Produkte</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- ========== FEATURED PRODUCTS ========== -->
    @if($featuredProducts->count() > 0)
    <section class="mb-16">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-white">Neueste Produkte</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($featuredProducts as $product)
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
    </section>
    @endif

    <!-- ========== NEWSLETTER ========== -->
    <section class="mb-8">
        <div class="bg-gradient-to-r from-teal-600/20 to-cyan-600/20 backdrop-blur-md border border-teal-400/20 rounded-2xl p-8 md:p-12 text-center">
            <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Bleib auf dem Laufenden</h2>
            <p class="text-gray-300 text-sm mb-6 max-w-md mx-auto">Erhalte exklusive Angebote und Neuigkeiten direkt in dein Postfach.</p>
            <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" onsubmit="event.preventDefault(); this.querySelector('button').textContent='✓ Angemeldet!';">
                <input type="email" placeholder="deine@email.de"
                    class="flex-1 px-4 py-3 bg-white/10 border border-white/20 rounded-full text-white placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50">
                <button type="submit" class="bg-teal-500 hover:bg-teal-400 text-white font-semibold px-6 py-3 rounded-full text-sm transition hover:cursor-pointer">
                    Abonnieren
                </button>
            </form>
        </div>
    </section>

</div>
@endsection
