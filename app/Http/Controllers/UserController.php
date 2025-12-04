<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use League\Config\Exception\ValidationException;

class UserController extends Controller
{
    public function showLogin(){
        return Inertia::render('auth/Login');
    }

    public function showRegister(){
        return Inertia::render('auth/Register');
    }

    public function register(Request $request){
        // dd($request);
       $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        // using ternary operator
        $path = $request->file('profile_image') 
            ? $request->file('profile_image')->store('profiles', 'public')
            : null;
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'profile_image' => $path,
        ]);

        Auth::login($user);

        return redirect()->route('media.index')->with('success', 'new user created successfully');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($validated)){
            $request->session()->regenerate();

            return redirect()->route('media.index')->with('success', 'Logged in!');
        };

        return back()->withErrors([
            'email' => 'Sorry, incorrect credentials',
        ]);
    }
}
