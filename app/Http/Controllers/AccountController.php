<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.account', compact('user'));
    }

    public function updateUsername(Request $request)
{
    $request->validate([
        'username' => 'required|string|max:255|unique:users,user_name,' . Auth::id(),
    ]);

    $user = Auth::user();
    $user->user_name = $request->username;
    $user->save();

    return back()->with('success', 'Username updated!');
}

public function updateEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users,email,' . Auth::id(),
    ]);

    $user = Auth::user();
    $user->email = $request->email;
    $user->save();

    return back()->with('success', 'Email updated!');
}

public function deleteAccount(Request $request)
{
    $user = Auth::user();
    Auth::logout();

    $user->delete();

    return redirect('/')->with('success', 'Your account has been deleted.');
}
}

