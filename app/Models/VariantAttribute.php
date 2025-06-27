<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class VariantAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['variant_id', 'attribute_name', 'attribute_detail'];
    
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
}
