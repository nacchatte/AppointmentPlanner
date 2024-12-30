<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ], [
            'email.required' => 'Email cannot be empty!.',
            'email.email' => 'Email must be a valid format~.',
            'password.required' => 'Password cannot be empty!.',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $request->session()->put('user_name', $user->name); // Store user's name in the session
            $request->session()->put('user_email', $user->email); // Store user's name in the session
            $request->session()->regenerate();

            return redirect()->intended('/dashboard')->with('success', 'Login Successfully!');
        } else {
            return back()->with('error', 'Your Email or Password is incorrect!');
        }
    }
}
