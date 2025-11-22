<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'description', 'price', 'product_category_id'];
    //
    public function CategoryProduct()
    {
        return $this->belongsTo(CategoryProduct::class, 'product_category_id');
    }
    public function ProductVariant()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
