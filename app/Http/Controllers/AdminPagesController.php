<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
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
            return redirect()->route('addProduk')->with('success', 'Produk berhasil ditambahkan!');
        }catch(\Exception $e){
             return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Untuk List Produk
    public function displayListProduct()
    {
        $products = Product::with('category')->get(); // Hapus orderBy('created_at')
        
        return view('admin.products.ListProduk', [
            'title' => 'List Produk',
            'products' => $products
        ]);
    }

    // Untuk List Kategori
    public function displayListCategory()
    {
        $categories = Category::all(); // Hapus orderBy('created_at')
        
        return view('admin.products.ListCategory', [
            'title' => 'List Kategori',
            'categories' => $categories
        ]);
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

    // Variant
    public function showAddVariantForm(){
        $products = Product::all();
        return view('admin.products.Variant', [
            'title' => 'Add Variant',
            'products' => $products
        ]);
    }

    public function addVariant(Request $request){
        $validated = $request->validate([
            'products_id' => 'required|exists:products,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('variants', 'public');
            }

            // Gunakan DB facade untuk langsung insert ke tabel variants
            DB::table('variants')->insert([
                'products_id' => $validated['products_id'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'image' => $imagePath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('addVariant')->with('success', 'Variant berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function displayListVariant(){
        $variants = DB::table('variants')
            ->join('products', 'variants.products_id', '=', 'products.id')
            ->select('variants.*', 'products.product_name')
            ->get();
            
        return view('admin.products.ListVariant', [
            'title' => 'List Variant',
            'variants' => $variants
        ]);
    }
}

