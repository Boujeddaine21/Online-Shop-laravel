<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(){
        return view('auth.register');
    }
    public function registerUser(Request $request){
        $attributes = $request->validate([
            "firstname"=> ['required', 'string',],
            "lastname"=> ['required', 'string',],
            "email"=> ["required","email",],
            "password"=> ["required","string", Password::min(10)->letters()->numbers(), 'confirmed'],
        ]);
        $username = $this->generateUsername($request);
        $attributes['username'] = $username;
        
        $user = User::create($attributes);
        $user->assignRole('user');

        return redirect('/login')->with('success','Great, you can now login');
    }

    private function generateUsername($request): string{
        return '2' . substr($request->firstname, 0,1) . $request->lastname;
    }
}
