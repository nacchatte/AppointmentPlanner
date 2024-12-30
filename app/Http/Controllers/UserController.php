<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate input
        $validated  = $request->validate([
            'name'=> 'required|string',
            'email'=> 'required|email:dns|unique:users',
            'hp'=> 'required',
            'password'=> 'required|string|min:6'
        ], [
            'name.required' => 'Name cannot be Empty!',
            'email.required' => 'Email cannot be Empty!',
            'email.unique' => 'Email has already been used!',
            'email.dns' => 'Invalid email domain @!',
            'hp.required' => 'HP cannot be Empty!',
            'password.required' => 'Password cannot be Empty!',
            'password.min' => 'Password minimal 6 Characters!',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $userss = User::create($validated);

        event(new Registered($userss));

        Auth::login($userss);

        //redidrect user and message
        return redirect('/')->with('success', 'You have successfully registered!');
    }
    public function checkDetails(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $hp = $request->input('hp');

        $existsName = User::where('name', $name)->exists();
        $existsEmail = User::where('email', $email)->exists();
        $existsHP = User::where('hp', $hp)->exists();

        return response()->json([
            'existsName' => $existsName,
            'existsEmail' => $existsEmail,
            'existsHP' => $existsHP
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }


    public function showLoginForm()
    {
        return view('auth.welcome');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Redirect to home or login page after logout
    }
}
