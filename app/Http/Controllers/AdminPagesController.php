<?php

namespace App\Http\Controllers;

use App\Models\{Category, Product, Variant, VariantAttribute};
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminPagesController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'title' => 'Dashboard'
        ]);
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

    public function displayListCategory()
    {
        $categories = Category::all();
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
}
