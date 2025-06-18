<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()  // <-- Method ini harus ada
    {
        return view('admin.dashboard'); // Sesuaikan dengan view Anda
    }
}
