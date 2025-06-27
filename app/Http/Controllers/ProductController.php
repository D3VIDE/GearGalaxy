<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function displayProductCard()
    {
        // Get all variants with their product, category, and attributes
        $variants = Variant::with([
            'product.category',
            'attributes'
        ])->get();
        
        // Group variants by product to avoid duplicates
        $groupedVariants = $variants->groupBy('products_id');
        
        // Transform the data for the view
        $products = $groupedVariants->map(function ($productVariants) {
            // Get the first variant as base
            $baseVariant = $productVariants->first();
            
            $productData = [
                'id' => $baseVariant->id,
                'product_id' => $baseVariant->products_id,
                'name' => $baseVariant->product->product_name,
                'image' => $baseVariant->image ?? 'default-product-image.jpg',
                'price' => $baseVariant->price,
                'stock' => $baseVariant->stock,
                'category' => $baseVariant->product->category->category_name ?? 'Uncategorized',
                'variant_name' => $baseVariant->variant_name,
                'attributes' => $this->prepareAttributes($productVariants, $baseVariant->id),
                'all_variants' => $this->prepareAllVariants($productVariants)
            ];
            
            // Mark if has multiple variants
            if ($productVariants->count() > 1) {
                $productData['has_multiple_variants'] = true;
            }
            
            return $productData;
        })->values(); // Reset keys to 0,1,2...
        
        return view('user.shop', [
            'products' => $products,
            'title' => 'Catalog Produk'
        ]);
    }
    
    /**
     * Prepare attributes data for all variants of a product
     */
    protected function prepareAttributes($variants, $activeVariantId)
    {
        $attributes = [];
        
        foreach ($variants as $variant) {
            foreach ($variant->attributes as $attr) {
                $key = $attr->attribute_name . '|' . $attr->attribute_detail;
                
                if (!isset($attributes[$key])) {
                    $attributes[$key] = [
                        'name' => $attr->attribute_name,
                        'detail' => $attr->attribute_detail,
                        'is_active' => $variant->id == $activeVariantId,
                        'variant_id' => $variant->id,
                        'variant_image' => $variant->image,
                        'variant_price' => $variant->price,
                        'variant_stock' => $variant->stock
                    ];
                }
            }
        }
        
        return array_values($attributes);
    }
    
    /**
     * Prepare all variants data for a product
     */
    protected function prepareAllVariants($variants)
    {
        return $variants->map(function ($variant) {
            return [
                'id' => $variant->id,
                'variant_name' => $variant->variant_name,
                'image' => $variant->image,
                'price' => $variant->price,
                'stock' => $variant->stock,
                'attributes' => $variant->attributes->map(function ($attr) {
                    return [
                        'name' => $attr->attribute_name,
                        'detail' => $attr->attribute_detail
                    ];
                })->toArray()
            ];
        })->toArray();
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2'
        ]);

        $query = strtolower($request->input('query'));
        
        $products = Product::with(['variants', 'category'])
            ->whereRaw('LOWER(product_name) LIKE ?', ['%'.$query.'%'])
            ->orWhereHas('variants', function($q) use ($query) {
                $q->whereRaw('LOWER(variant_name) LIKE ?', ['%'.$query.'%']);
            })
            ->orderByDesc('created_at')
            ->paginate(12);
        
        return view('search-results', [
            'products' => $products,
            'query' => $request->input('query') // Return original query for display
        ]);
    }
}