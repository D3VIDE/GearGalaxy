<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = ['products_id', 'variant_name', 'price', 'stock', 'image'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }

    public function attributes()
    {
        return $this->hasMany(VariantAttribute::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getVariantDetails(): string
    {
        $this->load('attributes'); // Pastikan relasi dimuat
    
        $details = [];
        foreach ($this->attributes as $attr) {
            if(is_object($attr)) { // Pastikan $attr adalah objek
                $details[] = "{$attr->attribute_name}: {$attr->attribute_detail}";
            }
        }
        
        return $details ? implode(', ', $details) : $this->variant_name;
    }
}
