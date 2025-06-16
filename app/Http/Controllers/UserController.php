<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('auth.login',[
            'title' => 'Login Form'
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register',[
            'title' => 'Register Form'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:40',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

         // Buat user baru
        $user = User::create([
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 2, // Default role: Regular User
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Auto login setelah register
        Auth::login($user);

        return redirect('/');
    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // keluarin user
        request()->session()->invalidate(); // invalidate session
        request()->session()->regenerateToken(); // regenerasi token CSRF
        return redirect('/');
    }

    public function login(Request $request ){
    $credentials = $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8'
    ]);

    // Coba melakukan autentikasi
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
         return redirect()->intended('/');
        }
    }
}
