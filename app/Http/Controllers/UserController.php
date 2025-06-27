<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Product;
use App\Models\Variant;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function DisplayHomePage()
    {
        $products = Product::with(['variants', 'category'])->latest()->take(10)->get();
        $categories = Category::all();

        return view('HomePage', [
            'title' => 'Home',
            'categories' => $categories,
            'products' => $products
        ]);
    }
    public function showLoginForm()
    {
        return view('auth.login', [
            'title' => 'Login Form'
        ]);
    }

    public function showRegisterForm()
    {
        return view('auth.register', [
            'title' => 'Register Form'
        ]);
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password', [
            'title' => 'Forgot Password Form'
        ]);
    }

     public function showProductDetail($variantId)
    {
    $products = Product::with(['variants', 'category'])
        ->whereHas('variants') // Hanya produk dengan minimal 1 variant
        ->latest()
        ->take(10)
        ->get();

    $categories = Category::all();

    return view('HomePage', [
        'title' => 'Home',
        'categories' => $categories,
        'products' => $products
    ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:40|unique:users,user_name',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        // Create user
        $user = User::create([
            'user_name' => $validated['user_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role_id' => 2, // Regular user
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // Auto-login
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
    
    // Forgot Password
    public function resetPassword(Request $request)
    {
        // Validate the request input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);

        // Check if the user with the provided email exists
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Email not found in the system.']);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'Email not found in the system.',
                ]);
        }

        // Cek password
        if (!Hash::check($credentials['password'], $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'password' => 'Password does not match the email given.',
                ]);
        }

        // Login berhasil
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect sesuai role
        if ($user->role_id == 1) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->intended('/');
  
    }
}
