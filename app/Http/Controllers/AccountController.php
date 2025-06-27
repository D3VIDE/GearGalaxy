<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.account', [
            'user' => $user,
            'title' => 'Account Management'
        ]);
    }

    public function updateUsername(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,user_name,' . Auth::id(),
        ]);

        $user = User::find(Auth::id());
        $user->user_name = $request->username;
        $user->save();

        return back()->with('success', 'Username updated!');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Email updated!');
    }
    public function deleteAccount(Request $request)
    {
        $user = User::find(Auth::id());

        // Logout user terlebih dahulu
        Auth::logout();

        // Hapus user
        if ($user->delete()) {
            return redirect('/')->with('success', 'Your account has been deleted successfully.');
        }

        return back()->with('error', 'Failed to delete account. Please try again.');
    }
}
