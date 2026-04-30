@extends('components.layout')
@section('page-title', 'Impressum')
@section('content')
<div class="min-h-screen max-w-3xl mx-auto">
    <div class="bg-white/10 backdrop-blur-md rounded-xl p-8 border border-white/10">
        <h1 class="text-3xl font-bold text-white mb-6">Impressum</h1>
        <div class="space-y-6 text-gray-300 text-sm leading-relaxed">
            <section>
                <h2 class="text-lg font-bold text-white mb-2">Angaben gemäß §5 TMG</h2>
                <p>OnlineShop GmbH<br>Musterstraße 1<br>10115 Berlin<br>Deutschland</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">Kontakt</h2>
                <p>Telefon: +49 123 456 789<br>E-Mail: info@onlineshop.de</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">Handelsregister</h2>
                <p>Registergericht: Amtsgericht Berlin<br>Registernummer: HRB 12345</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">Geschäftsführung</h2>
                <p>Max Mustermann</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">Umsatzsteuer-ID</h2>
                <p>USt-IdNr.: DE123456789</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">Streitschlichtung</h2>
                <p>Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit. Wir sind nicht verpflichtet und nicht bereit, an einem Streitbeilegungsverfahren teilzunehmen.</p>
            </section>
        </div>
    </div>
</div>
@endsection
