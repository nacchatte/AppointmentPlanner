<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|string|unique:users',
            'hp'=> 'required',
            'password'=> 'required|string|min:6'
        ]);

        $user = new User([
            'name'=> $request->name,
            'email'=> $request->email,
            'hp'=> $request->hp,
            'password'=> Hash::make($request->password)
        ]);

        $user->save();
        return response()->json(['message' => 'User has been registered',200]);
    }

    public function login(Request $request)
    {
       $credentials = $request->validate([
        'email' =>'required|email:dns',
        'password' => 'required',
       ], [
        'email.required' => 'Email cannot be empty!',
        'password.required' => 'Email cannot be empty!',
       ]);

       //fixed auth
       if(Auth::attempt($credentials))
       {
            $request->session()->generate();

            return redirect()->intended('/dashboard');
       }else{
            return back()->with('error', 'Your email and password is incorrect!');
       }
    }
}
