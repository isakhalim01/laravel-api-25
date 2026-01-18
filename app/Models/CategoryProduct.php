<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryProduct extends Model
{
    protected $guarded = ['id'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }

    public function productVariants()
    {
        return $this->hasManyThrough(ProductVariant::class, Product::class, 'product_category_id', 'product_id');
    }
}
