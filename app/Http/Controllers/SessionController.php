<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginUser(){
        $attributes = request()->validate([
            'username'=> ['required'],
            'password'=> ['required'],
        ]);
        if(!Auth::attempt($attributes)) {
            throw ValidationException::withMessages(['email' => 'Sorry, username or password not correct']);
        }
        request()->session()->regenerate();

        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}

