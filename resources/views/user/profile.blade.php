@extends('components.layout')

@section('page-title', 'Mein Profil')

@section('content')
<div class="min-h-screen max-w-3xl mx-auto">
    <h1 class="text-3xl font-bold text-white mb-8">👤 Mein Profil</h1>

    @if(session('success'))
        <div class="bg-green-500/20 border border-green-400/30 text-green-300 px-4 py-3 rounded-xl mb-6 text-sm">{{ session('success') }}</div>
    @endif
    @if(session('password_success'))
        <div class="bg-green-500/20 border border-green-400/30 text-green-300 px-4 py-3 rounded-xl mb-6 text-sm">{{ session('password_success') }}</div>
    @endif

    <!-- Personal Data -->
    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/10 mb-6">
        <h2 class="text-lg font-bold text-white mb-4">Persönliche Daten</h2>
        <form action="/profile" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="text-gray-300 text-sm font-medium mb-1 block">Vorname</label>
                    <input type="text" name="firstname" value="{{ old('firstname', $user->firstname) }}"
                        class="w-full px-4 py-2 bg-white/10 border border-white/15 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50">
                    @error('firstname')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="text-gray-300 text-sm font-medium mb-1 block">Nachname</label>
                    <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                        class="w-full px-4 py-2 bg-white/10 border border-white/15 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50">
                    @error('lastname')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            <div class="mb-4">
                <label class="text-gray-300 text-sm font-medium mb-1 block">E-Mail</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 bg-white/10 border border-white/15 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50">
                @error('email')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="mb-4">
                <label class="text-gray-300 text-sm font-medium mb-1 block">Username</label>
                <input type="text" value="{{ $user->username }}" disabled
                    class="w-full px-4 py-2 bg-white/5 border border-white/10 rounded-lg text-gray-400 text-sm cursor-not-allowed">
            </div>
            <button type="submit" class="bg-teal-600 hover:bg-teal-500 text-white font-medium px-6 py-2 rounded-lg transition text-sm hover:cursor-pointer">Speichern</button>
        </form>
    </div>

    <!-- Change Password -->
    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/10 mb-6">
        <h2 class="text-lg font-bold text-white mb-4">Passwort ändern</h2>
        <form action="/profile/password" method="POST">
            @csrf
            @method('PATCH')
            <div class="space-y-4 mb-4">
                <div>
                    <label class="text-gray-300 text-sm font-medium mb-1 block">Aktuelles Passwort</label>
                    <input type="password" name="current_password"
                        class="w-full px-4 py-2 bg-white/10 border border-white/15 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50">
                    @error('current_password')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="text-gray-300 text-sm font-medium mb-1 block">Neues Passwort</label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 bg-white/10 border border-white/15 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50">
                    @error('password')<p class="text-xs text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="text-gray-300 text-sm font-medium mb-1 block">Passwort bestätigen</label>
                    <input type="password" name="password_confirmation"
                        class="w-full px-4 py-2 bg-white/10 border border-white/15 rounded-lg text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-400/50">
                </div>
            </div>
            <button type="submit" class="bg-teal-600 hover:bg-teal-500 text-white font-medium px-6 py-2 rounded-lg transition text-sm hover:cursor-pointer">Passwort ändern</button>
        </form>
    </div>

    <!-- Recent Orders -->
    @if($recentOrders->count() > 0)
    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-bold text-white">Letzte Bestellungen</h2>
            <a href="/my-orders" class="text-teal-400 hover:text-teal-300 text-sm font-medium transition">Alle anzeigen →</a>
        </div>
        <div class="space-y-3">
            @foreach ($recentOrders as $order)
                <div class="flex justify-between items-center bg-white/5 rounded-lg p-3">
                    <div>
                        <p class="text-white text-sm font-medium">{{ $order->order_number }}</p>
                        <p class="text-gray-400 text-xs">{{ $order->created_at->format('d.m.Y') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-white font-bold text-sm">{{ number_format($order->total, 2) }} €</p>
                        @if($order->payment_status === 'pending')
                            <span class="text-xs text-amber-400">Ausstehend</span>
                        @elseif($order->payment_status === 'paid')
                            <span class="text-xs text-green-400">Bezahlt</span>
                        @elseif($order->payment_status === 'shipped')
                            <span class="text-xs text-blue-400">Versendet</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
