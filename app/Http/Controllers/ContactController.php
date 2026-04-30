<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        Contact::create($request->only(['name', 'email', 'subject', 'message']));

        return back()->with('contact_success', 'Vielen Dank! Deine Nachricht wurde erfolgreich gesendet.');
    }
}
