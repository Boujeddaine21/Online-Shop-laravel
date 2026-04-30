@extends('components.layout')

@section('page-title', $product->name)

@section('content')
<div class="min-h-screen">

    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-sm text-gray-400 mb-8">
        <a href="/" class="hover:text-white transition">Home</a>
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        @if($product->categorie)
            @auth
                @role('user')
                    <a href="/shop/categorie/{{ $product->categorie_id }}/products" class="hover:text-white transition">{{ $product->categorie->name }}</a>
                @else
                    <span>{{ $product->categorie->name }}</span>
                @endrole
            @else
                <span>{{ $product->categorie->name }}</span>
            @endauth
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        @endif
        <span class="text-gray-300">{{ $product->name }}</span>
    </nav>

    <!-- Product Detail -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-16">

        <!-- Product Image -->
        <div class="bg-white rounded-2xl shadow-lg p-8 flex items-center justify-center" style="min-height:350px;">
            <img src="/images/{{ $product->image }}" alt="{{ $product->name }}" class="object-contain max-h-80 drop-shadow-lg">
        </div>

        <!-- Product Info -->
        <div class="flex flex-col justify-center">
            <span class="text-teal-400 text-sm font-semibold mb-2">
                {{ $product->categorie ? $product->categorie->name : 'Produkt' }}
            </span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-4 leading-tight">{{ $product->name }}</h1>
            <p class="text-gray-300 leading-relaxed mb-6">{{ $product->description }}</p>

            <!-- Price & Availability -->
            <div class="flex items-center gap-4 mb-6">
                <span class="text-4xl font-extrabold text-teal-400">{{ number_format($product->price, 2) }} €</span>
                @if($product->quantity > 0)
                    <span class="bg-green-500/20 text-green-400 text-xs font-semibold px-3 py-1 rounded-full">✓ Auf Lager ({{ $product->quantity }})</span>
                @else
                    <span class="bg-red-500/20 text-red-400 text-xs font-semibold px-3 py-1 rounded-full">Ausverkauft</span>
                @endif
            </div>

            <!-- Lieferzeit -->
            <div class="bg-white/5 border border-white/10 rounded-xl p-4 mb-6">
                <div class="flex items-center gap-3 text-sm text-gray-300">
                    <span class="text-lg">🚚</span>
                    <div>
                        <p class="font-medium text-white">Kostenloser Versand ab 50€</p>
                        <p class="text-xs text-gray-400">Lieferung in 1-3 Werktagen</p>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            @auth
                @role('user')
                <div class="flex gap-3">
                    <button id="add-to-cart-btn"
                        class="flex-1 bg-teal-600 hover:bg-teal-500 text-white font-bold py-3.5 px-6 rounded-xl transition flex items-center justify-center gap-2 hover:cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed"
                        {{ $product->quantity < 1 ? 'disabled' : '' }}
                        onclick="addToCartDetail({{ $product->id }})">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                        </svg>
                        In den Warenkorb
                    </button>
                    <button id="wishlist-btn"
                        class="bg-white/10 hover:bg-white/20 border border-white/15 text-white p-3.5 rounded-xl transition hover:cursor-pointer"
                        onclick="toggleWishlist({{ $product->id }})">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </button>
                </div>
                <p id="cart-feedback" class="text-sm mt-3 font-medium hidden"></p>
                @endrole
            @else
                <a href="/login" class="bg-teal-600 hover:bg-teal-500 text-white font-bold py-3.5 px-6 rounded-xl transition text-center">
                    Anmelden zum Kaufen
                </a>
            @endauth
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section>
        <h2 class="text-2xl font-bold text-white mb-6">Ähnliche Produkte</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach ($relatedProducts as $related)
                <a href="/product/{{ $related->id }}" class="group">
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group-hover:-translate-y-1">
                        <div class="w-full h-36 flex items-center justify-center bg-gray-50 p-4">
                            <img src="/images/{{ $related->image }}" alt="{{ $related->name }}" class="object-contain h-full group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-800 text-sm truncate">{{ $related->name }}</h3>
                            <span class="text-lg font-bold text-teal-600">{{ number_format($related->price, 2) }} €</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

</div>

@auth
@role('user')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    async function addToCartDetail(productId) {
        const btn = document.getElementById('add-to-cart-btn');
        const feedback = document.getElementById('cart-feedback');
        btn.disabled = true;
        btn.textContent = 'Wird hinzugefügt...';

        try {
            const res = await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ product_id: productId }),
            });

            const data = await res.json();

            if (res.ok) {
                feedback.textContent = '✓ Zum Warenkorb hinzugefügt!';
                feedback.className = 'text-sm mt-3 font-medium text-green-400';
                feedback.classList.remove('hidden');
                btn.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Hinzugefügt!`;
                // Update cart badge
                const badge = document.querySelector('.cart-badge');
                if (badge) {
                    badge.textContent = parseInt(badge.textContent) + 1;
                }
            } else {
                feedback.textContent = data.error || 'Fehler beim Hinzufügen';
                feedback.className = 'text-sm mt-3 font-medium text-red-400';
                feedback.classList.remove('hidden');
            }
        } catch (err) {
            feedback.textContent = 'Netzwerkfehler';
            feedback.className = 'text-sm mt-3 font-medium text-red-400';
            feedback.classList.remove('hidden');
        }

        setTimeout(() => {
            btn.disabled = false;
            btn.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg> In den Warenkorb`;
        }, 2000);
    }

    async function toggleWishlist(productId) {
        try {
            const res = await fetch('/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ product_id: productId }),
            });
            const data = await res.json();
            const btn = document.getElementById('wishlist-btn');
            if (data.status === 'added') {
                btn.innerHTML = `<svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>`;
            } else {
                btn.innerHTML = `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>`;
            }
        } catch (err) {
            console.error('Wishlist error:', err);
        }
    }
</script>
@endrole
@endauth
@endsection
