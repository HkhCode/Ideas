<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //
    public function register()
    {
        return view('auth.register');
    }
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' =>$validated['password'],
        ]);
        Mail::to($user->email)->send(new WelcomeEmail($user));
        return redirect()->route('dashboard')->with('success','Account created successfully');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(AuthenticateUserRequest $request)
    {
        $validated = $request->validated();


        if(auth()->attempt($validated))
        {
            request()->session()->regenerate();

            return redirect()->route('dashboard')->with('success','Logged in successfully!');
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Provided email and password does not target any user'
        ]);
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('dashboard')->with('success' , 'Logged out successfully!');
    }
}
