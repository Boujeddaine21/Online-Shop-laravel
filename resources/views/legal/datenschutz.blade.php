@extends('components.layout')
@section('page-title', 'Datenschutz')
@section('content')
<div class="min-h-screen max-w-3xl mx-auto">
    <div class="bg-white/10 backdrop-blur-md rounded-xl p-8 border border-white/10">
        <h1 class="text-3xl font-bold text-white mb-6">Datenschutzerklärung</h1>
        <div class="space-y-6 text-gray-300 text-sm leading-relaxed">
            <section>
                <h2 class="text-lg font-bold text-white mb-2">1. Verantwortlicher</h2>
                <p>Verantwortlich für die Datenverarbeitung ist: OnlineShop GmbH, Musterstraße 1, 10115 Berlin. E-Mail: datenschutz@onlineshop.de</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">2. Erhobene Daten</h2>
                <p>Wir erheben personenbezogene Daten nur dann, wenn Sie uns diese freiwillig mitteilen: Name, E-Mail, Lieferadresse und Zahlungsinformationen bei einer Bestellung.</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">3. Verwendungszweck</h2>
                <p>Die erhobenen Daten werden ausschließlich zur Abwicklung Ihrer Bestellung, Kontaktaufnahme und zur Verbesserung unseres Angebots verwendet.</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">4. Cookies</h2>
                <p>Unsere Website verwendet Cookies für die Session-Verwaltung. Diese sind für den Betrieb der Website technisch notwendig.</p>
            </section>
            <section>
                <h2 class="text-lg font-bold text-white mb-2">5. Ihre Rechte</h2>
                <p>Sie haben das Recht auf Auskunft, Berichtigung, Löschung und Einschränkung der Verarbeitung Ihrer Daten gemäß DSGVO.</p>
            </section>
        </div>
    </div>
</div>
@endsection
