@extends('components.layout')

@section('content')
<div class="min-h-screen max-w-4xl mx-auto">
    <div class="relative z-10 bg-white/20 backdrop-blur-lg rounded-xl shadow-xl p-10">
        <h1 class="text-3xl font-bold text-white mb-6 text-center">Über uns</h1>

        <div class="space-y-6 text-white/90">
            <p class="text-lg leading-relaxed">
                Willkommen bei <strong class="text-white">OnlineShop</strong> – deinem modernen Online-Marktplatz
                für Bücher, Tablets, Laptops und Smartphones.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                <div class="bg-white/10 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-3">🎯 Unsere Mission</h3>
                    <p class="text-sm leading-relaxed">
                        Wir bieten hochwertige Produkte zu fairen Preisen mit erstklassigem Kundenservice.
                        Unser Ziel ist es, das Online-Shopping-Erlebnis so einfach und angenehm wie möglich zu gestalten.
                    </p>
                </div>

                <div class="bg-white/10 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-3">🚀 Warum wir?</h3>
                    <p class="text-sm leading-relaxed">
                        Schneller Versand, sichere Bezahlung und eine große Auswahl an Produkten.
                        Über 1.000 zufriedene Kunden vertrauen uns bereits.
                    </p>
                </div>

                <div class="bg-white/10 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-3">📦 Kategorien</h3>
                    <ul class="text-sm space-y-1">
                        <li>📚 Bücher</li>
                        <li>📱 Tablets</li>
                        <li>💻 Laptops</li>
                        <li>📲 Smartphones</li>
                    </ul>
                </div>

                <div class="bg-white/10 rounded-lg p-6">
                    <h3 class="text-xl font-bold text-white mb-3">💡 Technologie</h3>
                    <p class="text-sm leading-relaxed">
                        Gebaut mit Laravel, React und Tailwind CSS.
                        Moderne Technologien für ein schnelles und sicheres Einkaufserlebnis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
