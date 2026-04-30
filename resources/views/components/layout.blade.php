<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="OnlineShop – Dein moderner Marktplatz für Bücher, Tablets, Laptops und Smartphones.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>OnlineShop – @yield('page-title', 'Dein moderner Online-Marktplatz')</title>
    <style>
        body { font-family: 'Inter', ui-sans-serif, system-ui, sans-serif; }

        /* Sticky Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            background: rgba(15, 23, 42, 0.85);
            border-bottom: 1px solid rgba(255,255,255,0.08);
            transition: box-shadow 0.3s ease;
        }
        .navbar.scrolled {
            box-shadow: 0 4px 30px rgba(0,0,0,0.3);
        }

        /* Mobile Menu */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }
        .mobile-menu.open {
            max-height: 600px;
        }

        /* Search Dropdown */
        .search-results {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-height: 320px;
            overflow-y: auto;
            z-index: 100;
        }
        .search-result-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 16px;
            color: #1e293b;
            text-decoration: none;
            transition: background 0.15s;
        }
        .search-result-item:hover {
            background: #f1f5f9;
        }

        /* Cart badge */
        .cart-badge {
            position: absolute;
            top: -6px;
            right: -8px;
            background: #ef4444;
            color: white;
            font-size: 10px;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        /* Hamburger */
        .hamburger-line {
            display: block;
            width: 24px;
            height: 2px;
            background: white;
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        .hamburger.active .hamburger-line:nth-child(1) { transform: translateY(8px) rotate(45deg); }
        .hamburger.active .hamburger-line:nth-child(2) { opacity: 0; }
        .hamburger.active .hamburger-line:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

        /* Footer */
        footer {
            background: linear-gradient(180deg, rgba(15,23,42,0.95) 0%, rgba(2,6,23,1) 100%);
            border-top: 1px solid rgba(255,255,255,0.06);
        }
        .footer-link {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s;
        }
        .footer-link:hover { color: #e2e8f0; }

        /* Nav links */
        .nav-link {
            position: relative;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.5rem 0;
            transition: color 0.2s;
        }
        .nav-link:hover { color: white; }
        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #14b8a6, #06b6d4);
            border-radius: 1px;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }
    </style>
</head>

<body class="relative min-h-screen flex flex-col">

    <div class="fixed inset-0 -z-10">
        <img src="/images/bg.jpg" alt="Hintergrund" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-900/40 via-slate-900/20 to-slate-900/60"></div>
    </div>

    <!-- ========== NAVBAR ========== -->
    <nav class="navbar" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center gap-2">
                        <img class="h-8" src="/images/logo.png" alt="OnlineShop Logo">
                        <span class="text-white font-bold text-lg hidden sm:block tracking-tight">OnlineShop</span>
                    </a>
                </div>

                <!-- Search Bar (Desktop) -->
                <div class="hidden md:flex flex-1 max-w-md mx-8 relative" id="search-container">
                    <form action="/search" method="GET" class="w-full">
                        <div class="relative">
                            <input type="text" name="q" id="search-input" placeholder="Produkte suchen..."
                                autocomplete="off"
                                class="w-full px-4 py-2 pl-10 bg-white/10 border border-white/15 rounded-full text-white placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50 focus:bg-white/15 transition">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </form>
                    <div id="search-results" class="search-results hidden"></div>
                </div>

                <!-- Nav Links (Desktop) -->
                <div class="hidden md:flex items-center gap-6">
                    @role('admin')
                        <a href="/admin/dashboard" class="nav-link">Dashboard</a>
                        <a href="/admin/products" class="nav-link">Products</a>
                        <a href="/admin/orders" class="nav-link">Orders</a>
                    @endrole
                    @role('user')
                        <a href="/shop" class="nav-link">Shop</a>
                        <a href="/my-orders" class="nav-link">Bestellungen</a>
                    @endrole
                    <a href="/about" class="nav-link">Über uns</a>
                    <a href="/contact" class="nav-link">Kontakt</a>
                </div>

                <!-- Right Side: Cart + Auth -->
                <div class="hidden md:flex items-center gap-4">
                    @role('user')
                        <!-- Wishlist -->
                        <a href="/wishlist" class="text-gray-300 hover:text-red-400 transition" title="Wunschliste">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </a>
                        <!-- Cart -->
                        <a href="/shop" class="relative text-gray-300 hover:text-teal-400 transition" title="Warenkorb">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                            @php
                                $cartCount = 0;
                                if (auth()->check() && auth()->user()->cart) {
                                    $cartCount = auth()->user()->cart->products()->sum('cart_product.quantity');
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span class="cart-badge">{{ $cartCount > 99 ? '99+' : $cartCount }}</span>
                            @endif
                        </a>
                    @endrole

                    @guest
                        <a href="/login" class="text-sm text-gray-300 hover:text-white transition font-medium">Login</a>
                        <a href="/register" class="text-sm bg-teal-600 hover:bg-teal-500 text-white px-4 py-1.5 rounded-full transition font-medium">Register</a>
                    @endguest
                    @auth
                        <a href="{{ auth()->user()->hasRole('admin') ? '/admin/dashboard' : '/profile' }}" class="text-sm text-gray-300 hover:text-white transition">
                            {{ Auth::user()->firstname }}
                        </a>
                        <form action="/logout" method="POST" class="inline">
                            @csrf
                            <button class="text-sm text-gray-400 hover:text-red-400 transition hover:cursor-pointer">Logout</button>
                        </form>
                    @endauth
                </div>

                <!-- Hamburger (Mobile) -->
                <button class="md:hidden hamburger flex flex-col gap-1.5 p-2" id="hamburger-btn" aria-label="Menü öffnen">
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                    <span class="hamburger-line"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden mobile-menu" id="mobile-menu">
            <div class="px-4 pb-4 space-y-2">
                <!-- Mobile Search -->
                <form action="/search" method="GET" class="mb-3">
                    <input type="text" name="q" placeholder="Suchen..."
                        class="w-full px-4 py-2 bg-white/10 border border-white/15 rounded-lg text-white placeholder-gray-400 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50">
                </form>

                @role('admin')
                    <a href="/admin/dashboard" class="block text-gray-300 hover:text-white py-2 text-sm">Dashboard</a>
                    <a href="/admin/products" class="block text-gray-300 hover:text-white py-2 text-sm">Products</a>
                    <a href="/admin/orders" class="block text-gray-300 hover:text-white py-2 text-sm">Orders</a>
                @endrole
                @role('user')
                    <a href="/shop" class="block text-gray-300 hover:text-white py-2 text-sm">Shop</a>
                    <a href="/my-orders" class="block text-gray-300 hover:text-white py-2 text-sm">Bestellungen</a>
                    <a href="/wishlist" class="block text-gray-300 hover:text-white py-2 text-sm">❤️ Wunschliste</a>
                    <a href="/profile" class="block text-gray-300 hover:text-white py-2 text-sm">👤 Profil</a>
                @endrole
                <a href="/about" class="block text-gray-300 hover:text-white py-2 text-sm">Über uns</a>
                <a href="/contact" class="block text-gray-300 hover:text-white py-2 text-sm">Kontakt</a>

                <div class="border-t border-white/10 pt-3 mt-2">
                    @guest
                        <a href="/login" class="block text-gray-300 hover:text-white py-2 text-sm">Login</a>
                        <a href="/register" class="block text-teal-400 hover:text-teal-300 py-2 text-sm font-medium">Register</a>
                    @endguest
                    @auth
                        <span class="block text-gray-400 py-1 text-sm">{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</span>
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="text-red-400 hover:text-red-300 py-2 text-sm hover:cursor-pointer">Logout</button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- ========== MAIN CONTENT ========== -->
    <div class="relative z-10 flex-1">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="mb-10">@yield('login')</div>
            <div class="mb-10">@yield('register')</div>
            <div class="mb-10">@yield('create-product')</div>
            <div class="mb-10">@yield('dashboard')</div>
            <div class="mb-10">@yield('categories')</div>
            <div class="mb-10">@yield('content')</div>

            <main class="mb-10">
                @yield('admin-all-products')
            </main>
        </div>
    </div>

    <!-- ========== FOOTER ========== -->
    <footer class="mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div>
                    <a href="/" class="flex items-center gap-2 mb-4">
                        <img class="h-7" src="/images/logo.png" alt="Logo">
                        <span class="text-white font-bold text-lg">OnlineShop</span>
                    </a>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Dein moderner Online-Marktplatz für Bücher, Tablets, Laptops und Smartphones. Qualität zu fairen Preisen.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Shop</h4>
                    <ul class="space-y-2">
                        @auth
                            @role('user')
                                <li><a href="/shop" class="footer-link">Alle Kategorien</a></li>
                                <li><a href="/my-orders" class="footer-link">Meine Bestellungen</a></li>
                                <li><a href="/wishlist" class="footer-link">Wunschliste</a></li>
                                <li><a href="/profile" class="footer-link">Mein Profil</a></li>
                            @endrole
                        @endauth
                        @guest
                            <li><a href="/login" class="footer-link">Anmelden</a></li>
                            <li><a href="/register" class="footer-link">Registrieren</a></li>
                        @endguest
                    </ul>
                </div>

                <!-- Info -->
                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Informationen</h4>
                    <ul class="space-y-2">
                        <li><a href="/about" class="footer-link">Über uns</a></li>
                        <li><a href="/contact" class="footer-link">Kontakt</a></li>
                        <li><a href="/agb" class="footer-link">AGB</a></li>
                        <li><a href="/datenschutz" class="footer-link">Datenschutz</a></li>
                        <li><a href="/impressum" class="footer-link">Impressum</a></li>
                    </ul>
                </div>

                <!-- Contact & Payment -->
                <div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Kontakt</h4>
                    <div class="space-y-2 text-sm text-gray-400">
                        <p>📧 info@onlineshop.de</p>
                        <p>📞 +49 123 456 789</p>
                        <p>📍 Musterstraße 1, Berlin</p>
                    </div>
                    <h4 class="text-white font-semibold text-sm uppercase tracking-wider mt-6 mb-3">Zahlungsarten</h4>
                    <div class="flex gap-2 text-2xl">
                        <span title="PayPal">💳</span>
                        <span title="Kreditkarte">💳</span>
                        <span title="Überweisung">🏦</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-white/10 mt-10 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-xs">© {{ date('Y') }} OnlineShop. Alle Rechte vorbehalten.</p>
                <div class="flex gap-4">
                    <a href="/agb" class="text-gray-500 hover:text-gray-300 text-xs transition">AGB</a>
                    <a href="/datenschutz" class="text-gray-500 hover:text-gray-300 text-xs transition">Datenschutz</a>
                    <a href="/impressum" class="text-gray-500 hover:text-gray-300 text-xs transition">Impressum</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ========== SCRIPTS ========== -->
    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 20);
        });

        // Mobile menu toggle
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', () => {
                hamburgerBtn.classList.toggle('active');
                mobileMenu.classList.toggle('open');
            });
        }

        // Live Search
        const searchInput = document.getElementById('search-input');
        const searchResultsDiv = document.getElementById('search-results');
        let searchTimeout;

        if (searchInput && searchResultsDiv) {
            searchInput.addEventListener('input', (e) => {
                clearTimeout(searchTimeout);
                const query = e.target.value.trim();

                if (query.length < 2) {
                    searchResultsDiv.classList.add('hidden');
                    searchResultsDiv.innerHTML = '';
                    return;
                }

                searchTimeout = setTimeout(async () => {
                    try {
                        const res = await fetch(`/search?q=${encodeURIComponent(query)}`, {
                            headers: { 'Accept': 'application/json' }
                        });
                        if (res.ok) {
                            const data = await res.json();
                            if (data.products && data.products.length > 0) {
                                searchResultsDiv.innerHTML = data.products.map(p =>
                                    `<a href="/product/${p.id}" class="search-result-item">
                                        <img src="/images/${p.image}" alt="${p.name}" class="w-10 h-10 object-contain rounded">
                                        <div class="flex-1">
                                            <p class="text-sm font-medium">${p.name}</p>
                                            <p class="text-xs text-teal-600 font-bold">${parseFloat(p.price).toFixed(2)} €</p>
                                        </div>
                                    </a>`
                                ).join('');
                                searchResultsDiv.classList.remove('hidden');
                            } else {
                                searchResultsDiv.innerHTML = '<p class="p-4 text-gray-500 text-sm">Keine Ergebnisse gefunden</p>';
                                searchResultsDiv.classList.remove('hidden');
                            }
                        }
                    } catch (err) {
                        console.error('Search error:', err);
                    }
                }, 300);
            });

            // Close search on click outside
            document.addEventListener('click', (e) => {
                if (!e.target.closest('#search-container')) {
                    searchResultsDiv.classList.add('hidden');
                }
            });
        }
    </script>
</body>

</html>
