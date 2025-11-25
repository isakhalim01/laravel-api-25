<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $guarded = ['id'];

    public function products():hasMany
    {
        return $this->hasMany(Product::class);
    }
    public function ProductVariant()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
