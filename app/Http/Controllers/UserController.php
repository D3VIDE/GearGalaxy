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
        // Hitung produk populer (total terjual dari semua variannya)
    $popularProducts = Product::with(['variants.orderItems', 'category'])
        ->get()
        ->map(function ($product) {
            // Hitung total terjual dari semua varian produk ini
            $totalSold = $product->variants->sum(function ($variant) {
                return $variant->orderItems->sum('amount');
            });
            
            // Tambahkan field virtual `total_sold` ke produk
            $product->total_sold = $totalSold;
            return $product;
        })
        ->sortByDesc('total_sold') // Urutkan berdasarkan total terjual
        ->take(5);

    // Produk terbaru (tetap ambil varian pertama)
     $products = Product::with(['variants.orderItems', 'category'])
        ->latest()
        ->take(5)
        ->get()
        ->map(function ($product) {
            $product->total_sold = $product->variants->sum(function ($variant) {
                return $variant->orderItems->sum('amount');
            });
            return $product;
        });

        return view('HomePage', [
            'title' => 'Home',
            'categories' => Category::all(),
            'products' => $products,
            'popularProducts' => $popularProducts
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
        $variant = Variant::with(['product.category', 'product.variants'])->findOrFail($variantId);

        return view('user.detail', [
            'title' => $variant->product->product_name . ' - ' . $variant->variant_name,
            'variant' => $variant
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
