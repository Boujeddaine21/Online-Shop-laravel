@extends('components.layout')

@section('register')
    <x-form-style action="/register" method="POST">
        @csrf
        <h2 class="text-2xl font-bold text-white text-center">Registration</h2>

        <div class="flex flex-col">
            <x-label-form for="firstname">Firstname</x-label-form>
            <x-input-form type="text" id="firstname" name="firstname"></x-input-form>
            @error('firstname')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>

        <div class="flex flex-col">
            <x-label-form for="lastname">Lastname</x-label-form>
            <x-input-form type="text" id="lastname" name="lastname"></x-input-form>
            @error('lastname')
                <p class="text-xs text-red-400 font-semibold"><i>{{ $message }}</i></p>
            @enderror
        </div>

        <div class="flex flex-col">
            <x-label-form for="email">Email</x-label-form>
            <x-input-form type="email" id="email" name="email"></x-input-form>
            @error('email')
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

        <div class="flex flex-col">
            <x-label-form for="password_confirmation">Confirm Password</x-label-form>
            <x-input-form type="password" id="password_confirmation" name="password_confirmation"></x-input-form>
        </div>

        <x-button-form>Register</x-button-form>

        <p class="text-xs text-white text-center">
            you alread registred ? <a href="/login" class="underline text-blue-400">Login</a>
        </p>
    </x-form-style>
@endsection
