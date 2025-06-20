<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =['product_name','product_description'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
