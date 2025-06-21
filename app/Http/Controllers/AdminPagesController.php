<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
class AdminPagesController extends Controller
{
        public function index()  // <-- Method ini harus ada
    {
        return view('admin.dashboard',[
            'title' => 'Dashboard'
        ]); // Sesuaikan dengan view Anda
    }

    public function showAddProdukForm(){
        $categories = Category::all();
        return view('admin.products.Produk',[
            'title' => 'Add Produk',
            'categories' => $categories
        ]);
    }
    public function addProduk(Request $request){
        $validated =  $request->validate([
        'product_name' => 'required|string|max:100',
        'category_id' => 'required|exists:categories,id',
        'product_description' => 'required|string'
    ]);
        try{
            Product::create([
                'product_name' => $validated['product_name'],
                'category_id' => $validated['category_id'],
                'product_description' => $validated['product_description']
            ]);
            return redirect()->route('dashboard')->with('success', 'Kategori berhasil ditambahkan!');
        }catch(\Exception $e){
             return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function displayListProduct(){

    }

    public function addVariant(Request $request){

    }

public function addCategory(Request $request)
{
    $request->validate([
        'category_name' => 'required|string|max:50|unique:categories,category_name',
    ]);

    try {
        Category::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('category')->with('success', 'Kategori berhasil ditambahkan!');
    } catch (\Exception $e) {
        return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
    public function displayCategoryForm(){
        return view('admin.products.category',[
            'title' => 'Add Category'
        ]);
    }
}
