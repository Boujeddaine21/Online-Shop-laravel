<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $recentOrders = $user->order()->with('product')->latest()->take(3)->get();

        return view('user.profile', [
            'user' => $user,
            'recentOrders' => $recentOrders,
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $attributes = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($attributes);

        return back()->with('success', 'Profil erfolgreich aktualisiert!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'string', Password::min(10)->letters()->numbers(), 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Das aktuelle Passwort ist falsch.']);
        }

        $user->update([
            'password' => $request->password,
        ]);

        return back()->with('password_success', 'Passwort erfolgreich geändert!');
    }
}
