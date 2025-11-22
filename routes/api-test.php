<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryProductController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;


Route::prefix('v1')->group(function () {
    Route::Resource('category-products', CategoryProductController::class);
    Route::Resource('products', ProductController::class);
    Route::Resource('products-variants', ProductVariantController::class);
});



