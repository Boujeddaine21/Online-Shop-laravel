@extends('components.layout')

@section('content')
<div class="min-h-screen max-w-2xl mx-auto">
    <div class="relative z-10 bg-white/20 backdrop-blur-lg rounded-xl shadow-xl p-10">
        <h1 class="text-3xl font-bold text-white mb-6 text-center">Kontakt</h1>

        <p class="text-white/80 text-center mb-8">
            Hast du Fragen oder Anregungen? Schreib uns eine Nachricht!
        </p>

        <form class="flex flex-col gap-5">
            <div class="flex flex-col">
                <label class="text-white font-semibold mb-1" for="contact-name">Name</label>
                <input type="text" id="contact-name" name="name" placeholder="Dein Name"
                    class="px-4 py-2 text-black rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-400 bg-white/80">
            </div>

            <div class="flex flex-col">
                <label class="text-white font-semibold mb-1" for="contact-email">E-Mail</label>
                <input type="email" id="contact-email" name="email" placeholder="deine@email.de"
                    class="px-4 py-2 text-black rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-400 bg-white/80">
            </div>

            <div class="flex flex-col">
                <label class="text-white font-semibold mb-1" for="contact-subject">Betreff</label>
                <input type="text" id="contact-subject" name="subject" placeholder="Betreff"
                    class="px-4 py-2 text-black rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-400 bg-white/80">
            </div>

            <div class="flex flex-col">
                <label class="text-white font-semibold mb-1" for="contact-message">Nachricht</label>
                <textarea id="contact-message" name="message" rows="5" placeholder="Deine Nachricht..."
                    class="px-4 py-2 text-black rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-teal-400 bg-white/80 resize-none"></textarea>
            </div>

            <button type="submit"
                class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 rounded-lg transition hover:cursor-pointer">
                Nachricht senden
            </button>
        </form>

        <div class="mt-10 border-t border-white/20 pt-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center text-white/80 text-sm">
                <div>
                    <p class="font-bold text-white mb-1">📧 E-Mail</p>
                    <p>info@onlineshop.de</p>
                </div>
                <div>
                    <p class="font-bold text-white mb-1">📞 Telefon</p>
                    <p>+49 123 456 789</p>
                </div>
                <div>
                    <p class="font-bold text-white mb-1">📍 Adresse</p>
                    <p>Musterstraße 1, Berlin</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
