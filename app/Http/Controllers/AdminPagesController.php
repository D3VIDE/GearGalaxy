<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\{Category, Product, Variant, VariantAttribute, OrderItem};

class AdminPagesController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';
        $totalProducts = Product::count();
        $totalVariants = Variant::count();
        $totalCategories = Category::count();

        $salesToday = OrderItem::whereDate('created_at', today())
                        ->sum(DB::raw('unit_price * amount'));

        $lowStockVariants = Variant::with('product')
        ->whereNull('stock')
        ->orWhere('stock', '<=', 5)
        ->orderBy('stock')
        ->take(10)
        ->get();

        // Grafik Harian (7 Hari Terakhir)
        $dailySales = OrderItem::selectRaw("created_at::date as date, SUM(unit_price * amount) as total")
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Grafik Bulanan (12 Bulan Terakhir)
        $monthlySales = OrderItem::selectRaw("TO_CHAR(created_at, 'YYYY-MM') as month, SUM(unit_price * amount) as total")
            ->where('created_at', '>=', Carbon::now()->subMonths(11)->startOfMonth())
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Grafik Tahunan (5 Tahun Terakhir)
        $yearlySales = OrderItem::selectRaw("TO_CHAR(created_at, 'YYYY') as year, SUM(unit_price * amount) as total")
            ->where('created_at', '>=', Carbon::now()->subYears(4)->startOfYear())
            ->groupBy('year')
            ->orderBy('year')
            ->get();
            
        return view('admin.dashboard', compact(
            'title','totalProducts', 'totalVariants', 'totalCategories',
            'salesToday', 'lowStockVariants', 'dailySales','monthlySales','yearlySales'
        ));
    }

    public function showAddProdukForm()
    {
        $categories = Category::all();
        return view('admin.products.Produk', [
            'title' => 'Add Produk',
            'categories' => $categories
        ]);
    }

    public function addProduk(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'product_description' => 'required|string'
        ]);

        $exists = Product::where('product_name', $validated['product_name'])
            ->where('category_id', $validated['category_id'])
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'A product with the same name already exists in this category.');
        }

        try {
            Product::create([
                'product_name' => $validated['product_name'],
                'category_id' => $validated['category_id'],
                'product_description' => $validated['product_description']
            ]);

            return redirect()->route('addProduk')->with('success', 'Product successfully added!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function displayListProduct(Request $request)
    {
        $categories = Category::all();
        $selectedCategoryId = $request->input('category_id');

        $query = Product::with('category');

        if ($selectedCategoryId) {
            $query->where('category_id', $selectedCategoryId);
        }

        $products = $query->get();

        return view('admin.products.ListProduk', [
            'title' => 'List Produk',
            'products' => $products,
            'categories' => $categories,
            'selectedCategoryId' => $selectedCategoryId
        ]);
    }
    public function edit_product($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit-product', [
            'product' => $product,
            'categories' => $categories,
            'title' => 'Edit Produk'  // Menambahkan title
        ]);
    }

    public function update_product(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'product_description' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('ListProduk')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy_product($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('ListProduk')->with('success', 'Produk berhasil dihapus');
    }

    public function displayListCategory()
    {
        $categories = Category::all();
        return view('admin.products.ListCategory', [
            'title' => 'List Kategori',
            'categories' => $categories
        ]);
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.products.edit-category', [
            'category' => $category,
            'title' => 'Edit Category'
        ]);
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $id
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('ListCategory')->with('success', 'Kategori berhasil diupdate');
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('ListCategory')->with('success', 'Kategori berhasil dihapus');
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

            return redirect()->route('category')->with('success', 'Category successfully added!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function displayCategoryForm()
    {
        return view('admin.products.category', [
            'title' => 'Add Category'
        ]);
    }

    public function showAddVariantForm()
    {
        $products = Product::all();
        return view('admin.products.Variant', [
            'title' => 'Add Variant',
            'products' => $products
        ]);
    }
    public function editVariant($id)
    {
        $variant = Variant::findOrFail($id);
        return view('admin.products.edit-variant', [
            'variant' => $variant,
            'title' => 'Edit Variant'
        ]);
    }

    public function updateVariant(Request $request, $id)
    {
        $request->validate([
            'variant_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $variant = Variant::findOrFail($id);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($variant->image) {
                Storage::delete($variant->image);
            }
            $data['image'] = $request->file('image')->store('variants', 'public');
        }

        $variant->update($data);

        return redirect()->route('ListVariant')->with('success', 'Variant updated successfully');
    }

    public function deleteVariant($id)
    {
        $variant = Variant::findOrFail($id);

        // Delete image if exists
        if ($variant->image) {
            Storage::delete($variant->image);
        }

        $variant->delete();

        return redirect()->route('ListVariant')->with('success', 'Variant deleted successfully');
    }
    public function addVariant(Request $request)
    {
        $validated = $request->validate([
            'products_id' => 'required|exists:products,id',
            'variant_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $exists = Variant::where('products_id', $validated['products_id'])
            ->where('variant_name', $validated['variant_name'])
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'A variant with the same name already exists for this product.');
        }

        try {
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('variants', 'public');
            }

            Variant::create([
                'products_id' => $validated['products_id'],
                'variant_name' => $validated['variant_name'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'image' => $imagePath,
            ]);

            return redirect()->route('addVariant')->with('success', 'Variant successfully added!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function displayListVariant(Request $request)
    {
        $products = Product::all();
        $selectedProductId = $request->input('product_id');

        $variants = Variant::with('product')
            ->when($selectedProductId, fn($query) => $query->where('products_id', $selectedProductId))
            ->get();

        return view('admin.products.ListVariant', [
            'title' => 'List Variant',
            'variants' => $variants,
            'products' => $products,
            'selectedProductId' => $selectedProductId
        ]);
    }

    public function showAddVariantAttributeForm()
    {
        $variants = Variant::with('product')->get();
        return view('admin.products.VariantAttribute', [
            'title' => 'Add Variant Attribute',
            'variants' => $variants
        ]);
    }

    public function addVariantAttribute(Request $request)
    {
        $validated = $request->validate([
            'variant_id' => 'required|exists:variants,id',
            'attribute_name' => 'required|string|max:255',
            'attribute_detail' => 'required|string|max:255',
        ]);

        // Cek apakah attribute_name sudah ada untuk variant ini
        $exists = VariantAttribute::where('variant_id', $validated['variant_id'])
            ->where('attribute_name', $validated['attribute_name'])
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Attribute name already exists for this variant.');
        }

        try {
            VariantAttribute::create([
                'variant_id' => $validated['variant_id'],
                'attribute_name' => $validated['attribute_name'],
                'attribute_detail' => $validated['attribute_detail'],
            ]);

            return redirect()->route('addVariantAttribute')->with('success', 'Variant attribute successfully added!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function displayListVariantAttribute(Request $request)
    {
        $variants = Variant::with('product')->get();
        $selectedVariantId = $request->input('variant_id');

        $attributesQuery = VariantAttribute::with(['variant.product']);

        if ($selectedVariantId) {
            $attributesQuery->where('variant_id', $selectedVariantId);
        }

        $attributes = $attributesQuery->get();

        return view('admin.products.ListVariantAttribute', [
            'title' => 'List Variant Attribute',
            'variants' => $variants,
            'attributes' => $attributes,
            'selectedVariantId' => $selectedVariantId
        ]);
    }
    public function editVariantAttribute($id)
    {
        $attribute = VariantAttribute::findOrFail($id);
        $variants = Variant::with('product')->get();
        return view('admin.products.edit-attribute',[
            'attribute' => $attribute, 
            'variants' => $variants,
            'title' => 'Edit Variant Attribute'
        ]);
    }

    public function updateVariantAttribute(Request $request, $id)
    {
        $request->validate([
            'variant_id' => 'required|exists:variants,id',
            'attribute_name' => 'required|string|max:255',
            'attribute_detail' => 'nullable|string|max:255'
        ]);

        $attribute = VariantAttribute::findOrFail($id);
        $attribute->update($request->all());

        return redirect()->route('listVariantAttribute')->with('success', 'Attribute updated successfully');
    }

    public function deleteVariantAttribute($id)
    {
        $attribute = VariantAttribute::findOrFail($id);
        $attribute->delete();

        return redirect()->route('listVariantAttribute')->with('success', 'Attribute deleted successfully');
    }
}
