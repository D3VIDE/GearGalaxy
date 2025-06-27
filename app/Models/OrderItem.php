<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'variant_id', 'product_id', 'amount', 'unit_price', 'subtotal'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variant()
{
    return $this->belongsTo(Variant::class, 'variant_id');
}
    
    public function product()
{
    return $this->belongsTo(\App\Models\Product::class, 'product_id');
}
}
