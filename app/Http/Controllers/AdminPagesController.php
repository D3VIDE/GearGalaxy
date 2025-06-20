<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPagesController extends Controller
{
        public function index()  // <-- Method ini harus ada
    {
        return view('admin.dashboard',[
            'title' => 'Dashboard'
        ]); // Sesuaikan dengan view Anda
    }

    public function showAddProdukForm(){
        return view('admin.products.Produk',[
            'title' => 'Add Produk'
        ]);
    }
    public function addProduk(){

    }

    public function displayListProduct(){

    }

    public function addVariant(){
        
    }

    public function addCategory(){

    }

    public function displayCategoryForm(){
        
    }
}
