@extends('components.layout')

@section('login')
    @if (session('success'))
        <div id="flash-message"
            class="max-w-md mx-auto mt-4 mb-4 p-4 w-96 rounded-lg backdrop-blur-lg bg-green-100 text-green-800 shadow-lg flex justify-between items-center">
            <span>{{ session('success') }}</span>
        </div>

        <script>
            setTimeout(() => {
                const msg = document.getElementById('flash-message');
                if (msg) {
                    msg.remove();
                }
            }, 5000);
        </script>
    @endif
    <x-form-style action="/login" method="POST">
        @csrf
        <h2 class="text-2xl font-bold text-white text-center">Login</h2>

        <div class="flex flex-col">
            <x-label-form for="username">Username</x-label-form>
            <x-input-form type="text" id="username" name="username"></x-input-form>
            @error('username')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>

        <div class="flex flex-col">
            <x-label-form for="password"> Password</x-label-form>
            <x-input-form type="password" id="password" name="password"></x-input-form>
            @error('password')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>
        @error('email')
            <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
        @enderror

        <x-button-form>Log In</x-button-form>

        <p class="text-xs text-white text-center">
            Don't have an account? <a href="/register" class="underline text-blue-400">Register</a>
        </p>
    </x-form-style>
@endsection
